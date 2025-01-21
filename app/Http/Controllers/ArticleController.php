<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleViewStat;
use App\Models\Tag;
use App\Models\WriterEarning;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use OpenAI;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // Query semua artikel milik user login
        // Jika data sangat besar, pertimbangkan server-side pagination
        $articles = Article::where('user_id', Auth::id())
            ->with('category')
            ->orderByDesc('created_at')
            ->get();

        // Total views dari semua artikel user
        $totalViews = Article::where('user_id', Auth::id())->sum('views');

        // Ambil total earnings user (contoh, satu record di writer_earnings)
        $userEarning = Auth::user()->earning->amount ?? 0;

        // Render ke blade
        return view('articles.index', compact('categories', 'articles', 'totalViews', 'userEarning'));
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
            'img_featured'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'compressed_image' => 'nullable|string|regex:/^data:image\/\w+;base64,/',
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
            $tags = collect(json_decode($request->input('tags'), true))
                ->pluck('value')
                ->map(fn($tag) => ucwords(strtolower(trim($tag))));

            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();

            $newTags = $tags->diff(Tag::whereIn('name', $tags)->pluck('name'));
            $createdTags = $newTags->map(fn($tag) => Tag::create(['name' => $tag])->id);

            $article->tags()->sync(array_merge($tagIds, $createdTags->toArray()));
        }

        try {
            app(WhatsappController::class)->sendNotification($article->id, '08990980799');
        } catch (\Exception $e) {
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diajukan!');
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            // ->where('status', 'approved') // Opsional, jika hanya ingin menampilkan artikel yang disetujui
            ->with('tags') // Eager load untuk menghindari query tambahan
            ->firstOrFail();

            // dd($article);

        $relatedPosts = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3) // Batasi jumlah artikel terkait
            ->get();

        $ipAddress = request()->ip() ?? 'anonymous';
        $cacheKey  = 'article_views_' . md5($slug . $ipAddress);

        // Jika cacheKey belum ada, berarti IP ini belum mengunjungi (dlm periode cache)
        if (!Cache::has($cacheKey)) {
            // 1. Increment statistik harian di article_view_stats
            $today = now()->toDateString();
            $todayStat = ArticleViewStat::firstOrCreate([
                'article_id' => $article->id,
                'date'       => $today,
            ]);
            $todayStat->increment('views_count');

            // 2. Increment kolom 'views' di artikel (lifetime views)
            $article->increment('views');

            // 3. Tambahkan earnings untuk penulis
            $this->addWriterEarnings($article);

            // 4. Simpan ke cache agar tidak bisa di-spam
            Cache::put($cacheKey, true, now()->addMinutes(15));
        }

        // Format tag untuk digunakan di tampilan
        $tags = $article->tags->map(fn($tag) => $tag->name)->toArray();

        return view('articles.show', compact('article', 'relatedPosts', 'tags'));
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

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        // Lakukan apa pun yang dibutuhkan, misalnya:
        $article->status = 'approved';
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil disetujui!');
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
}
