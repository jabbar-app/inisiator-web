@extends('templates.main')

@section('content')
  <div class="content-grid">
    <div class="profile-header">
      <figure class="profile-header-cover liquid">
        <img src="{{ $author->cover ? asset($author->cover) : asset('assets/img/backgrounds/cover.webp') }}" alt="cover-01">
      </figure>

      <div class="profile-header-info">
        <div class="user-short-description big">
          <a class="user-short-description-avatar user-avatar big" href="{{ route('pages.author', $author->username) }}">
            <div class="user-avatar-border">
              <div class="hexagon-148-164"></div>
            </div>

            <div class="user-avatar-content">
              <div class="hexagon-image-100-110"
                data-src="{{ $author->avatar ? asset($author->avatar) : asset('assets/img/profpic.svg') }}"></div>
            </div>

            <div class="user-avatar-progress">
              <div class="hexagon-progress-124-136"></div>
            </div>

            <div class="user-avatar-progress-border">
              <div class="hexagon-border-124-136"></div>
            </div>

            <div class="user-avatar-badge">
              <div class="user-avatar-badge-border">
                <div class="hexagon-40-44"></div>
              </div>

              <div class="user-avatar-badge-content">
                <div class="hexagon-dark-32-34"></div>
              </div>

              <p class="user-avatar-badge-text">24</p>
            </div>
          </a>

          <a class="user-short-description-avatar user-short-description-avatar-mobile user-avatar medium"
            href="profile-timeline.html">
            <div class="user-avatar-border">
              <div class="hexagon-120-132"></div>
            </div>

            <div class="user-avatar-content">
              <div class="hexagon-image-82-90" data-src="img/avatar/01.jpg"></div>
            </div>

            <div class="user-avatar-progress">
              <div class="hexagon-progress-100-110"></div>
            </div>

            <div class="user-avatar-progress-border">
              <div class="hexagon-border-100-110"></div>
            </div>

            <div class="user-avatar-badge">
              <div class="user-avatar-badge-border">
                <div class="hexagon-32-36"></div>
              </div>

              <div class="user-avatar-badge-content">
                <div class="hexagon-dark-26-28"></div>
              </div>

              <p class="user-avatar-badge-text">24</p>
            </div>
          </a>

          <p class="user-short-description-title"><a
              href="{{ route('pages.author', $author->username) }}">{{ $author->name }}</a></p>

          <p class="user-short-description-text">{{ '@' . $author->username }}</p>
        </div>

        <div class="profile-header-social-links-wrap">
          <div id="profile-header-social-links-slider" class="profile-header-social-links">
            <div class="profile-header-social-link">
              <a class="social-link facebook" href="#">
                <svg class="icon-facebook">
                  <use xlink:href="#svg-facebook"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link twitter" href="#">
                <svg class="icon-twitter">
                  <use xlink:href="#svg-twitter"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link instagram" href="#">
                <svg class="icon-instagram">
                  <use xlink:href="#svg-instagram"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link twitch" href="#">
                <svg class="icon-twitch">
                  <use xlink:href="#svg-twitch"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link youtube" href="#">
                <svg class="icon-youtube">
                  <use xlink:href="#svg-youtube"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link patreon" href="#">
                <svg class="icon-patreon">
                  <use xlink:href="#svg-patreon"></use>
                </svg>
              </a>
            </div>

            <div class="profile-header-social-link">
              <a class="social-link discord" href="#">
                <svg class="icon-discord">
                  <use xlink:href="#svg-discord"></use>
                </svg>
              </a>
            </div>
          </div>

          <div id="profile-header-social-links-slider-controls" class="slider-controls">
            <div class="slider-control left">
              <svg class="slider-control-icon icon-small-arrow">
                <use xlink:href="#svg-small-arrow"></use>
              </svg>
            </div>

            <div class="slider-control right">
              <svg class="slider-control-icon icon-small-arrow">
                <use xlink:href="#svg-small-arrow"></use>
              </svg>
            </div>
          </div>
        </div>

        <div class="user-stats">
          <div class="user-stat big">
            <p class="user-stat-title">{{ number_format($author->articles->count()) }}</p>

            <p class="user-stat-text">posts</p>
          </div>

          <div class="user-stat big">
            <p class="user-stat-title">{{ number_format($author->followings->count()) }}</p>

            <p class="user-stat-text">following</p>
          </div>

          <div class="user-stat big">
            <p class="user-stat-title">{{ number_format($author->followers->count()) }}</p>

            <p class="user-stat-text">followers</p>
          </div>

          {{-- <div class="user-stat big">
            <img class="user-stat-image" src="{{ asset('theme/img/indonesia-flag-icon.svg') }}" alt="flag-usa">

            <p class="user-stat-text">Indonesia</p>
          </div> --}}
        </div>

        <div class="profile-header-info-actions">
          <p class="profile-header-info-action button secondary"><span class="hide-text-mobile">Add</span> Friend +</p>

          <p class="profile-header-info-action button primary"><span class="hide-text-mobile">Send</span> Message</p>
        </div>
      </div>
    </div>

    <nav class="section-navigation">
      <div id="section-navigation-slider" class="section-menu">
        <a class="section-menu-item" href="profile-about.html">
          <svg class="section-menu-item-icon icon-profile">
            <use xlink:href="#svg-profile"></use>
          </svg>

          <p class="section-menu-item-text">About</p>
        </a>

        <a class="section-menu-item active" href="profile-timeline.html">
          <svg class="section-menu-item-icon icon-timeline">
            <use xlink:href="#svg-timeline"></use>
          </svg>

          <p class="section-menu-item-text">Timeline</p>
        </a>

        <a class="section-menu-item" href="profile-friends.html">
          <svg class="section-menu-item-icon icon-friend">
            <use xlink:href="#svg-friend"></use>
          </svg>

          <p class="section-menu-item-text">Friends</p>
        </a>

        <a class="section-menu-item" href="profile-groups.html">
          <svg class="section-menu-item-icon icon-group">
            <use xlink:href="#svg-group"></use>
          </svg>

          <p class="section-menu-item-text">Groups</p>
        </a>

        <a class="section-menu-item" href="profile-photos.html">
          <svg class="section-menu-item-icon icon-photos">
            <use xlink:href="#svg-photos"></use>
          </svg>

          <p class="section-menu-item-text">Photos</p>
        </a>

        <a class="section-menu-item" href="profile-videos.html">
          <svg class="section-menu-item-icon icon-videos">
            <use xlink:href="#svg-videos"></use>
          </svg>

          <p class="section-menu-item-text">Videos</p>
        </a>

        <a class="section-menu-item" href="profile-badges.html">
          <svg class="section-menu-item-icon icon-badges">
            <use xlink:href="#svg-badges"></use>
          </svg>

          <p class="section-menu-item-text">Badges</p>
        </a>

        <a class="section-menu-item" href="profile-stream.html">
          <svg class="section-menu-item-icon icon-streams">
            <use xlink:href="#svg-streams"></use>
          </svg>

          <p class="section-menu-item-text">Streams</p>
        </a>

        <a class="section-menu-item" href="profile-blog.html">
          <svg class="section-menu-item-icon icon-blog-posts">
            <use xlink:href="#svg-blog-posts"></use>
          </svg>

          <p class="section-menu-item-text">Blog</p>
        </a>

        <a class="section-menu-item" href="profile-forum.html">
          <svg class="section-menu-item-icon icon-forum">
            <use xlink:href="#svg-forum"></use>
          </svg>

          <p class="section-menu-item-text">Forum</p>
        </a>

        <a class="section-menu-item" href="profile-store.html">
          <svg class="section-menu-item-icon icon-store">
            <use xlink:href="#svg-store"></use>
          </svg>

          <p class="section-menu-item-text">Store</p>
        </a>
      </div>

      <div id="section-navigation-slider-controls" class="slider-controls">
        <div class="slider-control left">
          <svg class="slider-control-icon icon-small-arrow">
            <use xlink:href="#svg-small-arrow"></use>
          </svg>
        </div>

        <div class="slider-control right">
          <svg class="slider-control-icon icon-small-arrow">
            <use xlink:href="#svg-small-arrow"></use>
          </svg>
        </div>
      </div>
    </nav>

    <div class="grid grid-3-6-3 mobile-prefer-content">
      <div class="grid-column">
        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">About Me</p>

          <div class="widget-box-content">
            <p class="paragraph">Hi! My name is Marina but some people may know me as GameHuntress! I have a Twitch
              channel where I stream, play and review all the newest games.</p>

            <div class="information-line-list">
              <div class="information-line">
                <p class="information-line-title">Joined</p>

                <p class="information-line-text">March 26th, 2017</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">City</p>

                <p class="information-line-text">Los Angeles, California</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">Country</p>

                <p class="information-line-text">United States</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">Age</p>

                <p class="information-line-text">32 Years</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">Web</p>

                <p class="information-line-text"><a href="#">{{ '@' . $author->username }}</a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="widget-box">
          <p class="widget-box-title">Advertising</p>
          @include('components.adsense-responsive')
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Badges <span class="highlighted">13</span></p>

          <div class="widget-box-content">
            <div class="badge-list">
              <div class="badge-item text-tooltip-tft" data-title="Gold User">
                <img src="img/badge/gold-s.png" alt="badge-gold-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Profile Age">
                <img src="img/badge/age-s.png" alt="badge-age-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Caffeinatted">
                <img src="img/badge/caffeinated-s.png" alt="badge-caffeinated-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="The Warrior">
                <img src="img/badge/warrior-s.png" alt="badge-warrior-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Forum Traveller">
                <img src="img/badge/traveller-s.png" alt="badge-traveller-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Crazy Scientist">
                <img src="img/badge/scientist-s.png" alt="badge-scientist-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Night Creature">
                <img src="img/badge/ncreature-s.png" alt="badge-ncreature-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Mightier Than Sword">
                <img src="img/badge/mightiers-s.png" alt="badge-mightiers-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="The Phantom">
                <img src="img/badge/phantom-s.png" alt="badge-phantom-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="The Collector">
                <img src="img/badge/collector-s.png" alt="badge-collector-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Bronze Cup">
                <img src="img/badge/bronzec-s.png" alt="badge-bronzec-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Silver Cup">
                <img src="img/badge/silverc-s.png" alt="badge-silverc-s">
              </div>

              <div class="badge-item text-tooltip-tft" data-title="Gold Cup">
                <img src="img/badge/goldc-s.png" alt="badge-goldc-s">
              </div>
            </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Friends <span class="highlighted">82</span></p>

          <div class="widget-box-content">
            <div class="user-status-list">
              <div class="user-status request-small">
                <a class="user-status-avatar" href="profile-timeline.html">
                  <div class="user-avatar small no-outline">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-30-32" data-src="img/avatar/07.jpg"></div>
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

                      <p class="user-avatar-badge-text">26</p>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="profile-timeline.html">Sarah Diamond</a></p>

                <p class="user-status-text small">2 friends in common</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-add-friend">
                      <use xlink:href="#svg-add-friend"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="profile-timeline.html">
                  <div class="user-avatar small no-outline">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-30-32" data-src="img/avatar/03.jpg"></div>
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
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="profile-timeline.html">Nick Grissom</a></p>

                <p class="user-status-text small">5 friends in common</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-add-friend">
                      <use xlink:href="#svg-add-friend"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="profile-timeline.html">
                  <div class="user-avatar small no-outline">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-30-32" data-src="img/avatar/02.jpg"></div>
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

                      <p class="user-avatar-badge-text">13</p>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="profile-timeline.html">Destroy Dex</a></p>

                <p class="user-status-text small">0 friends in common</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-add-friend">
                      <use xlink:href="#svg-add-friend"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="profile-timeline.html">
                  <div class="user-avatar small no-outline">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-30-32" data-src="img/avatar/05.jpg"></div>
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
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="profile-timeline.html">Neko Bebop</a></p>

                <p class="user-status-text small">1 friends in common</p>

                <div class="action-request-list">
                  <div class="action-request decline">
                    <svg class="action-request-icon icon-remove-friend">
                      <use xlink:href="#svg-remove-friend"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="profile-timeline.html">
                  <div class="user-avatar small no-outline">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-30-32" data-src="img/avatar/10.jpg"></div>
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
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="profile-timeline.html">The Green Goo</a></p>

                <p class="user-status-text small">8 friends in common</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-add-friend">
                      <use xlink:href="#svg-add-friend"></use>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a class="widget-box-button button small secondary" href="profile-friends.html">See all Friends</a>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Videos <span class="highlighted">7</span></p>

          <div class="widget-box-content">
            <div class="video-box-list">
              <div class="video-box small">
                <div class="video-box-cover popup-video-trigger">
                  <figure class="video-box-cover-image liquid">
                    <img src="img/cover/08.jpg" alt="cover-08">
                  </figure>

                  <div class="play-button">
                    <svg class="play-button-icon icon-play">
                      <use xlink:href="#svg-play"></use>
                    </svg>
                  </div>

                  <div class="video-box-info">
                    <p class="video-box-title">Mochi's Island Story Mode</p>

                    <p class="video-box-text">1 hour ago</p>
                  </div>
                </div>
              </div>

              <div class="video-box small">
                <div class="video-box-cover popup-video-trigger">
                  <figure class="video-box-cover-image liquid">
                    <img src="img/cover/09.jpg" alt="cover-09">
                  </figure>

                  <div class="play-button">
                    <svg class="play-button-icon icon-play">
                      <use xlink:href="#svg-play"></use>
                    </svg>
                  </div>

                  <div class="video-box-info">
                    <p class="video-box-title">Sunset Cowboys - Walkthrough</p>

                    <p class="video-box-text">3 days ago</p>
                  </div>
                </div>
              </div>

              <div class="video-box small">
                <div class="video-box-cover popup-video-trigger">
                  <figure class="video-box-cover-image liquid">
                    <img src="img/cover/05.jpg" alt="cover-05">
                  </figure>

                  <div class="play-button">
                    <svg class="play-button-icon icon-play">
                      <use xlink:href="#svg-play"></use>
                    </svg>
                  </div>

                  <div class="video-box-info">
                    <p class="video-box-title">Quest of the Ogre II: The Revenge USA...</p>

                    <p class="video-box-text">5 days ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="grid-column">
        @forelse ($author->articles as $article)
          <div class="widget-box">
            <article class="row justify-content-between">
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
              <div class="col-md-3 bgcover rounded"
                style="background-image:url({{ $article->img_featured ? asset($article->img_featured) : asset('assets/images/thumb/thumb-512x512.jpg') }});">
              </div>
            </article>
          </div>
        @empty
          <p>{{ $author->name }} belum memiliki artikel.</p>
        @endforelse
      </div>

      <div class="grid-column">
        <div class="widget-box">
          <p class="widget-box-title">Advertising</p>
          @include('components.adsense-responsive')
        </div>



        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Featured Posts <span class="highlighted">5</span></p>

          <div class="widget-box-content">
            <div class="post-peek-list">
              @foreach ($highlightPosts as $post)
                <div class="post-peek">
                  <a class="post-peek-image" href="{{ route('articles.show', $post->slug) }}">
                    <figure class="picture small round liquid">
                      <img
                        src="{{ $post->img_featured ? asset($post->img_featured) : asset('assets/images/thumb/thumb-512x512.jpg') }}"
                        alt="{{ $post->title }}">
                    </figure>
                  </a>

                  <p class="post-peek-title"><a
                      href="{{ route('articles.show', $post->slug) }}">{{ $post->title }}</a></p>

                  <p class="post-peek-text">{{ $post->created_at->diffForHumans() }}</p>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="widget-box no-padding">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Stream Box</p>

          <div class="widget-box-content small-margin-top">
            <div class="stream-box no-video-radius">
              <div class="stream-box-video">
                <iframe src="https://player.twitch.tv/?channel=cohhcarnage&parent=odindesignthemes.com"
                  allowfullscreen></iframe>
              </div>

              <div class="stream-box-image">
                <figure class="picture tiny circle liquid">
                  <img src="img/avatar/01-social.png" alt="avatar-01-social">
                </figure>
              </div>

              <div class="stream-box-info">
                <p class="stream-box-title"><a href="profile-stream.html">I'm Playing Athena’s Goddess Story...</a>
                </p>

                <p class="stream-box-text"><a href="https://www.twitch.tv/" target="_blank">@GameHuntress</a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Photos <span class="highlighted">74</span></p>

          <div class="widget-box-content">
            <div class="picture-item-list small">
              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/avatar/01.jpg" alt="avatar-01">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/10.jpg" alt="avatar-10">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/12.jpg" alt="avatar-12">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/02.jpg" alt="avatar-02">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/06.jpg" alt="avatar-06">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/13.jpg" alt="avatar-13">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/04.jpg" alt="avatar-04">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/15.jpg" alt="avatar-15">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/11.jpg" alt="avatar-11">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/08.jpg" alt="avatar-08">
                </figure>
              </div>

              <div class="picture-item">
                <figure class="picture round liquid">
                  <img src="img/cover/16.jpg" alt="avatar-16">
                </figure>
              </div>

              <a class="picture-item" href="profile-photos.html">
                <figure class="picture round liquid">
                  <img src="img/cover/17.jpg" alt="avatar-17">
                </figure>

                <div class="picture-item-overlay round">
                  <p class="picture-item-overlay-text">+61</p>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Twitter Feed</p>

          <div class="widget-box-content">
            <div class="tweet-feed"></div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Groups <span class="highlighted">7</span></p>

          <div class="widget-box-content">
            <div class="filters">
              <p class="filter">Newest</p>

              <p class="filter active">Popular</p>

              <p class="filter">Active</p>
            </div>

            <div class="user-status-list">
              <div class="user-status request-small">
                <a class="user-status-avatar" href="group-timeline.html">
                  <div class="user-avatar small no-border">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-40-44" data-src="img/avatar/29.jpg"></div>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="group-timeline.html">Twitch Streamers</a></p>

                <p class="user-status-text small">265 members</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-join-group">
                      <use xlink:href="#svg-join-group"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="group-timeline.html">
                  <div class="user-avatar small no-border">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-40-44" data-src="img/avatar/24.jpg"></div>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="group-timeline.html">Cosplayers of the
                    World</a></p>

                <p class="user-status-text small">139 members</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-join-group">
                      <use xlink:href="#svg-join-group"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="group-timeline.html">
                  <div class="user-avatar small no-border">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-40-44" data-src="img/avatar/25.jpg"></div>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="group-timeline.html">Stream Designers</a></p>

                <p class="user-status-text small">466 members</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-join-group">
                      <use xlink:href="#svg-join-group"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="group-timeline.html">
                  <div class="user-avatar small no-border">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-40-44" data-src="img/avatar/28.jpg"></div>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="group-timeline.html">Street Artists</a></p>

                <p class="user-status-text small">951 members</p>

                <div class="action-request-list">
                  <div class="action-request decline">
                    <svg class="action-request-icon icon-leave-group">
                      <use xlink:href="#svg-leave-group"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="user-status request-small">
                <a class="user-status-avatar" href="group-timeline.html">
                  <div class="user-avatar small no-border">
                    <div class="user-avatar-content">
                      <div class="hexagon-image-40-44" data-src="img/avatar/27.jpg"></div>
                    </div>
                  </div>
                </a>

                <p class="user-status-title"><a class="bold" href="group-timeline.html">Gaming Watchtower</a></p>

                <p class="user-status-text small">2.365 members</p>

                <div class="action-request-list">
                  <div class="action-request accept">
                    <svg class="action-request-icon icon-join-group">
                      <use xlink:href="#svg-join-group"></use>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown">
                <p class="simple-dropdown-link">Widget Settings</p>
              </div>
            </div>
          </div>

          <p class="widget-box-title">Latest Item</p>

          <div class="widget-box-content">
            <div class="product-preview small">
              <a href="marketplace-product.html">
                <figure class="product-preview-image liquid">
                  <img src="img/marketplace/items/01.jpg" alt="item-01">
                </figure>
              </a>

              <div class="product-preview-info">
                <p class="text-sticker"><span class="highlighted">$</span> 12.00</p>

                <p class="product-preview-title"><a href="marketplace-product.html">Twitch Stream UI Pack</a></p>

                <p class="product-preview-category digital"><a href="marketplace-category.html">Stream Packs</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="popup-video">
    <div class="popup-close-button popup-video-trigger">
      <svg class="popup-close-button-icon icon-cross">
        <use xlink:href="#svg-cross"></use>
      </svg>
    </div>

    <div class="iframe-wrap">
      <iframe src="https://www.youtube.com/embed/6ErE27RNLDQ?start=200" allowfullscreen></iframe>
    </div>
  </div>

  <div class="popup-picture">
    <div class="popup-close-button popup-picture-trigger">
      <svg class="popup-close-button-icon icon-cross">
        <use xlink:href="#svg-cross"></use>
      </svg>
    </div>

    <div class="widget-box no-padding">
      <div class="widget-box-scrollable" data-simplebar>
        <div class="widget-box-settings">
          <div class="post-settings-wrap">
            <div class="post-settings widget-box-post-settings-dropdown-trigger">
              <svg class="post-settings-icon icon-more-dots">
                <use xlink:href="#svg-more-dots"></use>
              </svg>
            </div>

            <div class="simple-dropdown widget-box-post-settings-dropdown">
              <p class="simple-dropdown-link">Edit Post</p>

              <p class="simple-dropdown-link">Delete Post</p>

              <p class="simple-dropdown-link">Make it Featured</p>

              <p class="simple-dropdown-link">Report Post</p>

              <p class="simple-dropdown-link">Report Author</p>
            </div>
          </div>
        </div>

        <div class="widget-box-status">
          <div class="widget-box-status-content">
            <div class="user-status">
              <a class="user-status-avatar" href="profile-timeline.html">
                <div class="user-avatar small no-outline">
                  <div class="user-avatar-content">
                    <div class="hexagon-image-30-32" data-src="img/avatar/01.jpg"></div>
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
              </a>

              <p class="user-status-title medium"><a class="bold" href="profile-timeline.html">Marina
                  Valentine</a></p>

              <p class="user-status-text small">29 minutes ago</p>
            </div>

            <p class="widget-box-status-text">Here's a sneak peek of the official box cover art for <a
                href="#">Machine Wasteland II</a>! Remember that I'll be having a stream showing a preview
              tommorrow at 9PM PCT!</p>

            <div class="tag-list">
              <a class="tag-item secondary" href="newsfeed.html">Cover</a>

              <a class="tag-item secondary" href="newsfeed.html">Preview</a>

              <a class="tag-item secondary" href="newsfeed.html">Art</a>

              <a class="tag-item secondary" href="newsfeed.html">Machine</a>

              <a class="tag-item secondary" href="newsfeed.html">Wasteland</a>
            </div>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <div class="meta-line-list reaction-item-list">
                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/love.png"
                        alt="reaction-love">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/love.png"
                            alt="reaction-love"> <span class="bold">Love</span></p>

                        <p class="simple-dropdown-text">Destroy Dex</p>

                        <p class="simple-dropdown-text">The Green Goo</p>

                        <p class="simple-dropdown-text">Bearded Wonder</p>

                        <p class="simple-dropdown-text">Sandra Strange</p>

                        <p class="simple-dropdown-text">Matt Parker</p>

                        <p class="simple-dropdown-text">James Murdock</p>

                        <p class="simple-dropdown-text"><span class="bold">and 14 more...</span></p>
                      </div>
                    </div>

                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/wow.png"
                        alt="reaction-wow">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/wow.png"
                            alt="reaction-wow"> <span class="bold">Wow</span></p>

                        <p class="simple-dropdown-text">Jett Spiegel</p>
                      </div>
                    </div>

                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/like.png"
                        alt="reaction-like">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/like.png"
                            alt="reaction-like"> <span class="bold">Like</span></p>

                        <p class="simple-dropdown-text">Neko Bebop</p>

                        <p class="simple-dropdown-text">Nick Grissom</p>

                        <p class="simple-dropdown-text">Sarah Diamond</p>
                      </div>
                    </div>
                  </div>

                  <p class="meta-line-text">24</p>
                </div>
              </div>

              <div class="content-action">
                <div class="meta-line">
                  <p class="meta-line-link">13 Comments</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-text">0 Shares</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="post-options">
          <div class="post-option-wrap">
            <div class="post-option no-text reaction-options-dropdown-trigger">
              <svg class="post-option-icon icon-thumbs-up">
                <use xlink:href="#svg-thumbs-up"></use>
              </svg>
            </div>

            <div class="reaction-options small reaction-options-dropdown">
              <div class="reaction-option text-tooltip-tft" data-title="Like">
                <img class="reaction-option-image" src="img/reaction/like.png" alt="reaction-like">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Love">
                <img class="reaction-option-image" src="img/reaction/love.png" alt="reaction-love">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                <img class="reaction-option-image" src="img/reaction/dislike.png" alt="reaction-dislike">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Happy">
                <img class="reaction-option-image" src="img/reaction/happy.png" alt="reaction-happy">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Funny">
                <img class="reaction-option-image" src="img/reaction/funny.png" alt="reaction-funny">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Wow">
                <img class="reaction-option-image" src="img/reaction/wow.png" alt="reaction-wow">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Angry">
                <img class="reaction-option-image" src="img/reaction/angry.png" alt="reaction-angry">
              </div>

              <div class="reaction-option text-tooltip-tft" data-title="Sad">
                <img class="reaction-option-image" src="img/reaction/sad.png" alt="reaction-sad">
              </div>
            </div>
          </div>

          <div class="post-option no-text active">
            <svg class="post-option-icon icon-comment">
              <use xlink:href="#svg-comment"></use>
            </svg>
          </div>

          <div class="post-option no-text">
            <svg class="post-option-icon icon-share">
              <use xlink:href="#svg-share"></use>
            </svg>
          </div>
        </div>

        <div class="post-comment-list">
          <div class="post-comment">
            <a class="user-avatar small no-outline" href="profile-timeline.html">
              <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="img/avatar/05.jpg"></div>
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
                Bebop</a>It's always a pleasure to do this streams with you! If we have at least half the fun than last
              time it will be an incredible success!</p>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <div class="meta-line-list reaction-item-list small">
                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/happy.png"
                        alt="reaction-happy">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/happy.png"
                            alt="reaction-happy"> <span class="bold">Happy</span></p>

                        <p class="simple-dropdown-text">Marcus Jhonson</p>
                      </div>
                    </div>

                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/like.png"
                        alt="reaction-like">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/like.png"
                            alt="reaction-like"> <span class="bold">Like</span></p>

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
                      <img class="reaction-option-image" src="img/reaction/like.png" alt="reaction-like">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Love">
                      <img class="reaction-option-image" src="img/reaction/love.png" alt="reaction-love">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                      <img class="reaction-option-image" src="img/reaction/dislike.png" alt="reaction-dislike">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Happy">
                      <img class="reaction-option-image" src="img/reaction/happy.png" alt="reaction-happy">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Funny">
                      <img class="reaction-option-image" src="img/reaction/funny.png" alt="reaction-funny">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Wow">
                      <img class="reaction-option-image" src="img/reaction/wow.png" alt="reaction-wow">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Angry">
                      <img class="reaction-option-image" src="img/reaction/angry.png" alt="reaction-angry">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Sad">
                      <img class="reaction-option-image" src="img/reaction/sad.png" alt="reaction-sad">
                    </div>
                  </div>
                </div>

                <div class="meta-line">
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">15 min ago</p>
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
                <div class="hexagon-image-30-32" data-src="img/avatar/03.jpg"></div>
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
                Grissom</a>I wouldn't miss it for anything!! Love both streams!</p>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <div class="meta-line-list reaction-item-list small">
                    <div class="reaction-item">
                      <img class="reaction-image reaction-item-dropdown-trigger" src="img/reaction/like.png"
                        alt="reaction-like">

                      <div class="simple-dropdown padded reaction-item-dropdown">
                        <p class="simple-dropdown-text"><img class="reaction" src="img/reaction/like.png"
                            alt="reaction-like"> <span class="bold">Like</span></p>

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
                      <img class="reaction-option-image" src="img/reaction/like.png" alt="reaction-like">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Love">
                      <img class="reaction-option-image" src="img/reaction/love.png" alt="reaction-love">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                      <img class="reaction-option-image" src="img/reaction/dislike.png" alt="reaction-dislike">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Happy">
                      <img class="reaction-option-image" src="img/reaction/happy.png" alt="reaction-happy">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Funny">
                      <img class="reaction-option-image" src="img/reaction/funny.png" alt="reaction-funny">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Wow">
                      <img class="reaction-option-image" src="img/reaction/wow.png" alt="reaction-wow">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Angry">
                      <img class="reaction-option-image" src="img/reaction/angry.png" alt="reaction-angry">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Sad">
                      <img class="reaction-option-image" src="img/reaction/sad.png" alt="reaction-sad">
                    </div>
                  </div>
                </div>

                <div class="meta-line">
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">2 min ago</p>
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
                <div class="hexagon-image-30-32" data-src="img/avatar/02.jpg"></div>
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

                <p class="user-avatar-badge-text">19</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">Destroy
                Dex</a>YEAHHH!! <a href="profile-timeline.html">@MarinaValentine</a> I really enjoyed your last stream
              and it also was really funny! Can't wait!</p>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <p class="meta-line-link light reaction-options-small-dropdown-trigger">React!</p>

                  <div class="reaction-options small reaction-options-small-dropdown">
                    <div class="reaction-option text-tooltip-tft" data-title="Like">
                      <img class="reaction-option-image" src="img/reaction/like.png" alt="reaction-like">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Love">
                      <img class="reaction-option-image" src="img/reaction/love.png" alt="reaction-love">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                      <img class="reaction-option-image" src="img/reaction/dislike.png" alt="reaction-dislike">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Happy">
                      <img class="reaction-option-image" src="img/reaction/happy.png" alt="reaction-happy">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Funny">
                      <img class="reaction-option-image" src="img/reaction/funny.png" alt="reaction-funny">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Wow">
                      <img class="reaction-option-image" src="img/reaction/wow.png" alt="reaction-wow">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Angry">
                      <img class="reaction-option-image" src="img/reaction/angry.png" alt="reaction-angry">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Sad">
                      <img class="reaction-option-image" src="img/reaction/sad.png" alt="reaction-sad">
                    </div>
                  </div>
                </div>

                <div class="meta-line">
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">27 min ago</p>
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
                <div class="hexagon-image-30-32" data-src="img/avatar/07.jpg"></div>
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

                <p class="user-avatar-badge-text">26</p>
              </div>
            </a>

            <p class="post-comment-text"><a class="post-comment-text-author" href="profile-timeline.html">Sarah
                Diamond</a>That sounds awesome Marina! And also thanks a lot for the art sneak peek! I went to the GameCon
              last week and had a great time playing the game's open demo.</p>

            <div class="content-actions">
              <div class="content-action">
                <div class="meta-line">
                  <p class="meta-line-link light reaction-options-small-dropdown-trigger">React!</p>

                  <div class="reaction-options small reaction-options-small-dropdown">
                    <div class="reaction-option text-tooltip-tft" data-title="Like">
                      <img class="reaction-option-image" src="img/reaction/like.png" alt="reaction-like">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Love">
                      <img class="reaction-option-image" src="img/reaction/love.png" alt="reaction-love">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Dislike">
                      <img class="reaction-option-image" src="img/reaction/dislike.png" alt="reaction-dislike">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Happy">
                      <img class="reaction-option-image" src="img/reaction/happy.png" alt="reaction-happy">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Funny">
                      <img class="reaction-option-image" src="img/reaction/funny.png" alt="reaction-funny">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Wow">
                      <img class="reaction-option-image" src="img/reaction/wow.png" alt="reaction-wow">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Angry">
                      <img class="reaction-option-image" src="img/reaction/angry.png" alt="reaction-angry">
                    </div>

                    <div class="reaction-option text-tooltip-tft" data-title="Sad">
                      <img class="reaction-option-image" src="img/reaction/sad.png" alt="reaction-sad">
                    </div>
                  </div>
                </div>

                <div class="meta-line">
                  <p class="meta-line-link light">Reply</p>
                </div>

                <div class="meta-line">
                  <p class="meta-line-timestamp">39 min ago</p>
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

          <p class="post-comment-heading">Load More Comments <span class="highlighted">9+</span></p>
        </div>
      </div>

      <div class="post-comment-form border-top">
        <div class="user-avatar small no-outline">
          <div class="user-avatar-content">
            <div class="hexagon-image-30-32" data-src="img/avatar/01.jpg"></div>
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
                <label for="popup-post-reply">Your Reply</label>
                <input type="text" id="popup-post-reply" name="popup_post_reply">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="popup-picture-image-wrap">
      <figure class="popup-picture-image">
        <img src="img/cover/04.jpg" alt="cover-04">
      </figure>
    </div>
  </div>
@endsection
