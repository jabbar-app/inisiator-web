<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\InvitationRequest;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Ambil artikel unggulan
        $featureds = Article::with(['user:id,username,name', 'category:id,slug,title'])
            ->select('id', 'title', 'slug', 'img_featured', 'content', 'created_at', 'user_id', 'category_id')
            ->where('is_featured', true)
            ->latest('created_at')
            ->take(4)
            ->get();

        // Ambil artikel untuk Editors' Pick
        $editorsPick = Article::with(['user:id,username,name', 'category:id,slug,title'])
            ->select('id', 'title', 'slug', 'img_featured', 'content', 'created_at', 'user_id', 'category_id')
            ->latest('created_at')
            ->first(); // Ambil artikel terbaru sebagai Editors' Pick

        // Ambil artikel untuk Most Recent section
        $articlesSection = Article::with(['user:id,name,username', 'category:id,title,slug'])
            ->select('id', 'title', 'slug', 'img_featured', 'content', 'created_at', 'user_id', 'category_id')
            ->latest()
            ->take(4) // Ambil 4 artikel terbaru
            ->get();

        // Artikel lainnya untuk bagian `Recent Articles`
        $articles = Article::with(['user:id,username,name', 'category:id,slug,title'])
            ->select('id', 'title', 'slug', 'img_featured', 'content', 'created_at', 'user_id', 'category_id')
            ->latest('created_at')
            ->paginate(10);

        // Ambil artikel populer untuk sidebar
        $popularArticles = Article::with(['user:id,username,name', 'category:id,slug,title'])
            ->select('id', 'title', 'slug', 'img_featured', 'content', 'created_at', 'user_id', 'category_id')
            ->orderBy('views', 'desc') // Urutkan berdasarkan jumlah views
            ->take(5) // Ambil 5 artikel paling populer
            ->get();

        // Pass data ke view
        return view('pages.home', compact('featureds', 'editorsPick', 'articlesSection', 'articles', 'popularArticles'));
    }

    public function author(string $username)
    {
        // Mengambil data penulis berdasarkan username
        $author = User::with('articles')->where('username', $username)->firstOrFail();

        // Mengambil 5 artikel terbaru untuk sidebar
        $latestArticles = Article::latest()->take(5)->get();
        $highlightPosts = Article::latest()->take(5)->get();

        // Mengambil 4 artikel yang di-highlight
        // $highlightPosts = Article::where('is_highlighted', true)->take(4)->get();

        return view('pages.author', compact('author', 'latestArticles', 'highlightPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('s');

        // Validasi input pencarian
        if (!$query) {
            return redirect()->route('pages.search')->with('error', 'Please enter a search term.');
        }

        // Lakukan pencarian di database
        $results = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        $highlightPosts = Article::latest()->take(5)->get();
        // Kirim hasil pencarian ke view
        return view('pages.search', compact('results', 'query', 'highlightPosts'));
    }

    public function requestInvitation()
    {
        return view('pages.request-invitation');
    }

    public function sendRequestInvitation(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^62[1-9][0-9]{8,15}$/',
                'unique:invitation_requests,phone',
            ],
            'email' => 'required|email|max:255|unique:invitation_requests,email',
            'sample_article' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('sample_article')) {
            $filePath = $request->file('sample_article')->store('sample_articles', 'public');
            $validatedData['sample_article'] = $filePath;
        }

        // Simpan data ke database
        InvitationRequest::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Permintaan undangan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda!');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
