@extends('templates.main')

@section('content')

  <div style="margin-top: 48px;"></div>

  <div class="content-grid full">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h3><span class="fw-400">Results for</span> {{ $category->title }}</h3>
          <hr>
          @foreach ($articles as $article)
            @if ($article && $article->slug && $article->category && $article->user)
              <article class="row justify-content-between mb-5 mr-0">
                <div class="col-md-9">
                  <div class="align-self-center">
                    <div class="d-flex">
                      <a href="{{ route('categories.show', $article->category->slug) }}" class="tag-item secondary fw-300 mb-2">{{ $article->category->title }}</a>
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
        </div>

        <div class="col-md-4 pl-md-5 sticky-sidebar">
          <div class="sidebar-widget latest-tpl-4">
            @include('components.adsense-responsive')
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
