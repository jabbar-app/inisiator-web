@extends('templates.main')

@section('title', 'Results for ' . $query)
@section('meta_description', 'Results for ' . $query)
@section('meta_keywords', $query)

@section('content')
  <div class="content-grid full">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h3><span class="fw-400">Results for</span> "{{ $query }}"</h3>
          <hr>
          @if ($results->isEmpty())
            <p>No results found for "{{ $query }}". Please try again with a different keyword.</p>
          @else
            @foreach ($results as $article)
              @if ($article && $article->slug && $article->category && $article->user)
                <article class="row justify-content-between mb-5 mr-0">
                  <div class="col-md-9">
                    <div class="align-self-center">
                      <div class="d-flex">
                        <a href="{{ route('categories.show', $article->category->slug) }}"
                          class="tag-item secondary fw-300 mb-2">{{ $article->category->title }}</a>
                      </div>
                      <h3 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $article->slug) }}" class="fw-400">{{ $article->title }}</a>
                      </h3>
                      <div class="entry-excerpt mb-2">
                        <p>{{ Str::limit(strip_tags($article->content), 150) }}</p>
                      </div>
                      <div class="entry-meta align-items-center">
                        by
                        @if ($article->user && $article->user->username)
                          <a href="{{ route('pages.author', $article->user->username) }}"
                            class="fw-400">{{ $article->user->name }}</a>
                        @else
                          <span>Unknown Author</span>
                        @endif
                        in
                        @if ($article->category && $article->category->slug)
                          <a
                            href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a>
                        @else
                          <span>Uncategorized</span>
                        @endif
                        <br>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 bgcover"
                    style="background-image:url({{ $article->img_featured ? asset($article->img_featured) : asset('assets/images/thumb/thumb-512x512.jpg') }});">
                  </div>
                </article>
              @endif
            @endforeach
          @endif
        </div>

        <div class="col-md-4 pl-md-5 sticky-sidebar">
          <div class="sidebar-widget latest-tpl-4">
            <h3>Trending in "Medan"</h3>
            <hr>
            <ol>
              @foreach ($popularArticles as $index => $popular)
                @if ($popular && $popular->slug && $popular->category && $popular->user)
                  <li class="d-flex mb-4" style="gap: 16px;">
                    <h1 class="post-count">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h1>
                    <div class="post-content">
                      <h5 class="entry-title my-1">
                        <a href="{{ route('articles.show', $popular->slug) }}">{{ $popular->title }}</a>
                      </h5>
                      <div class="entry-meta align-items-center">
                        Writen by
                        <span class="text-white">
                          @if ($popular->user && $popular->user->username)
                            <a href="{{ route('pages.author', $popular->user->username) }}"
                              class="text-info">{{ $popular->user->name }}</a>
                          @else
                            <span>Unknown Author</span>
                          @endif
                        </span>
                        in
                        @if ($popular->category && $popular->category->slug)
                          <a href="{{ route('categories.show', $popular->category->slug) }}"
                            class="text-info">{{ $popular->category->title }}</a>
                        @else
                          <span>Uncategorized</span>
                        @endif
                        <br>
                        <span>{{ $popular->created_at->format('d M Y') }}</span>
                      </div>
                    </div>
                  </li>
                @endif
              @endforeach
            </ol>
            @include('components.adsense-responsive')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
