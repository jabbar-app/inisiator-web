@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="container">
      <!-- Entry Header -->
      <div class="entry-header mb-5">
        <h1 class="entry-title mb-4 fw-normal">{{ $article->title }}</h1>
        <div class="entry-meta align-items-center">
          <a href="{{ route('pages.author', $article->user->username) }}" class="author-avatar">
            <img src="{{ $article->user->avatar ?? asset('assets/img/profpic.svg') }}" alt="{{ $article->user->name }}">
          </a>
          <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
          in <a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a><br>
          <span>{{ $article->created_at->format('d M Y') }}</span>
          <span class="middotDivider"></span>
          <span class="readingTime" title="{{ $article->reading_time }} min read">{{ $article->reading_time }} min
            read</span>
        </div>
      </div>

      <!-- Featured Image -->
      @if ($article->img_featured)
        <figure class="image zoom mb-5">
          <img src="{{ asset($article->img_featured) }}" alt="{{ $article->title }}" class="img-fluid">
        </figure>
      @endif

      <!-- Main Content -->
      <article class="entry-wraper mb-5">
        <div class="entry-left-col">
          <div class="social-sticky">
            <a href="#"><i class="icon-facebook"></i></a>
            <a href="#"><i class="icon-twitter"></i></a>
            <a href="#"><i class="icon-heart"></i></a>
            <a href="#"><i class="icon-paper-plane"></i></a>
          </div>
        </div>
        @include('components.adsense-responsive')

        <div class="entry-main-content">
          {!! $article->content !!}

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
              <img src="{{ $article->user->avatar ?? asset('assets/img/profpic.svg') }}"
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
