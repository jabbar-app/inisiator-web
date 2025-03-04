@extends('templates.main')

@section('title', 'A storytelling platform')
@section('meta_description', 'Inisiator')
@section('meta_keywords', 'Inisiator, Storytelling, Writing Platform')
{{-- @section('meta_image', asset('front/img/profpic.png')) --}}

@section('content')
  <div class="content-grid full p-0">
    <div class="section-featured featured-style-1">
      <div class="container">
        <div class="row pt-5">
          <div class="col-md-9">
            <h2 class="mb-2">Editor's Pick</h2>
            <hr>
            <div class="row">
              @if ($featureds && $featureds->count() > 0)
                @php $firstFeature = $featureds->first(); @endphp
                @if ($firstFeature && $firstFeature->slug && $firstFeature->user && $firstFeature->category)
                  <div class="col-md-6">
                    <article class="first mb-4">
                      <figure>
                        <a href="{{ route('articles.show', $firstFeature->slug) }}">
                          <img
                            src="{{ $firstFeature->img_featured ? asset($firstFeature->img_featured) : asset('assets/images/thumb/thumb-1240x700.jpg') }}"
                            alt="{{ $firstFeature->title }}" class="w-100 rounded mb-2">
                        </a>
                      </figure>
                      <h4 class="entry-title mb-1">
                        <a href="{{ route('articles.show', $firstFeature->slug) }}"
                          class="fw-500">{{ $firstFeature->title }}</a>
                      </h4>
                      <div class="entry-meta">
                        @if ($firstFeature->user && $firstFeature->user->username)
                          <a
                            href="{{ route('pages.author', $firstFeature->user->username) }}">{{ $firstFeature->user->name }}</a>
                        @else
                          <span>Unknown Author</span>
                        @endif
                        in
                        @if ($firstFeature->category && $firstFeature->category->slug)
                          <a
                            href="{{ route('categories.show', $firstFeature->category->slug) }}">{{ $firstFeature->category->title }}</a>
                        @else
                          <span>Uncategorized</span>
                        @endif
                        <br>
                        <small class="text-muted"><em>Published at
                            {{ $firstFeature->created_at->format('d M Y') }}</em></small>
                      </div>
                    </article>
                  </div>
                @endif

                <div class="col-md-6">
                  @foreach ($featureds->skip(1) as $feature)
                    @if ($feature && $feature->slug && $feature->user && $feature->category)
                      <article class="post-has-bg mx-3 mb-3">
                        <div class="d-flex row">
                          <figure class="col-4 p-0">
                            <a href="{{ route('articles.show', $feature->slug) }}">
                              <img
                                src="{{ $feature->img_featured ? asset($feature->img_featured) : asset('assets/images/thumb/thumb-700x512.jpg') }}"
                                alt="{{ $feature->title }}" class="w-100 rounded mb-2">
                            </a>
                          </figure>
                          <div class="entry-content col-8">
                            <h5 class="entry-title">
                              <a href="{{ route('articles.show', $feature->slug) }}"
                                class="fw-500">{{ $feature->title }}</a>
                            </h5>
                            <div class="entry-meta" style="font-size: 14px;">
                              by
                              @if ($feature->user && $feature->user->username)
                                <a href="{{ route('pages.author', $feature->user->username) }}"
                                  class="fw-400">{{ $feature->user->name }}</a>
                              @else
                                <span>Unknown Author</span>
                              @endif
                              in
                              @if ($feature->category && $feature->category->slug)
                                <a href="{{ route('categories.show', $feature->category->slug) }}"
                                  class="fw-400">{{ $feature->category->title }}</a>
                              @else
                                <span>Uncategorized</span>
                              @endif
                              <br>
                              <small class="text-muted"><em>Published at
                                  {{ $feature->created_at->format('d M Y') }}</em></small>
                            </div>
                          </div>
                        </div>
                      </article>
                    @endif
                  @endforeach
                </div>
              @endif
            </div>
          </div>

          <div class="col-md-3">
            <h2 class="mb-2">Trending</h2>
            <hr>
            <ol>
              @foreach ($featureds->take(4) as $trend)
                @if ($trend && $trend->slug)
                  <li class="mb-3">
                    <h5><a href="{{ route('articles.show', $trend->slug) }}" class="fw-500">{{ $trend->title }}</a></h5>
                    <p>
                      <small class="text-muted">by {{ $trend->user->name }}</small>
                    </p>
                  </li>
                @endif
              @endforeach
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-grid full my-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>

  <div class="content-grid full">
    <div class="container bg-white">
      <div class="row justify-content-between post-has-bg">
        @if ($editorsPick && $editorsPick->slug && $editorsPick->category && $editorsPick->user)
          <div class="col-lg-6">
            <div class="pt-5 pb-5 pl-md-5 pr-5 align-self-center">
              <div class="capsSubtle mb-2">Featured Article</div>
              <h2 class="entry-title mb-3">
                <a href="{{ route('articles.show', $editorsPick->slug) }}" class="fw-500">{{ $editorsPick->title }}</a>
              </h2>
              {{-- <img src="{{ $editorsPick->img_featured ? asset($editorsPick->img_featured) : asset('assets/images/thumb/thumb-800x495.jpg') }}" alt="" class="img-featured-cover d-block d-md-none"> --}}
              <div class="entry-excerpt mb-3">
                <p>{{ Str::limit(strip_tags($editorsPick->content), 150) }}</p>
              </div>
              <div class="entry-meta">
                @if ($editorsPick->user && $editorsPick->user->username)
                  <a href="{{ route('pages.author', $editorsPick->user->username) }}">{{ $editorsPick->user->name }}</a>
                @else
                  <span>Unknown Author</span>
                @endif
                in
                @if ($editorsPick->category && $editorsPick->category->slug)
                  <a
                    href="{{ route('categories.show', $editorsPick->category->slug) }}">{{ $editorsPick->category->title }}</a>
                @else
                  <span>Uncategorized</span>
                @endif
                <br>
                <small class="text-muted"><em>Published at {{ $editorsPick->created_at->format('d M Y') }}</em></small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 bgcover d-none d-md-block"
            style="background-image:url({{ $editorsPick->img_featured ? asset($editorsPick->img_featured) : asset('assets/images/thumb/thumb-800x495.jpg') }});">
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="content-grid full">
    <div class="container">
      <div class="row mb-4">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>

  <div class="content-grid full">
    <div class="container">
      <h2 class="mb-2">Today's Entertainment</h2>
      <hr>
      <div class="grid">
        <div class="grid grid-half change-on-desktop">
          <div class="achievement-box secondary">
            <div class="achievement-box-info-wrap">
              <img class="achievement-box-image d-none d-md-block"
                src="{{ asset('assets/img/icons/badges/caffeinated-b.webp') }}" alt="badge-caffeinated-b">

              <div class="achievement-box-info">
                <p class="achievement-box-title">Friendship Dare Quiz</p>

                <p class="achievement-box-text">&rarr; <span class="bold">Most played</span> 741+ players</p>
              </div>
            </div>

            <a href="{{ route('play.dare.create') }}" class="button white-solid">PLAY QUIZ</a>
          </div>

          <div class="achievement-box primary">
            <div class="achievement-box-info-wrap">
              <img class="achievement-box-image d-none d-md-block" src="{{ asset('theme/img/completedq-l.webp') }}"
                alt="quest-completedq-l">

              <div class="achievement-box-info">
                <p class="achievement-box-title">Explore Games</p>

                <p class="achievement-box-text"><span class="bold">Enhance your creativity</span> 41+ games</p>
              </div>
            </div>

            <a class="button white-solid" href="{{ route('pages.game') }}">Browse All</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-grid full">
    <div class="container">
      <div class="row mb-4">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>

      <div class="row">
        <div class="col-md-8" id="most-recent">
          <h3>Most Recent</h3>
          <hr>
          @foreach ($articles as $article)
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
          <div class="mt-4 d-flex align-items-center">
            @if ($articles->onFirstPage())
              <span class="btn btn-outline-secondary disabled">&laquo; Previous</span>
            @else
              <a href="{{ $articles->previousPageUrl() }}#most-recent" class="btn btn-outline-primary">&laquo;
                Previous</a>
            @endif

            <div class="flex-grow-1 text-center mx-3">
              <span class="text-muted">Page {{ $articles->currentPage() }} of {{ $articles->lastPage() }}</span>
            </div>

            @if ($articles->hasMorePages())
              <a href="{{ $articles->nextPageUrl() }}#most-recent" class="btn btn-outline-primary">Next &raquo;</a>
            @else
              <span class="btn btn-outline-secondary disabled">Next &raquo;</span>
            @endif
          </div>
        </div>

        <div class="col-md-4 pl-md-5 sticky-sidebar">
          <div class="sidebar-widget latest-tpl-4">
            <h3>Popular</h3>
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

  {{-- Ads --}}
  <div class="content-grid full">
    <div class="container">
      <div class="row my-5">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>

@endsection

@push('styles')
  <style>
    .btn-outline-primary {
      transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
      transform: translateY(-1px);
    }

    .btn-outline-secondary {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
@endpush
