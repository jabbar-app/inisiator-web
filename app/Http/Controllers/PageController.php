<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
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

    public function author()
    {
        return view('pages.author');
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
