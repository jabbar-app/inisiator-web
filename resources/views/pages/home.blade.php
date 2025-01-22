@extends('layouts.app')

@section('content')
  <main id="content">
    <!-- Section Featured -->
    <div class="section-featured featured-style-1">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h2 class="spanborder h4"><span>Editor's Pick</span></h2>
            <div class="row">
              @if ($featureds && $featureds->count() > 0)
                <!-- Artikel Pertama -->
                @php $firstFeature = $featureds->first(); @endphp
                @if ($firstFeature && $firstFeature->slug && $firstFeature->user && $firstFeature->category)
                  <div class="col-md-6">
                    <article class="first mb-3">
                      <figure>
                        <a href="{{ route('articles.show', $firstFeature->slug) }}">
                          <img
                            src="{{ $firstFeature->img_featured ? asset($firstFeature->img_featured) : asset('assets/images/thumb/thumb-1240x700.jpg') }}"
                            alt="{{ $firstFeature->title }}">
                        </a>
                      </figure>
                      <h3 class="entry-title mb-3">
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

                <!-- Artikel Lainnya -->
                <div class="col-md-6">
                  @foreach ($featureds->skip(1) as $feature)
                    @if ($feature && $feature->slug && $feature->user && $feature->category)
                      <article class="post-has-bg mb-3">
                        <div class="d-flex row">
                          <figure class="col-4">
                            <a href="{{ route('articles.show', $feature->slug) }}">
                              <img
                                src="{{ $feature->img_featured ? asset($feature->img_featured) : asset('assets/images/thumb/thumb-700x512.jpg') }}"
                                alt="{{ $feature->title }}">
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

          <!-- Trending Section -->
          <div class="col-md-3">
            <h4 class="spanborder"><span>Trending</span></h4>
            <ol>
              @foreach ($featureds->take(4) as $trend)
                @if ($trend && $trend->slug)
                  <li>
                    <h5><a href="{{ route('articles.show', $trend->slug) }}">{{ $trend->title }}</a></h5>
                  </li>
                @endif
              @endforeach
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            @include('components.adsense-responsive')
          </div>
        </div>
      </div>
    </div>

    <!-- Content Widget: Editors' Pick -->
    <div class="content-widget">
      <div class="container">
        <div class="row justify-content-between post-has-bg">
          @if ($editorsPick && $editorsPick->slug && $editorsPick->category && $editorsPick->user)
            <div class="col-lg-6">
              <div class="pt-5 pb-5 pl-md-5 pr-5 align-self-center">
                <div class="capsSubtle mb-2">Editors' Pick</div>
                <h2 class="entry-title mb-3">
                  <a href="{{ route('articles.show', $editorsPick->slug) }}">{{ $editorsPick->title }}</a>
                </h2>
                <div class="entry-excerpt">
                  <p>{{ Str::limit(strip_tags($editorsPick->content), 150) }}</p>
                </div>
                <div class="entry-meta">
                  @if ($editorsPick->user && $editorsPick->user->username)
                    <a
                      href="{{ route('pages.author', $editorsPick->user->username) }}">{{ $editorsPick->user->name }}</a>
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

    <!-- Most Recent Articles -->
    <div class="content-widget">
      <div class="container">
        <div class="row">
          <!-- Artikel Terbaru -->
          <div class="col-md-8">
            <h2 class="spanborder h4"><span>Most Recent</span></h2>
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
            <div class="mt-4">{{ $articles->links() }}</div>
          </div>

          <!-- Popular Articles -->
          <div class="col-md-4 pl-md-5 sticky-sidebar">
            <div class="sidebar-widget latest-tpl-4">
              <h4 class="spanborder"><span>Popular</span></h4>
              <ol>
                @foreach ($popularArticles as $index => $popular)
                  @if ($popular && $popular->slug && $popular->category && $popular->user)
                    <li class="d-flex">
                      <div class="post-count">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                      <div class="post-content">
                        <h5 class="entry-title mb-3">
                          <a href="{{ route('articles.show', $popular->slug) }}">{{ $popular->title }}</a>
                        </h5>
                        <div class="entry-meta align-items-center">
                          @if ($popular->user && $popular->user->username)
                            <a
                              href="{{ route('pages.author', $popular->user->username) }}">{{ $popular->user->name }}</a>
                          @else
                            <span>Unknown Author</span>
                          @endif
                          in
                          @if ($popular->category && $popular->category->slug)
                            <a
                              href="{{ route('categories.show', $popular->category->slug) }}">{{ $popular->category->title }}</a>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
