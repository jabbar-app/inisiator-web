@extends('templates.main')

@section('title', $article->title)
@section('meta_description', $article->excerpt)
@section('meta_keywords', implode(', ', $article->tags->pluck('name')->toArray()))
@section('meta_image', asset($article->img_featured))
@section('content')
  <div class="content-grid full">
    <article class="post-open" id="article" data-id="{{ $article->id }}">
      <figure class="post-open-cover liquid">
        <img src="{{ asset('assets/img/bg.svg') }}" alt="">
      </figure>

      <div class="post-open-body">
        <div class="post-open-heading" style="font-weight: 500;">
          <h2 class="post-open-title mb-3">{{ $article->title }}</h2>
          <p class="mb-2" style="line-height: 20px;">
            Published in <a
              href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->title }}</a>
            &nbsp;·&nbsp;
            by <a href="{{ route('pages.author', $article->user->username) }}">{{ $article->user->name }}</a>
            &nbsp;·&nbsp;
            <span class="readingTime" title="{{ $article->reading_time }} min read">{{ $article->reading_time }}
              min
              read</span>
            &nbsp;·&nbsp;
            <span>{{ $article->created_at->diffForHumans() }}</span>
          </p>
        </div>

        <div class="post-open-content">
          @include('articles.post-sidebar-share')

          <div class="post-open-content-body">
            @if (!empty($article->img_featured))
              <figure class="post-open-image liquid rounded">
                <img src="{{ asset($article->img_featured) }}" alt="{{ $article->title }}">
              </figure>
              {{-- <p class="post-open-image-caption">{{ $article->title }}</p> --}}
            @endif

            {!! $content !!}



            <h4 class="mt-5 mb-0">Tags</h4>
            <div class="tag-list m-0">
              @foreach ($tags as $tag)
                <a href="{{ route('pages.tags', ['tag' => $tag]) }}" rel="tag"
                  class="tag-item secondary">{{ $tag }}</a>
              @endforeach
            </div>

            <div class="quest-item mt-5">
              <a href="#" class="text-sticker small-text">
                <svg class="text-sticker-icon icon-plus-small">
                  <use xlink:href="#svg-plus-small"></use>
                </svg>
                Follow
              </a>
              <div class="quest-item-info">
                <p class="quest-item-text fw-300 m-0">Written by:</p>
                <a href="{{ route('pages.author', $article->user->username) }}"
                  class="quest-item-title">{{ $article->user->name }}</a>
                <p class="quest-item-text fw-300">{{ $article->user->bio ?? 'This user hasn\'t setup their bio yet.' }}
                </p>
                <div class="quest-item-meta justify-content-between align-items-center">
                  <div class="quest-item-meta-info" style="margin-left: 0px;">
                    <p class="quest-item-meta-title">+{{ $article->user->articles->count() }} stories published</p>

                    <p class="quest-item-meta-text fw-300">+8,313 views gained</p>
                  </div>
                  <button class="button small secondary w-25 p-0">See More</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        @include('articles.post-footer')
      </div>
    </article>
  </div>

  @include('articles.post-related')
@endsection

@auth
  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const reactionTriggers = document.querySelectorAll('.reaction-options-dropdown-trigger');
        const replyTriggers = document.querySelectorAll('.reply-login-link');

        reactionTriggers.forEach(trigger => {
          trigger.addEventListener('click', function(e) {
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
              e.preventDefault();
              $('#loginModal').modal('show');
            }
          });
        });

        replyTriggers.forEach(trigger => {
          trigger.addEventListener('click', function(e) {
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
              e.preventDefault();
              $('#loginModal').modal('show');
            }
          });
        });
      });
    </script>
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
