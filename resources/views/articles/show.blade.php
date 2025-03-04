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

            <div class="tag-list">
              @foreach ($tags as $tag)
                <a href="{{ route('pages.tags', ['tag' => $tag]) }}" rel="tag"
                  class="tag-item secondary">{{ $tag }}</a>
              @endforeach
            </div>
          </div>
        </div>

        @include('articles.post-footer')
      </div>
    </article>
  </div>

  @include('articles.post-related')

  <!-- Tombol untuk membuka modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
    Login
  </button>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="loginForm" method="POST">
            @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@auth
  @push('scripts')
    <script>
      (() => {
        'use strict';

        const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content;
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        // Comment Templates
        const commentTemplates = {
          basic: (comment) => `
            <div class="post-comment">
              <p class="post-comment-text">
                <a class="post-comment-text-author" href="/author/${comment.user.username}">
                  ${comment.user.name}
                </a>
                ${comment.content}
              </p>
            </div>
          `,

          full: (comment) => `
            <div class="post-comment">
              <a class="user-avatar small no-outline" href="/author/${comment.user.username}">
                <div class="hexagon-image-30-32"
                     data-src="${comment.user.avatar || '{{ asset('assets/img/profpic.svg') }}'">
                </div>
              </a>
              <p class="post-comment-text">
                <a class="post-comment-text-author" href="/author/${comment.user.username}">
                  ${comment.user.name}
                </a>
                ${comment.content}
              </p>
              <div class="content-actions">
                <div class="meta-line">
                  <p class="meta-line-timestamp">${comment.created_at}</p>
                </div>
              </div>
            </div>
          `
        };

        // Auth Protection Handler
        const handleAuthRequired = (e) => {
          if (!isAuthenticated) {
            e.preventDefault();
            $('#loginModal').modal('show');
          }
        };

        // Load More Comments
        const initializeLoadMore = () => {
          const loadMoreButton = document.querySelector('.load-more-comments');
          if (!loadMoreButton) return;

          loadMoreButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const {
              articleId,
              offset
            } = loadMoreButton.dataset;
            const url = `/articles/${articleId}/comments?offset=${offset}`;

            try {
              const response = await fetch(url);
              const data = await response.json();

              if (data.comments.length === 0) {
                loadMoreButton.remove();
                return;
              }

              const commentList = document.getElementById('comments');
              data.comments.forEach(comment => {
                commentList.insertAdjacentHTML('beforeend', commentTemplates.basic(comment));
              });

              const newOffset = parseInt(offset) + data.comments.length;
              const remaining = data.totalComments - newOffset;

              loadMoreButton.dataset.offset = newOffset;
              remaining > 0 ?
                loadMoreButton.querySelector('.highlighted').textContent = `${remaining}+` :
                loadMoreButton.remove();
            } catch (error) {
              console.error('Error loading comments:', error);
            }
          });
        };

        // Comment Form Submission
        const initializeCommentForm = () => {
          const commentForm = document.getElementById('commentForm');
          if (!commentForm) return;

          commentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(commentForm);

            try {
              const response = await fetch(commentForm.action, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': getCsrfToken(),
                  'Accept': 'application/json',
                },
                body: formData,
              });

              const data = await response.json();
              if (!data.success) throw new Error('Comment submission failed');

              document.getElementById('comments').insertAdjacentHTML(
                'beforeend',
                commentTemplates.full(data.comment)
              );
              commentForm.reset();
            } catch (error) {
              console.error('Error:', error);
              alert('An error occurred. Please try again.');
            }
          });
        };

        // Reading Time Tracker
        const initializeReadingTracker = () => {
          const articleElement = document.getElementById('article');
          if (!articleElement) return;

          let readingTime = 0;
          const readThreshold = 180; // 3 minutes in seconds
          const articleId = articleElement.dataset.id;

          const timer = setInterval(async () => {
            if (++readingTime < readThreshold) return;

            try {
              await fetch(`/articles/${articleId}/mark-read`, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: JSON.stringify({}),
              });
              clearInterval(timer);
            } catch (error) {
              console.error('Error recording read:', error);
            }
          }, 1000);
        };

        // Login Form Handling
        const initializeLoginForm = () => {
          const loginForm = document.getElementById('loginForm');
          if (!loginForm) return;

          loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(loginForm);

            try {
              const response = await fetch('{{ route('login') }}', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': getCsrfToken(),
                  'Accept': 'application/json',
                },
                body: formData,
              });

              const data = await response.json();

              if (data.success) {
                window.location.reload(); // Refresh halaman setelah login berhasil
              } else {
                // Tampilkan error message
                const errorMessage = data.message || 'Login failed. Please check your credentials.';
                alert(errorMessage);
              }
            } catch (error) {
              console.error('Error:', error);
              alert('An error occurred during login.');
            }
          });
        };

        // Initialize all components
        document.addEventListener('DOMContentLoaded', () => {
          // Auth protected elements
          document.querySelectorAll([
            '.reaction-options-dropdown-trigger',
            '.reply-login-link',
            '.reaction-login-link' // Tambahkan class ini
          ].join(',')).forEach(element => {
            element.addEventListener('click', handleAuthRequired);
          });

          initializeLoadMore();
          initializeCommentForm();
          initializeReadingTracker();
          initializeLoginForm();
        });
      })
      ();
    </script>
  @endpush
@endauth
