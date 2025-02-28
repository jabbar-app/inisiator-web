@extends('templates.main')

@section('content')

  <div style="margin-top: 80px;"></div>

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
                    <article class="first mb-3">
                      <figure>
                        <a href="{{ route('articles.show', $firstFeature->slug) }}">
                          <img
                            src="{{ $firstFeature->img_featured ? asset($firstFeature->img_featured) : asset('assets/images/thumb/thumb-1240x700.jpg') }}"
                            alt="{{ $firstFeature->title }}" class="w-100 rounded mb-2">
                        </a>
                      </figure>
                      <h3 class="entry-title mb-1">
                        <a href="{{ route('articles.show', $firstFeature->slug) }}">{{ $firstFeature->title }}</a>
                      </h3>
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
                        <span>{{ $firstFeature->created_at->format('d M Y') }}</span>
                      </div>
                    </article>
                  </div>
                @endif

                <div class="col-md-6">
                  @foreach ($featureds->skip(1) as $feature)
                    @if ($feature && $feature->slug && $feature->user && $feature->category)
                      <article class="post-has-bg m-3">
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
                              <a href="{{ route('articles.show', $feature->slug) }}">{{ $feature->title }}</a>
                            </h5>
                            <div class="entry-meta">
                              @if ($feature->user && $feature->user->username)
                                <a
                                  href="{{ route('pages.author', $feature->user->username) }}">{{ $feature->user->name }}</a>
                              @else
                                <span>Unknown Author</span>
                              @endif
                              in
                              @if ($feature->category && $feature->category->slug)
                                <a
                                  href="{{ route('categories.show', $feature->category->slug) }}">{{ $feature->category->title }}</a>
                              @else
                                <span>Uncategorized</span>
                              @endif
                              <br>
                              <span>{{ $feature->created_at->format('d M Y') }}</span>
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
            <style>
              .fw-bold {
                font-weight: 500;
              }
            </style>
            <ol>
              @foreach ($featureds->take(4) as $trend)
                @if ($trend && $trend->slug)
                  <li class="mb-3">
                    <h5><a href="{{ route('articles.show', $trend->slug) }}">{{ $trend->title }}</a></h5>
                    <p>
                      <small>by <strong>{{ $trend->user->name }}</strong></small>
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

  <div class="content-grid full">
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
                <a href="{{ route('articles.show', $editorsPick->slug) }}">{{ $editorsPick->title }}</a>
              </h2>
              <div class="entry-excerpt">
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
                <span>{{ $editorsPick->created_at->format('d M Y') }}</span>
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
      <div class="row">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>

  <div class="content-grid p-0" style="transform: translate(140.5px, 0px); transition: transform 0.4s ease-in-out;">
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

  <div class="content-grid full">
    <div class="container">
      <div class="row mb-2">
        <div class="col-12">
          @include('components.adsense-responsive')
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <h3>Most Recent</h3>
          <hr>
          @foreach ($articles as $article)
            @if ($article && $article->slug && $article->category && $article->user)
              <article class="row justify-content-between mb-5 mr-0">
                <div class="col-md-9">
                  <div class="align-self-center">
                    <div class="capsSubtle mb-2">{{ $article->category->title }}</div>
                    <h3 class="entry-title mb-3">
                      <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>
                    <div class="entry-excerpt">
                      <p>{{ Str::limit(strip_tags($article->content), 150) }}</p>
                    </div>
                    <div class="entry-meta align-items-center">
                      @if ($article->user && $article->user->username)
                        <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
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
          {{-- <div class="mt-4">
            {{ $articles->links() }}
          </div> --}}
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

@endsection
