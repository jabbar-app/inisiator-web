<div class="content-actions">
  <div class="content-action">
    <div class="meta-line">
      <div class="meta-line-list reaction-item-list">
        @foreach (['Like', 'Love', 'Dislike', 'Happy', 'Funny', 'Wow', 'Angry', 'Sad'] as $reaction)
          @if (isset($reactions[$reaction]) && count($reactions[$reaction]) > 0)
            <div class="reaction-item" style="position: relative;">
              <img class="reaction-image reaction-item-dropdown-trigger"
                src="{{ asset('assets/img/reactions/' . strtolower($reaction) . '.webp') }}"
                alt="reaction-{{ strtolower($reaction) }}">

              <div class="simple-dropdown padded reaction-item-dropdown"
                style="position: absolute; z-index: 9999; bottom: 38px; left: -16px; opacity: 0; visibility: hidden; transform: translate(0px, 20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                <p class="simple-dropdown-text">
                  <img class="reaction" src="{{ asset('assets/img/reactions/' . strtolower($reaction) . '.webp') }}"
                    alt="reaction-{{ strtolower($reaction) }}">
                  <span class="bold">{{ $reaction }}</span>
                </p>

                @foreach ($reactions[$reaction] as $name)
                  <p class="simple-dropdown-text">{{ $name }}</p>
                @endforeach

                @if (count($reactions[$reaction]) > 5)
                  <p class="simple-dropdown-text">
                    <span class="bold">and {{ count($reactions[$reaction]) - 5 }} more...</span>
                  </p>
                @endif
              </div>
            </div>
          @endif
        @endforeach
      </div>

      <p class="meta-line-text">{{ number_format($article->reactions->count()) }}</p>
    </div>

    {{-- <div class="meta-line">
        <div class="meta-line-list user-avatar-list">
          <div class="user-avatar micro no-stats">
            <div class="user-avatar-border">
              <div class="hexagon-22-24"></div>
            </div>

            <div class="user-avatar-content">
              <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
            </div>
          </div>
        </div>

        <p class="meta-line-text">14 Participants</p>
      </div> --}}
  </div>

  <div class="content-action">
    <div class="meta-line">
      <p class="meta-line-link">{{ $article->comments->count() }} Comments</p>
    </div>

    <div class="meta-line">
      <p class="meta-line-text">{{ $article->share_count }} Shares</p>
    </div>
  </div>
</div>

<div class="post-options">
  <div class="post-option-wrap" style="position: relative;">
    <div class="post-option reaction-options-dropdown-trigger">
      <svg class="post-option-icon icon-thumbs-up">
        <use xlink:href="#svg-thumbs-up"></use>
      </svg>
      <p class="post-option-text">React!</p>
    </div>

    <!-- Dropdown untuk pilihan reaksi -->
    <div class="reaction-options reaction-options-dropdown">
      @auth
        @foreach (['Like', 'Love', 'Dislike', 'Happy', 'Funny', 'Wow', 'Angry', 'Sad'] as $reaction)
          <form action="{{ route('article-reactions.store') }}" method="POST" class="reaction-form">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="content" value="{{ $reaction }}">
            <button type="submit" class="reaction-option text-tooltip-tft" data-title="{{ $reaction }}"
              style="margin-right: 8px;">
              <img class="reaction-option-image"
                src="{{ asset('assets/img/reactions/' . strtolower($reaction) . '.webp') }}"
                alt="reaction-{{ strtolower($reaction) }}">
            </button>
          </form>
        @endforeach
      @else
        <p class="reaction-login-message text-nowrap">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
            data-bs-target="#loginModal">Login</button>
        </p>
      @endauth
    </div>
  </div>

  <div class="post-option active">
    <svg class="post-option-icon icon-comment">
      <use xlink:href="#svg-comment"></use>
    </svg>

    <p class="post-option-text">Comment</p>
  </div>

  <div class="post-option">
    <svg class="post-option-icon icon-share">
      <use xlink:href="#svg-share"></use>
    </svg>

    <p class="post-option-text">Share</p>
  </div>
</div>

@php
  $totalComments = $article->comments->count();
  $displayedComments = 5; // Jumlah komentar yang ditampilkan awal
  $remainingComments = $totalComments - $displayedComments;
@endphp

