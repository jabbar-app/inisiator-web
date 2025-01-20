@extends('layouts.app')

@section('content')
  <main id="content">
    <!-- Section Featured -->
    <div class="section-featured featured-style-1">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h2 class="spanborder h4"><span>Pilihan Editor</span></h2>
            <div class="row">
              @if ($featureds->count() > 0)
                <!-- Artikel Pertama -->
                @php $firstFeature = $featureds->first(); @endphp
                <div class="col-md-6">
                  <article class="first mb-3">
                    <figure>
                      <a href="{{ route('articles.show', $firstFeature->slug) }}">
                        <img
                          src="{{ $firstFeature->img_featured ? asset('storage/' . $firstFeature->img_featured) : asset('assets/images/thumb/thumb-1240x700.jpg') }}"
                          alt="{{ $firstFeature->title }}">
                      </a>
                    </figure>
                    <h3 class="entry-title mb-3">
                      <a href="{{ route('articles.show', $firstFeature->slug) }}">{{ $firstFeature->title }}</a>
                    </h3>
                    <div class="entry-meta">
                      <a
                        href="{{ route('pages.author', $firstFeature->user->username) }}">{{ $firstFeature->user->name }}</a>
                      in <a
                        href="{{ route('categories.show', $firstFeature->category->slug) }}">{{ $firstFeature->category->title }}</a><br>
                      <span>{{ $firstFeature->created_at->format('d M Y') }}</span>
                    </div>
                  </article>
                </div>

                <!-- Artikel Lainnya -->
                <div class="col-md-6">
                  @foreach ($featureds->skip(1) as $feature)
                    <article class="post-has-bg mb-3">
                      <div class="d-flex row">
                        <figure class="col-4">
                          <a href="{{ route('articles.show', $feature->slug) }}">
                            <img
                              src="{{ $feature->img_featured ? asset('storage/' . $feature->img_featured) : asset('assets/images/thumb/thumb-700x512.jpg') }}"
                              alt="{{ $feature->title }}">
                          </a>
                        </figure>
                        <div class="entry-content col-8">
                          <h5 class="entry-title">
                            <a href="{{ route('articles.show', $feature->slug) }}">{{ $feature->title }}</a>
                          </h5>
                          <div class="entry-meta">
                            <a
                              href="{{ route('pages.author', $feature->user->username) }}">{{ $feature->user->name }}</a>
                            in <a
                              href="{{ route('categories.show', $feature->category->slug) }}">{{ $feature->category->title }}</a><br>
                            <span>{{ $feature->created_at->format('d M Y') }}</span>
                          </div>
                        </div>
                      </div>
                    </article>
                  @endforeach
                </div>
              @endif
            </div>
          </div>

          <!-- Trending Section -->
          <div class="col-md-3">
            <h4 class="spanborder"><span>Trending</span></h4>
            <ol>
              @foreach ($featureds->take(4) as $index => $trend)
                <li>
                  <h5><a href="{{ route('articles.show', $trend->slug) }}">{{ $trend->title }}</a></h5>
                </li>
              @endforeach
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Widget: Editors' Pick -->
    <div class="content-widget">
      <div class="container">
        <div class="row justify-content-between post-has-bg">
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
                <a href="{{ route('pages.author', $editorsPick->user->username) }}">{{ $editorsPick->user->name }}</a>
                in <a
                  href="{{ route('categories.show', $editorsPick->category->slug) }}">{{ $editorsPick->category->title }}</a><br>
                <span>{{ $editorsPick->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 bgcover d-none d-md-block"
            style="background-image:url({{ $editorsPick->img_featured ? asset('storage/' . $editorsPick->img_featured) : asset('assets/images/thumb/thumb-800x495.jpg') }});">
          </div>
        </div>
      </div>
    </div>

    <div class="content-widget">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <div class="row justify-content-between">
              @foreach ($articlesSection as $article)
                <article class="col-md-6">
                  <div class="mb-3 d-flex row">
                    <figure class="col-md-5">
                      <a href="{{ route('articles.show', $article->slug) }}">
                        <img
                          src="{{ $article->img_featured ? asset('storage/' . $article->img_featured) : asset('assets/images/thumb/thumb-512x512.jpg') }}"
                          alt="{{ $article->title }}">
                      </a>
                    </figure>
                    <div class="entry-content col-md-7 pl-md-0">
                      <h5 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                      </h5>
                      <div class="entry-excerpt">
                        <p>{{ Str::limit(strip_tags($article->content), 100) }}</p>
                      </div>
                      <div class="entry-meta align-items-center">
                        <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
                        in <a
                          href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a><br>
                        <span>{{ $article->created_at->format('M d') }}</span>
                        <span class="middotDivider"></span>
                        <span class="readingTime" title="3 min read">3 min read</span>
                        <span class="svgIcon svgIcon--star">
                          <svg class="svgIcon-use" width="15" height="15">
                            <path
                              d="M7.438 2.324c.034-.099.09-.099.123 0l1.2 3.53a.29.29 0 0 0 .26.19h3.884c.11 0 .127.049.038.111L9.8 8.327a.271.271 0 0 0-.099.291l1.2 3.53c.034.1-.011.131-.098.069l-3.142-2.18a.303.303 0 0 0-.32 0l-3.145 2.182c-.087.06-.132.03-.099-.068l1.2-3.53a.271.271 0 0 0-.098-.292L2.056 6.146c-.087-.06-.071-.112.038-.112h3.884a.29.29 0 0 0 .26-.19l1.2-3.52z">
                            </path>
                          </svg>
                        </span>
                      </div>
                    </div>
                  </div>
                </article>
              @endforeach
            </div>
          </div>
          <div class="col-md-2">
            <div class="sidebar-widget ads">
              @include('components.adsense-responsive')
            </div>
          </div>
        </div>
        <div class="divider-2"></div>
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
                      <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
                      in <a
                        href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a><br>
                      <span>{{ $article->created_at->format('d M Y') }}</span>
                      <span class="middotDivider"></span>
                      <span class="readingTime" title="3 min read">3 min read</span>
                      <span class="svgIcon svgIcon--star">
                        <svg class="svgIcon-use" width="15" height="15">
                          <path
                            d="M7.438 2.324c.034-.099.09-.099.123 0l1.2 3.53a.29.29 0 0 0 .26.19h3.884c.11 0 .127.049.038.111L9.8 8.327a.271.271 0 0 0-.099.291l1.2 3.53c.034.1-.011.131-.098.069l-3.142-2.18a.303.303 0 0 0-.32 0l-3.145 2.182c-.087.06-.132.03-.099-.068l1.2-3.53a.271.271 0 0 0-.098-.292L2.056 6.146c-.087-.06-.071-.112.038-.112h3.884a.29.29 0 0 0 .26-.19l1.2-3.52z">
                          </path>
                        </svg>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 bgcover"
                  style="background-image:url({{ $article->img_featured ? asset('storage/' . $article->img_featured) : asset('assets/images/thumb/thumb-512x512.jpg') }});">
                </div>
              </article>
            @endforeach
            <div class="mt-4">{{ $articles->links() }}</div>
          </div>

          <!-- Popular Articles -->
          <div class="col-md-4 pl-md-5 sticky-sidebar">
            <div class="sidebar-widget latest-tpl-4">
              <h4 class="spanborder"><span>Popular</span></h4>
              <ol>
                @foreach ($popularArticles as $index => $popular)
                  <li class="d-flex">
                    <div class="post-count">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="post-content">
                      <h5 class="entry-title mb-3">
                        <a href="{{ route('articles.show', $popular->slug) }}">{{ $popular->title }}</a>
                      </h5>
                      <div class="entry-meta align-items-center">
                        <a href="{{ route('pages.author', $popular->user->username) }}">{{ $popular->user->name }}</a>
                        in <a
                          href="{{ route('categories.show', $popular->category->slug) }}">{{ $popular->category->title }}</a><br>
                        <span>{{ $popular->created_at->format('d M Y') }}</span>
                        <span class="middotDivider"></span>
                        <span class="readingTime" title="3 min read">3 min read</span>
                        <span class="svgIcon svgIcon--star">
                          <svg class="svgIcon-use" width="15" height="15">
                            <path
                              d="M7.438 2.324c.034-.099.09-.099.123 0l1.2 3.53a.29.29 0 0 0 .26.19h3.884c.11 0 .127.049.038.111L9.8 8.327a.271.271 0 0 0-.099.291l1.2 3.53c.034.1-.011.131-.098.069l-3.142-2.18a.303.303 0 0 0-.32 0l-3.145 2.182c-.087.06-.132.03-.099-.068l1.2-3.53a.271.271 0 0 0-.098-.292L2.056 6.146c-.087-.06-.071-.112.038-.112h3.884a.29.29 0 0 0 .26-.19l1.2-3.52z">
                            </path>
                          </svg>
                        </span>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="content-widget my-4">
      <div class="container">
        <div class="sidebar-widget ads">
          @include('components.adsense-responsive')
        </div>
        <div class="hr"></div>
      </div>
    </div>
  </main>
@endsection
