@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="container">
      <!-- Entry Header -->
      <div class="entry-header mb-5">
        <h1 class="entry-title mb-1 fw-normal">{{ $article->title }}</h1>
        <p class="text-muted mb-4">{{ $article->excerpt }}</p>
        <div class="entry-meta align-items-center">
          <a href="{{ route('pages.author', $article->user->username) }}" class="author-avatar">
            <img
              src="{{ !empty($article->user->avatar) ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}">
          </a>
          <div class="d-flex mb-1">
            <a href="{{ route('pages.author', $article->user->username) }}" style="font-size: 14px;">
              {{ $article->user->name }}
            </a>
            <span class="middotDivider"></span>
            @auth
              @if (auth()->user()->isFollowing($article->user))
                <form action="{{ route('users.unfollow', $article->user) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <a href="" class="text-danger">Unfollow</a>
                </form>
              @else
                <form action="{{ route('users.follow', $article->user) }}" method="POST">
                  @csrf
                  <a href="" class="text-primary">Follow</a>
                </form>
              @endif
            @else
              <form action="{{ route('users.follow', $article->user) }}" method="POST">
                @csrf
                <a href="" class="text-primary">Follow</a>
              </form>
            @endauth
          </div>
          Published in <a
            href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a>
          <span class="middotDivider"></span>
          <span class="readingTime" title="{{ $article->reading_time }} min read">{{ $article->reading_time }} min
            read</span>
          <span class="middotDivider"></span>
          <span>{{ $article->created_at->diffForHumans() }}</span>
        </div>
        <div class="mt-4 text-muted">
          <hr class="m-0">
          <small>
            <div class="row my-3">
              <div class="col-12">
                <div class="d-flex justify-content-between">
                  <div id="counter" class="d-flex" style="gap: 1rem;">
                    <div id="claps" class="d-flex" style="gap: 4px;">
                      @auth
                        <form action="{{ route('articles.clap', $article) }}" method="POST">
                          @csrf
                          <a href="{{ route('articles.clap', $article) }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            @if ($article->claps()->where('user_id', auth()->id())->exists())
                              <img src="{{ asset('assets/img/icons/clapped.svg') }}" alt="Clapped" height="14">
                            @else
                              <img src="{{ asset('assets/img/icons/clap.svg') }}" alt="Clap" height="14">
                            @endif
                          </a>
                        </form>
                      @else
                        <img src="{{ asset('assets/img/icons/clap.svg') }}" alt="Clap" height="14" style="margin-top: 3px;">
                      @endauth

                      {{ formatNumber($article->claps()->sum('claps_count')) }}
                    </div>
                    <div id="comments" class="d-flex" style="gap: 4px;">
                      <img src="{{ asset('assets/img/icons/comments.svg') }}" alt="Clap" height="15"
                        style="margin-top: 2px;"> 0
                    </div>
                  </div>

                  <div id="actions" class="d-flex" style="gap: 1rem;">
                    <div id="claps">
                      <i class="ti ti-thumb-up"></i> 10k
                    </div>
                    <div id="comments">
                      <i class="ti ti-thumb-up"></i> 10k
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </small>
          <hr class="m-0">
        </div>
      </div>
      <!-- Main Content -->
      <article class="entry-wraper mb-5">

        <!-- Featured Image -->
        @if ($article->img_featured)
          <figure class="image zoom mb-5">
            <img src="{{ asset($article->img_featured) }}" alt="{{ $article->title }}" class="img-fluid">
          </figure>
        @endif

        <div class="entry-main-content">
          <div id="article" data-id="{{ $article->id }}">
            {!! $article->content !!}
          </div>

          <section id="subscribe">
            <div class="border p-5 bg-lightblue mb-5">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              @if ($errors->any())
                <div class="alert alert-danger">
                  {{ $errors->first() }}
                </div>
              @endif

              <form action="{{ route('pages.subscribe') }}" method="POST" id="subscribe-form">
                @csrf
                <div class="row justify-content-between">
                  <div class="col-md-5 mb-2 mb-md-0">
                    <h5 class="font-weight-bold secondfont mb-3 mt-0">Become a member</h5>
                    <p class="small-text">Get the latest news right in your inbox. We never spam!</p>
                  </div>
                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-12">
                        <input type="email" name="email" id="email" class="form-control"
                          placeholder="Enter your e-mail address" required>
                      </div>
                      <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-success btn-block">Subscribe</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <script>
              document.getElementById('subscribe-form').addEventListener('submit', function(e) {
                const emailInput = document.getElementById('email');
                const email = emailInput.value;

                if (!validateEmail(email)) {
                  e.preventDefault();
                  alert('Please enter a valid email address.');
                }
              });

              function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
              }
            </script>
          </section>

          @include('components.adsense-responsive')
        </div>

        <!-- Tags Section -->
        <div class="entry-bottom">
          <div class="tags-wrap heading">
            <span class="tags">
              @foreach ($tags as $tag)
                <a href="{{ route('pages.tags', ['tag' => $tag]) }}" rel="tag">{{ $tag }}</a>
              @endforeach
            </span>
          </div>
        </div>

        <!-- Author Box -->
        <div class="box box-author mb-4">
          <div class="post-author d-flex">
            <div class="author-img">
              <img
                src="{{ !empty($article->user->avatar) ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}"
                alt="{{ $article->user->name }}" class="avatar">
            </div>
            <div class="author-content">
              <h5>
                <a href="{{ route('pages.author', $article->user->username) }}" class="text-decoration-none">
                  {{ $article->user->name }}
                  @if ($article->user->is_verified)
                    <img src="{{ asset('assets/img/badge.svg') }}" alt="" height="24" class="mb-1">
                  @endif
                </a>
              </h5>
              {{-- <p class="d-none d-md-block">{{ $article->user->bio }}</p> --}}
              <div class="profile-stats">
                <div class="d-flex mb-2" style="gap: 1rem;">
                  <div>
                    <p style="margin-bottom: -4px;">{{ $article->user->followers()->count() }}</p>
                    <small>followers</small>
                  </div>
                  <div>
                    <p style="margin-bottom: -4px;">{{ $article->user->followings()->count() }}</p>
                    <small>following</small>
                  </div>
                </div>
                @if (auth()->check() && $article->user->id != auth()->id())
                  <div class="my-2">
                    @if (auth()->user()->isFollowing($article->user))
                      <form action="{{ route('users.unfollow', $article->user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                      </form>
                    @else
                      <form action="{{ route('users.follow', $article->user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                      </form>
                    @endif
                  </div>
                @endif
              </div>

              <p class="d-none d-md-block">{{ $article->user->bio ?? 'Penulis belum menambahkan biografi.' }}</p>
              <div class="content-social-author">
                @if ($article->user->social_links)
                  @foreach (json_decode($article->user->social_links, true) as $platform => $link)
                    <a target="_blank" class="author-social" href="{{ $link }}">{{ ucfirst($platform) }}</a>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- Related Posts Section -->
      <div class="related-posts mb-5">
        <h4 class="spanborder text-center"><span>Related Posts</span></h4>
        <div class="row">
          @foreach ($relatedPosts as $related)
            <div class="col-md-4">
              <div class="d-flex mb-3">
                <figure class="col-md-5">
                  <a href="{{ route('articles.show', $related->slug) }}">
                    <img src="{{ asset($related->img_featured) }}" alt="{{ $related->title }}">
                  </a>
                </figure>
                <div class="entry-content col-md-7 pl-md-0">
                  <h5 class="entry-title mb-3">
                    <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
                  </h5>
                  <div class="entry-meta">
                    <a href="{{ route('pages.author', $related->user->username) }}">{{ $related->user->name }}</a><br>
                    <span>{{ $related->created_at->format('d M Y') }}</span>
                    <span class="middotDivider"></span>
                    <span class="readingTime">{{ $related->reading_time }} min read</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Comments Section -->
      <div class="single-comment comments_wrap">
        <section id="comments">
          <div class="comments-inner">
            <div id="respond" class="comment-respond">
              <h3 class="comment-reply-title">Leave a Reply</h3>
              <form action="{{ route('comments.store', $article->id) }}" method="POST" id="commentform"
                class="comment-form">
                @csrf
                <p class="comment-notes">
                  <span id="email-notes">Your email address will not be published.</span>
                  Required fields are marked <span class="required">*</span>
                </p>
                <p class="comment-form-comment">
                  <label for="comment">Comment</label>
                  <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <p>
                      <label for="author">Name*</label>
                      <input id="author" name="author" type="text" required>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <p>
                      <label for="email">Email*</label>
                      <input id="email" name="email" type="email" required>
                    </p>
                  </div>
                </div>
                <p class="form-submit">
                  <button type="submit" class="btn btn-inisiator py-2 px-4 rounded-pill">Post Comment</button>
                </p>
              </form>
            </div>

            <!-- Display Comments -->
            <div class="comments-list mt-5">
              <h4 class="mb-4">Comments ({{ $article->comments->count() }})</h4>
              @foreach ($article->comments as $comment)
                <div class="comment-item mb-3">
                  <h5>{{ $comment->author }}</h5>
                  <p class="text-muted">{{ $comment->created_at->format('d M Y') }}</p>
                  <p>{{ $comment->comment }}</p>
                </div>
              @endforeach
            </div>
          </div>
        </section>
      </div>

    </div>
  </main>
@endsection

@auth
  @push('scripts')
    <script>
      let readingTime = 0; // Waktu membaca (dalam detik)
      const readThreshold = 3; // 3 menit
      const articleId = document.getElementById("article").dataset.id;

      const timer = setInterval(() => {
        readingTime += 1;

        if (readingTime >= readThreshold) {
          markArticleAsRead(articleId);
          clearInterval(timer); // Hentikan timer setelah tercapai
        }
      }, 1000);

      function markArticleAsRead(articleId) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenMeta) {
          console.error("CSRF token meta tag is missing. Cannot send request.");
          return; // Exit the function if CSRF token is missing
        }

        const csrfToken = csrfTokenMeta.content;
        console.log("CSRF token found:", csrfToken); // Log the token for debugging

        fetch(`/articles/${articleId}/mark-read`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({}),
          })
          .then((response) => {
            if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
          })
          .then((data) => {
            console.log("Read recorded successfully:", data); // Log successful response
          })
          .catch((error) => {
            console.error("Error recording read:", error); // Log any errors
          });
      }
    </script>
  @endpush
@endauth