<div id="comments" class="post-comment-list">
  @foreach ($article->comments->slice(0, $displayedComments) as $comment)
    <div class="post-comment">
      <a class="user-avatar small no-outline" href="{{ route('pages.author', $comment->article->user->username) }}">
        <div class="user-avatar-content">
          <div class="hexagon-image-30-32"
            data-src="{{ !empty($comment->article->user->avatar) ? asset($comment->article->user->avatar) : asset('assets/img/profpic.svg') }}">
          </div>
        </div>

        <div class="user-avatar-progress">
          <div class="hexagon-progress-40-44"></div>
        </div>

        <div class="user-avatar-progress-border">
          <div class="hexagon-border-40-44"></div>
        </div>

        <div class="user-avatar-badge">
          <div class="user-avatar-badge-border">
            <div class="hexagon-22-24"></div>
          </div>

          <div class="user-avatar-badge-content">
            <div class="hexagon-dark-16-18"></div>
          </div>

          <p class="user-avatar-badge-text">{{ $comment->article->user->level }}</p>
        </div>
      </a>

      <p class="post-comment-text">
        <a class="post-comment-text-author"
          href="{{ route('pages.author', $comment->article->user->username) }}">{{ $comment->article->user->name }}</a>
        {{ $comment->content }}
      </p>

      <div class="content-actions">
        <div class="content-action">
          <div class="meta-line">
            <div class="meta-line-list reaction-item-list small">
              <div class="reaction-item">
                <img class="reaction-image reaction-item-dropdown-trigger"
                  src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy">

                <div class="simple-dropdown padded reaction-item-dropdown">
                  <p class="simple-dropdown-text"><img class="reaction"
                      src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy"> <span
                      class="bold">Happy</span></p>

                  <p class="simple-dropdown-text">Marcus Jhonson</p>
                </div>
              </div>

              <div class="reaction-item">
                <img class="reaction-image reaction-item-dropdown-trigger"
                  src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">

                <div class="simple-dropdown padded reaction-item-dropdown">
                  <p class="simple-dropdown-text"><img class="reaction"
                      src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like"> <span
                      class="bold">Like</span></p>

                  <p class="simple-dropdown-text">Neko Bebop</p>

                  <p class="simple-dropdown-text">Nick Grissom</p>

                  <p class="simple-dropdown-text">Sarah Diamond</p>
                </div>
              </div>
            </div>

            <p class="meta-line-text">4</p>
          </div>

          <div class="meta-line">
            <p class="meta-line-link light reaction-options-small-dropdown-trigger">React!</p>

            <div class="reaction-options small reaction-options-small-dropdown">
              <div class="reaction-option text-tooltip-tft" data-title="Like">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/like.webp') }}"
                  alt="reaction-like">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Love">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/love.webp') }}"
                  alt="reaction-love">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/dislike.webp') }}"
                  alt="reaction-dislike">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Happy">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/happy.webp') }}"
                  alt="reaction-happy">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Funny">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/funny.webp') }}"
                  alt="reaction-funny">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Wow">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/wow.webp') }}"
                  alt="reaction-wow">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Angry">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/angry.webp') }}"
                  alt="reaction-angry">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Sad">
                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/sad.webp') }}"
                  alt="reaction-sad">
              </div>
            </div>
          </div>

          <div class="meta-line">
            @auth
              <p class="meta-line-link light">Reply</p>
            @else
              <p class="meta-line-link light">
                <a href="{{ route('login') }}" class="reply-login-link">Login</a> to reply
              </p>
            @endauth
          </div>

          <div class="meta-line">
            <p class="meta-line-timestamp">{{ $comment->updated_at->diffForHumans() }}</p>
          </div>

          <div class="meta-line settings">
            <div class="post-settings-wrap">
              <div class="post-settings post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown post-settings-dropdown">
                <p class="simple-dropdown-link">Report Post</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @foreach ($comment->replies as $reply)
      <div class="post-comment unread reply-2">
        <a class="user-avatar small no-outline"
          href="{{ route('pages.author', $reply->comment->article->user->username) }}">
          <div class="user-avatar-content">
            <div class="hexagon-image-30-32"
              data-src="{{ !empty($reply->comment->article->user->avatar) ? asset($reply->comment->article->user->avatar) : asset('assets/img/profpic.svg') }}">
            </div>
          </div>

          <div class="user-avatar-progress">
            <div class="hexagon-progress-40-44"></div>
          </div>

          <div class="user-avatar-progress-border">
            <div class="hexagon-border-40-44"></div>
          </div>

          <div class="user-avatar-badge">
            <div class="user-avatar-badge-border">
              <div class="hexagon-22-24"></div>
            </div>

            <div class="user-avatar-badge-content">
              <div class="hexagon-dark-16-18"></div>
            </div>

            <p class="user-avatar-badge-text">{{ $reply->comment->article->user->level }}</p>
          </div>
        </a>

        <p class="post-comment-text">
          <a class="post-comment-text-author"
            href="{{ route('pages.author', $reply->comment->article->user->username) }}">{{ $reply->comment->article->user->name }}</a>
          {{ $comment->content }}
        </p>

        <div class="content-actions">
          <div class="content-action">
            <div class="meta-line">
              <p class="meta-line-timestamp">{{ $reply->updated_at->diffForHumans() }}</p>
            </div>

            <div class="meta-line settings">
              <div class="post-settings-wrap">
                <div class="post-settings post-settings-dropdown-trigger">
                  <svg class="post-settings-icon icon-more-dots">
                    <use xlink:href="#svg-more-dots"></use>
                  </svg>
                </div>

                <div class="simple-dropdown post-settings-dropdown">
                  <p class="simple-dropdown-link">Report Comment</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endforeach

  @if ($remainingComments > 0)
    <p class="post-comment-heading">
      <a href="#" class="load-more-comments" data-article-id="{{ $article->id }}"
        data-offset="{{ $displayedComments }}">
        Load More Comments <span class="highlighted">{{ $remainingComments }}+</span>
      </a>
    </p>
  @endif

  <div class="post-comment-form">
    @auth
      <div class="user-avatar small no-outline">
        <div class="user-avatar-content">
          <div class="hexagon-image-30-32"
            data-src="{{ !empty($article->user->avatar) ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}">
          </div>
        </div>
      </div>

      <form id="commentForm" action="{{ route('article-comments.store', $article->id) }}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="form-row">
          <div class="form-item">
            <div class="form-input small">
              <label for="post-reply">Your Reply</label>
              <textarea id="post-reply" name="content" rows="2" required></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="button primary">Submit</button>
      </form>
    @else
      <p class="comment-login-message">
        <a href="{{ route('login') }}" class="comment-login-link">Login</a> to leave a comment.
      </p>
    @endauth
  </div>
</div>
