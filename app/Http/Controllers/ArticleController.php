<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleRead;
use App\Models\ArticleStat;
use App\Models\Category;
use App\Models\Earning;
use App\Models\Tag;
use App\Models\User;
use App\Models\WriterEarning;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use OpenAI;
use DOMDocument;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $articles = Article::where('user_id', Auth::id())
            ->with(['category', 'stats'])
            ->orderByDesc('created_at')
            ->get();
        // ->paginate(10);

        $totalViews = ArticleStat::whereIn('article_id', $articles->pluck('id'))->sum('views');

        $userEarning = Auth::user()->earning->amount ?? 0;

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now();
        $stats = ArticleStat::whereIn('article_id', $articles->pluck('id'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy('date');

        // Siapkan data untuk grafik
        $dates = [];
        $viewsData = [];
        $readsData = [];

        foreach (range(1, now()->daysInMonth) as $day) {
            $date = now()->startOfMonth()->addDays($day - 1)->format('Y-m-d');
            $dates[] = now()->startOfMonth()->addDays($day - 1)->format('M j');

            // Jika tidak ada data pada tanggal tersebut, default ke 0
            $viewsData[] = isset($stats[$date]) ? $stats[$date]->sum('views') : 0;
            $readsData[] = isset($stats[$date]) ? $stats[$date]->sum('reads') : 0;
        }

        return view('articles.index', compact(
            'categories',
            'articles',
            'totalViews',
            'userEarning',
            'dates',
            'viewsData',
            'readsData'
        ));
    }


    // Form untuk membuat artikel baru
    public function create()
    {
        $categories = Category::all(); // Tabel categories
        return view('articles.create', compact('categories'));
    }

    public function fetchTags()
    {
        $tags = Cache::remember('tags_list', now()->addHours(1), function () {
            return Tag::cursor()->pluck('name')->all();
        });

        return response()->json($tags);
    }

    // Generate slug (misal untuk AJAX)
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('articles/images', 'public');
            return response()->json([
                'url' => asset($path),
            ]);
        }

        return response()->json(['error' => 'Upload gagal.'], 422);
    }

    public function checkTypo(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $content = $request->input('content');

        // Gunakan OpenAI API untuk memeriksa typo
        $openai = OpenAI::client(config('services.openai.api_key'));
        $response = $openai->chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'Periksa ejaan dan tata bahasa dari teks berikut. Jangan ubah gaya bahasa, hanya perbaiki typo.'],
                ['role' => 'user', 'content' => $content],
            ],
        ]);

        $corrected = $response['choices'][0]['message']['content'];

        return response()->json(['corrected' => $corrected]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required',
            'category_id'      => 'nullable|exists:categories,id',
            'img_featured'     => 'nullable|image|mimes:jpeg,png,jpg',
            'compressed_image' => 'nullable|string|regex:/^data:image\/\w+;base64,/',
            'tags'             => 'nullable|string',
        ]);

        $imgPath = null;

        if ($request->filled('compressed_image')) {
            $croppedData = $request->input('compressed_image');
            $imageName = time() . '-' . uniqid() . '.webp';
            $imagesFolder = public_path('featured-images');
            $avatarPath = $imagesFolder . '/' . $imageName;

            if (!is_dir($imagesFolder)) {
                mkdir($imagesFolder, 0755, true);
            }

            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedData));
            if (!file_put_contents($avatarPath, $imageData)) {
                return redirect()->back()->withErrors(['img_featured' => 'Gagal menyimpan gambar.']);
            }

            $imgPath = 'featured-images/' . $imageName;
        }

        $content = $request->content;
        $excerpt = $request->excerpt ?? implode(' ', array_slice(explode(' ', strip_tags($content)), 0, 30)) . '...';
        $readingTime = ceil(str_word_count(strip_tags($content)) / 200);

        $article = Article::create([
            'user_id'      => Auth::id(),
            'category_id'  => $request->category_id ?? null,
            'img_featured' => $imgPath,
            'title'        => $request->title,
            'slug'         => SlugService::createSlug(Article::class, 'slug', $request->title),
            'content'      => $content,
            'excerpt'      => $excerpt,
            'reading_time' => $readingTime,
            'status'       => 'pending',
        ]);

        if ($request->filled('tags')) {
            $tags = collect(explode(',', $request->input('tags')))
                ->map(fn($tag) => ucwords(strtolower(trim($tag))))
                ->filter(); // remove empty strings

            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();

            $newTags = $tags->diff(Tag::whereIn('name', $tags)->pluck('name'));
            $createdTags = $newTags->map(fn($tag) => Tag::create(['name' => $tag])->id);

            $article->tags()->sync(array_merge($tagIds, $createdTags->toArray()));
        }

        try {
            $number = '628990980799';
            $approveUrl = route('articles.to-approve', $article->id);
            $message = "Halo Admin, ada artikel baru dengan judul '{$article->title}'.\nSilakan review di: {$approveUrl}";

            app(WhatsappController::class)->sendNotification($message, $number);
        } catch (\Exception $e) {
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diajukan!')->withFragment('my-articles');
    }

    public function show(string $slug)
    {
        // 1. Fetch the article and related models using eager loading
        $article = Article::with([
            'tags',              // Load tags
            'category',          // Load category
            'user.followers',    // Load user followers for stats
            'comments',          // Load comments
            'reactions'          // Load reactions
        ])->where('slug', $slug)
            ->firstOrFail();

        // 2. Fetch related articles (reuse category from eager-loaded `category`)
        $relatedPosts = Article::where('category_id', $article->category->id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(2)
            ->get();

        // 3. Handle views and earnings with caching
        $ipAddress = request()->ip();
        $cacheKey = 'article_views_' . md5($slug . $ipAddress);

        if (!Cache::has($cacheKey)) {
            // Increment today's stats
            $stats = ArticleStat::firstOrCreate([
                'article_id' => $article->id,
                'date' => now()->toDateString(),
            ]);
            $stats->increment('views');

            // Add earnings for the writer
            $this->addWriterEarnings($article);

            // Cache to prevent abuse
            Cache::put($cacheKey, true, now()->addMinutes(15));
        }

        // 4. Inject Ads after the third paragraph
        $adsHtml = view('components.adsense-responsive')->render();

        // **Hapus <br> kosong**
        $cleanContent = $this->removeEmptyBrTags($article->content);

        // **Tambahkan class pada setiap <p> di dalam content**
        $content = $this->addClassToParagraphs($cleanContent, 'post-open-paragraph');

        $content = $this->injectAdsIntoContent($content, $adsHtml);

        // 5. Prepare tags for the view
        $tags = $article->tags->pluck('name')->toArray();

        // 6. Prepare reactions data
        $reactions = [];

        // Dapatkan semua reaksi untuk artikel ini
        $allReactions = DB::table('article_reactions')
            ->join('users', 'article_reactions.user_id', '=', 'users.id')
            ->select('article_reactions.*', 'users.name as user_name')
            ->where('article_reactions.article_id', $article->id)
            ->get();

        // Format reactions untuk view
        foreach ($allReactions as $reaction) {
            $type = $reaction->content ?? 'Like'; // Default ke 'Like' jika null

            if (!isset($reactions[$type])) {
                $reactions[$type] = [];
            }

            $reactions[$type][] = $reaction->user_name;
        }

        // 7. Pass all data to the view
        return view('articles.show', compact('article', 'relatedPosts', 'tags', 'content', 'reactions'));
    }

    /**
     * Fungsi untuk menghapus <br> kosong dari konten HTML
     */
    private function removeEmptyBrTags(string $htmlContent): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Menghindari error jika ada HTML yang tidak valid
        $dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $brTags = $dom->getElementsByTagName('br');

        // Loop secara terbalik untuk menghindari masalah saat menghapus node dari live NodeList
        for ($i = $brTags->length - 1; $i >= 0; $i--) {
            $br = $brTags->item($i);
            if (!$br->nextSibling && (!$br->previousSibling || trim($br->previousSibling->textContent) === '')) {
                $br->parentNode->removeChild($br);
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Fungsi untuk menambahkan class ke setiap <p> di dalam content
     */
    private function addClassToParagraphs(string $htmlContent, string $className): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Supaya tidak error jika ada tag HTML yang tidak valid
        $dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Ambil semua elemen <p>
        $paragraphs = $dom->getElementsByTagName('p');

        foreach ($paragraphs as $p) {
            $existingClass = $p->getAttribute('class');
            $newClass = trim($existingClass . ' ' . $className);
            $p->setAttribute('class', $newClass);
        }

        return $dom->saveHTML();
    }

    /**
     * Injects an ad into the article content after the third paragraph.
     */
    private function injectAdsIntoContent($content, $adsHtml)
    {
        // Memecah konten menjadi array paragraf
        $paragraphs = explode('</p>', $content);
        $newContent = '';

        // Loop melalui setiap paragraf
        foreach ($paragraphs as $index => $paragraph) {
            // Tambahkan paragraf ke konten baru
            $newContent .= $paragraph . '</p>';

            // Sisipkan iklan setiap 8 paragraf
            if (($index + 1) % 8 === 0) {
                $newContent .= $adsHtml;
            }
        }

        return $newContent;
    }


    public function edit($slug)
    {
        $categories = Category::all();
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.edit', compact('categories', 'article'));
    }

    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'img_featured' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
        ]);

        if ($request->hasFile('img_featured')) {
            // Simpan gambar unggulan baru
            $fileName = time() . '.' . $request->file('img_featured')->getClientOriginalExtension();
            $path = $request->file('img_featured')->storeAs('uploads/articles', $fileName, 'public');
            $validated['img_featured'] = $path;

            // Hapus gambar lama jika ada
            if ($article->img_featured) {
                Storage::disk('public')->delete($article->img_featured);
            }
        }

        $tags = explode(',', $request->tags ?? '');
        $validated['tags'] = array_map('trim', $tags);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menambahkan pendapatan ke tabel writer_earnings
     * untuk penulis $article->user setiap kali view baru.
     */
    private function addWriterEarnings(Article $article)
    {
        // Misal periode bulanan: "2025-01"
        $currentPeriod = now()->format('Y-m');

        $rank = $article->user->rank; // Pastikan kolom rank di table users

        // Definisikan rate per rank (bisa disimpan di config/ atau database)
        $rankRates = [
            'Stargazer'     => 1.0, // Pemula
            'Skywalker'     => 1.3, // Mulai berkembang
            'Moonlighter'   => 1.7, // Menonjol
            'Sunsurfer'     => 2.2, // Level tinggi
            'Supernova'     => 2.8, // Sangat unggul
            'Galaxian'      => 3.0, // Level tertinggi
        ];

        // Ambil rate rank. Jika rank tidak terdaftar, default 1.0
        $rankRate = $rankRates[$rank] ?? 1.0;

        // Misal base earning Rp. 0.001 per view
        // (Tentu ini hanya contoh. Jumlah aslinya disesuaikan pendapatan AdSense dsb.)
        $baseEarningPerView = 10;

        // Total yang ingin ditambahkan
        $earningToAdd = $baseEarningPerView * $rankRate;

        // Cari atau buat record di writer_earnings
        $writerEarning = WriterEarning::firstOrCreate(
            [
                'user_id' => $article->user_id,
                'period'  => $currentPeriod,
            ],
            [
                'views_count' => 0,   // default
                'rank_rate'   => $rankRate, // optional, atau diupdate terpisah
            ]
        );

        // Increment kolom 'amount'
        // laravel ->increment() bisa disertai nilai tambahan
        $writerEarning->increment('amount', $earningToAdd);

        // (opsional) Kamu juga bisa menambah 'views_count' +1
        $writerEarning->increment('views_count', 1);

        // (opsional) Jika ingin simpan rank_rate terakhir
        $writerEarning->rank_rate = $rankRate;
        $writerEarning->save();
    }

    public function toApprove(Article $article)
    {
        return view('articles.approve', compact('article'));
    }

    public function approve(Article $article)
    {
        $article->status = 'approved';
        $article->approved_by = Auth::user()->id;
        $article->save();

        try {
            $number = $article->user->phone;
            $articleUrl = route('articles.show', $article->slug);
            $message = "Salam! Artikel kamu yang berjudul '{$article->title}' telah disetujui publikasinya oleh Admin. \n\nCek di sini ya: {$articleUrl}";

            app(WhatsappController::class)->sendNotification($message, $number);
        } catch (\Exception $e) {
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }

        return redirect()->route('articles.to-approve')->with('success', 'Artikel berhasil disetujui!');
    }

    public function search(Request $request)
    {
        $query = $request->input('s');

        // Lakukan pencarian berdasarkan judul atau konten
        $results = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results', compact('results', 'query'));
    }

    public function clap(Article $article)
    {
        $user = Auth::user();

        // Cek apakah user sudah pernah clap artikel ini
        $existingClap = $article->claps()->where('user_id', $user->id)->first();

        if ($existingClap) {
            // Jika sudah clap, hapus record (unclap)
            $article->claps()->detach($user->id);
        } else {
            // Jika belum clap, tambahkan record baru di pivot
            $article->claps()->attach($user->id, ['claps_count' => 1]);
        }

        return back();
    }

    public function markRead(Article $article)
    {
        $user = User::findOrFail(Auth::id()); // Pastikan user login

        // Cek apakah user sudah membaca artikel ini sebelumnya
        $alreadyRead = ArticleRead::where('article_id', $article->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyRead) {
            return response()->json(['message' => 'Reward already granted for this article'], 200);
        }

        // Tambahkan entri baru ke tabel article_reads
        ArticleRead::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);

        // Tambahkan 1 rupiah ke earnings user
        $reward = 1;
        Earning::create([
            'user_id' => $user->id,
            'type' => 'reads',
            'total_amount' => $reward,
            'details' => json_encode([
                'description' => 'Hadiah dari membaca: ' . $article->title,
                'reward' => $reward,
                'date' => now()->format('Y-m-d'),
            ]),
        ]);

        // Tambahkan 1 ke kolom reads di tabel articles
        $stats = ArticleStat::firstOrCreate([
            'article_id' => $article->id,
            'date' => now()->toDateString(),
        ]);
        $stats->increment('reads');

        return response()->json([
            'success' => true,
            'message' => 'Read successfully recorded and reward granted',
            'reward' => $reward,
            'total_earnings' => $user->earning->amount,
        ]);
    }
}
