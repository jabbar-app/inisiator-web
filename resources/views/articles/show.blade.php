@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <article class="post-open">
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

        {{-- <div class="content-actions">
          <div class="content-action">
            <div class="meta-line">
              <div class="meta-line-list reaction-item-list">
                <div class="reaction-item">
                  <img class="reaction-image reaction-item-dropdown-trigger"
                    src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy">

                  <div class="simple-dropdown padded reaction-item-dropdown">
                    <p class="simple-dropdown-text"><img class="reaction"
                        src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy"> <span
                        class="bold">Happy</span></p>

                    <p class="simple-dropdown-text">Matt Parker</p>

                    <p class="simple-dropdown-text">Destroy Dex</p>

                    <p class="simple-dropdown-text">The Green Goo</p>
                  </div>
                </div>

                <div class="reaction-item">
                  <img class="reaction-image reaction-item-dropdown-trigger"
                    src="{{ asset('assets/img/reactions/love.webp') }}" alt="reaction-love">

                  <div class="simple-dropdown padded reaction-item-dropdown">
                    <p class="simple-dropdown-text"><img class="reaction"
                        src="{{ asset('assets/img/reactions/love.webp') }}" alt="reaction-love"> <span
                        class="bold">Love</span></p>

                    <p class="simple-dropdown-text">Sandra Strange</p>
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

                    <p class="simple-dropdown-text">Jett Spiegel</p>

                    <p class="simple-dropdown-text">Marcus Jhonson</p>

                    <p class="simple-dropdown-text">Jane Rodgers</p>

                    <p class="simple-dropdown-text"><span class="bold">and 2 more...</span></p>
                  </div>
                </div>
              </div>

              <p class="meta-line-text">12</p>
            </div>

            <div class="meta-line">
              <div class="meta-line-list user-avatar-list">
                <div class="user-avatar micro no-stats">
                  <div class="user-avatar-border">
                    <div class="hexagon-22-24"></div>
                  </div>

                  <div class="user-avatar-content">
                    <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
                  </div>
                </div>

                <div class="user-avatar micro no-stats">
                  <div class="user-avatar-border">
                    <div class="hexagon-22-24"></div>
                  </div>

                  <div class="user-avatar-content">
                    <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
                  </div>
                </div>

                <div class="user-avatar micro no-stats">
                  <div class="user-avatar-border">
                    <div class="hexagon-22-24"></div>
                  </div>

                  <div class="user-avatar-content">
                    <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
                  </div>
                </div>

                <div class="user-avatar micro no-stats">
                  <div class="user-avatar-border">
                    <div class="hexagon-22-24"></div>
                  </div>

                  <div class="user-avatar-content">
                    <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
                  </div>
                </div>

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
            </div>
          </div>

          <div class="content-action">
            <div class="meta-line">
              <p class="meta-line-link">3 Comments</p>
            </div>

            <div class="meta-line">
              <p class="meta-line-text">0 Shares</p>
            </div>
          </div>
        </div>

        <div class="post-options">
          <div class="post-option-wrap">
            <div class="post-option reaction-options-dropdown-trigger">
              <svg class="post-option-icon icon-thumbs-up">
                <use xlink:href="#svg-thumbs-up"></use>
              </svg>

              <p class="post-option-text">React!</p>
            </div>

            <div class="reaction-options reaction-options-dropdown">
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

        <div id="comments" class="post-comment-list">
          <div class="post-comment">
            <a class="user-avatar small no-outline" href="profile-timeline.html">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
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

                <p class="user-avatar-badge-text">6</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">Bearded
                Wonder</a>It's really inspiring to read about this and how you managed to get all up and running! Super
              awesome! Congratz <a href="profile-timeline.html">@MarinaValentine</a>!</p>

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
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">15 minutes ago</p>
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

          <div class="post-comment unread reply-2">
            <a class="user-avatar small no-outline" href="profile-timeline.html">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
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

                <p class="user-avatar-badge-text">5</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">The
                Green Goo</a>Yeah!! Totally agree!</p>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <div class="meta-line-list reaction-item-list small">
                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger"
                        src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction"
                            src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like"> <span
                            class="bold">Like</span></p>

                        <p class="simple-dropdown-text">Neko Bebop</p>
                      </div>
                    </div>
                  </div>

                  <p class="meta-line-text">1</p>
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
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">2 minutes ago</p>
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

          <div class="post-comment">
            <a class="user-avatar small no-outline" href="profile-timeline.html">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
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

                <p class="user-avatar-badge-text">16</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">Nick
                Grissom</a>I also started streaming with a simmilar game! I'm very excited to see what's next on your
              streams and for your next projects</p>

            <div class="content-actions">
              <div class="content-action">
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
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">27 minutes ago</p>
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

          <div class="post-comment">
            <a class="user-avatar small no-outline" href="profile-timeline.html">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
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

                <p class="user-avatar-badge-text">12</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">Neko
                Bebop</a>It was great to start this with you and keep streming together! I'm hoping that we can do this
              for many years to come...and for everyone else, keep posted because we have lots of surprises, including a
              sneak peek of upcoming games and new DLCs</p>

            <div class="content-actions">
              <div class="content-action">
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
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">39 minutes ago</p>
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

          <p class="post-comment-heading">Load More Comments <span class="highlighted">1+</span></p>

          <div class="post-comment-form">
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

            <form class="form">
              <div class="form-row">
                <div class="form-item">
                  <div class="form-input small">
                    <label for="post-reply">Your Reply</label>
                    <input type="text" id="post-reply" name="post_reply">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div> --}}
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
