@extends('templates.main')

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
          <div class="post-open-content-sidebar d-none d-md-block">
            <div class="user-avatar small no-outline">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32"
                  data-src="{{ !empty($article->user->avatar) ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}">
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

                <p class="user-avatar-badge-text">24</p>
              </div>
            </div>

            <p class="post-open-sidebar-title">Share</p>

            <div class="social-links vertical">
              <!-- Facebook -->
              <a class="social-link facebook"
                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FFF"
                  stroke="#FFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                </svg>
              </a>

              <!-- LinkedIn -->
              <a class="social-link linkedin"
                href="https://www.linkedin.com/shareArticle?url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($article->title) }}"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FFF"
                  class="icon icon-tabler icons-tabler-filled icon-tabler-brand-linkedin">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path
                    d="M17 2a5 5 0 0 1 5 5v10a5 5 0 0 1 -5 5h-10a5 5 0 0 1 -5 -5v-10a5 5 0 0 1 5 -5zm-9 8a1 1 0 0 0 -1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0 -1 -1m6 0a3 3 0 0 0 -1.168 .236l-.125 .057a1 1 0 0 0 -1.707 .707v5a1 1 0 0 0 2 0v-3a1 1 0 0 1 2 0v3a1 1 0 0 0 2 0v-3a3 3 0 0 0 -3 -3m-6 -3a1 1 0 0 0 -.993 .883l-.007 .127a1 1 0 0 0 1.993 .117l.007 -.127a1 1 0 0 0 -1 -1" />
                </svg>
              </a>

              <!-- Twitter/X -->
              <a class="social-link twitter"
                href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FFF"
                  stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-twitter">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path
                    d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" />
                </svg>
              </a>

              <!-- WhatsApp -->
              <a class="social-link whatsapp"
                href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . request()->fullUrl()) }}"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                  <path
                    d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                </svg>
              </a>

              <!-- Telegram -->
              <a class="social-link telegram"
                href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                </svg>
              </a>
            </div>
          </div>

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
                          <img class="reaction"
                            src="{{ asset('assets/img/reactions/' . strtolower($reaction) . '.webp') }}"
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
                  <a href="{{ route('login') }}" class="reaction-login-link">Login</a> to react!
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
              <a class="user-avatar small no-outline"
                href="{{ route('pages.author', $comment->article->user->username) }}">
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
      </div>
    </article>
  </div>

  <div class="content-grid medium">
    <div class="section-header medium">
      <div class="section-header-info">
        <p class="section-pretitle">Browse Other</p>
        <h2 class="section-title">Related Posts</h2>
      </div>
    </div>

    <div class="grid grid-4-4 centered">
      @foreach ($relatedPosts as $related)
        <div class="post-preview">
          <figure class="post-preview-image liquid">
            <a href="{{ route('articles.show', $related->slug) }}">
              <img src="{{ asset($related->img_featured) }}" alt="{{ $related->title }}">
            </a>
          </figure>

          <div class="post-preview-info">
            <div class="post-preview-info-top">
              <p class="post-preview-timestamp">{{ $related->created_at->format('d M Y') }}</p>
              <h5 class="post-preview-title">
                <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
              </h5>
            </div>
            <div class="post-preview-info-bottom">
              <p class="post-preview-text">{{ Str::words(strip_tags($related->content), 36, '...') }}</p>
              <a class="post-preview-link" href="{{ route('articles.show', $related->slug) }}">Read more</a>
            </div>
          </div>

          <div class="content-actions">
            <div class="content-action">
              <div class="meta-line">
                <div class="meta-line-list reaction-item-list">
                  <div class="reaction-item">
                    <img class="reaction-image reaction-item-dropdown-trigger"
                      src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy">
                    <div class="simple-dropdown padded reaction-item-dropdown">
                      <p class="simple-dropdown-text">
                        <img class="reaction" src="{{ asset('assets/img/reactions/happy.webp') }}"
                          alt="reaction-happy"> <span class="bold">Happy</span>
                      </p>
                    </div>
                  </div>
                  <div class="reaction-item">
                    <img class="reaction-image reaction-item-dropdown-trigger"
                      src="{{ asset('assets/img/reactions/love.webp') }}" alt="reaction-love">
                    <div class="simple-dropdown padded reaction-item-dropdown">
                      <p class="simple-dropdown-text">
                        <img class="reaction" src="{{ asset('assets/img/reactions/love.webp') }}" alt="reaction-love">
                        <span class="bold">Love</span>
                      </p>
                    </div>
                  </div>
                  <div class="reaction-item">
                    <img class="reaction-image reaction-item-dropdown-trigger"
                      src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">
                    <div class="simple-dropdown padded reaction-item-dropdown">
                      <p class="simple-dropdown-text">
                        <img class="reaction" src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">
                        <span class="bold">Like</span>
                      </p>
                    </div>
                  </div>
                </div>
                <p class="meta-line-text">0</p>
              </div>
            </div>

            <div class="content-action">
              <div class="meta-line">
                <a class="meta-line-link"
                  href="{{ route('articles.show', $related->slug) }}#comments">{{ $related->comments_count ?? 0 }}
                  Comments</a>
              </div>
              <div class="meta-line">
                <p class="meta-line-text">0 Shares</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Modal Login -->
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
          <form action="{{ route('login') }}" method="POST">
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
      document.addEventListener('DOMContentLoaded', function() {
        const loadMoreButton = document.querySelector('.load-more-comments');

        if (loadMoreButton) {
          loadMoreButton.addEventListener('click', function(e) {
            e.preventDefault();

            const articleId = this.dataset.articleId;
            const offset = parseInt(this.dataset.offset);
            const url = `/articles/${articleId}/comments?offset=${offset}`;

            fetch(url)
              .then(response => response.json())
              .then(data => {
                if (data.comments.length > 0) {
                  const commentList = document.getElementById('comments');

                  // Tambahkan komentar baru ke daftar
                  data.comments.forEach(comment => {
                    const commentHtml = `
                <div class="post-comment">
                  <p class="post-comment-text">
                    <a class="post-comment-text-author"
                      href="/author/${comment.user.username}">${comment.user.name}</a>
                    ${comment.content}
                  </p>
                </div>
              `;
                    commentList.insertAdjacentHTML('beforeend', commentHtml);
                  });

                  // Perbarui offset dan sisa komentar
                  const newOffset = offset + data.comments.length;
                  const newRemaining = data.totalComments - newOffset;

                  if (newRemaining > 0) {
                    loadMoreButton.dataset.offset = newOffset;
                    loadMoreButton.querySelector('.highlighted').textContent = `${newRemaining}+`;
                  } else {
                    loadMoreButton.remove(); // Sembunyikan tombol jika tidak ada komentar tersisa
                  }
                }
              })
              .catch(error => console.error('Error loading more comments:', error));
          });
        }
      });
    </script>
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
      document.addEventListener('DOMContentLoaded', function() {
        const commentForm = document.getElementById('commentForm');

        if (commentForm) {
          commentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action; // Gunakan URL dari atribut `action` form
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch(url, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json',
                },
                body: formData,
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  // Tambahkan komentar baru ke daftar komentar
                  const commentList = document.getElementById('comments');
                  const newComment = `
                    <div class="post-comment">
                      <a class="user-avatar small no-outline" href="/author/${data.comment.user.username}">
                      <div class="hexagon-image-30-32" data-src="${data.comment.user.avatar ? `${data.comment.user.avatar}` : '{{ asset('assets/img/profpic.svg') }}'}"></div>
                      </a>
                      <p class="post-comment-text">
                        <a class="post-comment-text-author" href="/author/${data.comment.user.username}">${data.comment.user.name}</a>
                        ${data.comment.content}
                      </p>
                      <div class="content-actions">
                        <div class="meta-line">
                          <p class="meta-line-timestamp">${data.comment.created_at}</p>
                        </div>
                      </div>
                    </div>
                  `;
                  commentList.insertAdjacentHTML('beforeend', newComment);

                  // Reset form
                  commentForm.reset();
                } else {
                  alert('Failed to add comment. Please try again.');
                }
              })
              .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
              });
          });
        }
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
