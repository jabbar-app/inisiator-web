<nav id="navigation-widget-small" class="navigation-widget navigation-widget-desktop closed sidebar left delayed">
  @auth
    <a class="user-avatar small no-outline online" href="{{ route('pages.author', Auth::user()->username) }}">
      <div class="user-avatar-content">
        <div class="hexagon-image-30-32"
          data-src="{{ !empty(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('assets/img/profpic.svg') }}">
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
    </a>
  @endauth

  <ul class="menu small">
    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="{{ route('pages.home') }}" data-title="Home">
        <svg class="menu-item-link-icon icon-newsfeed">
          <use xlink:href="#svg-newsfeed"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="{{ route('dashboard') }}" data-title="Dashboard">
        <svg class="menu-item-link-icon icon-overview">
          <use xlink:href="#svg-overview"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="{{ route('articles.index') }}" data-title="Articles">
        <svg class="menu-item-link-icon icon-blog-posts">
          <use xlink:href="#svg-blog-posts"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Networks">
        <svg class="menu-item-link-icon icon-members">
          <use xlink:href="#svg-members"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Badges">
        <svg class="menu-item-link-icon icon-badges">
          <use xlink:href="#svg-badges"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Quests">
        <svg class="menu-item-link-icon icon-quests">
          <use xlink:href="#svg-quests"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Streams">
        <svg class="menu-item-link-icon icon-streams">
          <use xlink:href="#svg-streams"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Events">
        <svg class="menu-item-link-icon icon-events">
          <use xlink:href="#svg-events"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Forums">
        <svg class="menu-item-link-icon icon-forums">
          <use xlink:href="#svg-forums"></use>
        </svg>
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link text-tooltip-tfr" href="#" data-title="Marketplace">
        <svg class="menu-item-link-icon icon-marketplace">
          <use xlink:href="#svg-marketplace"></use>
        </svg>
      </a>
    </li>
  </ul>
</nav>

<nav id="navigation-widget" class="navigation-widget navigation-widget-desktop sidebar left hidden" data-simplebar>
  <figure class="navigation-widget-cover liquid">
    <img src="{{ asset('assets/img/backgrounds/cover.webp') }}" alt="cover-01">
  </figure>

  @auth
    <div class="user-short-description">
      <a class="user-short-description-avatar user-avatar medium"
        href="{{ route('pages.author', Auth::user()->username) }}">
        <div class="user-avatar-border">
          <div class="hexagon-120-132"></div>
        </div>

        <div class="user-avatar-content">
          <div class="hexagon-image-82-90"
            data-src="{{ !empty(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('assets/img/profpic.svg') }}">
          </div>
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

      <p class="user-short-description-title">
        <a href="{{ route('pages.author', Auth::user()->username) }}">{{ Auth::user()->name }}</a>
      </p>

      <p class="user-short-description-text"><a
          href="{{ route('pages.author', Auth::user()->username) }}">{{ '@' . Auth::user()->username }}</a></p>
    </div>

    <div class="badge-list small">
      <div class="badge-item">
        <img src="{{ asset('assets/img/icons/badges/gold-s.webp') }}" alt="badge-gold-s">
      </div>

      <div class="badge-item">
        <img src="{{ asset('assets/img/icons/badges/age-s.webp') }}" alt="badge-age-s">
      </div>

      <div class="badge-item">
        <img src="{{ asset('assets/img/icons/badges/caffeinated-s.webp') }}" alt="badge-caffeinated-s">
      </div>

      <div class="badge-item">
        <img src="{{ asset('assets/img/icons/badges/warrior-s.webp') }}" alt="badge-warrior-s">
      </div>

      <a class="badge-item" href="#">
        <img src="{{ asset('assets/img/icons/badges/blank-s.webp') }}" alt="badge-blank-s">
        <p class="badge-item-text">+9</p>
      </a>
    </div>

    <div class="user-stats">
      <div class="user-stat">
        <p class="user-stat-title">{{ Auth::user()->articles->count() }}</p>

        <p class="user-stat-text">posts</p>
      </div>

      <div class="user-stat">
        <p class="user-stat-title">{{ Auth::user()->followings->count() }}</p>

        <p class="user-stat-text">following</p>
      </div>

      <div class="user-stat">
        <p class="user-stat-title">{{ Auth::user()->followers->count() }}</p>

        <p class="user-stat-text">followers</p>
      </div>
    </div>
  @endauth

  <ul class="menu">
    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-newsfeed">
          <use xlink:href="#svg-newsfeed"></use>
        </svg>
        Newsfeed
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-overview">
          <use xlink:href="#svg-overview"></use>
        </svg>
        Overview
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-group">
          <use xlink:href="#svg-group"></use>
        </svg>
        Groups
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-members">
          <use xlink:href="#svg-members"></use>
        </svg>
        Networks
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-badges">
          <use xlink:href="#svg-badges"></use>
        </svg>
        Badges
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-quests">
          <use xlink:href="#svg-quests"></use>
        </svg>
        Quests
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-streams">
          <use xlink:href="#svg-streams"></use>
        </svg>
        Streams
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-events">
          <use xlink:href="#svg-events"></use>
        </svg>
        Events
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-forums">
          <use xlink:href="#svg-forums"></use>
        </svg>
        Forums
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-marketplace">
          <use xlink:href="#svg-marketplace"></use>
        </svg>
        Marketplace
      </a>
    </li>
  </ul>
</nav>

<nav id="navigation-widget-mobile" class="navigation-widget navigation-widget-mobile sidebar left hidden"
  data-simplebar>
  <div class="navigation-widget-close-button">
    <svg class="navigation-widget-close-button-icon icon-back-arrow">
      <use xlink:href="#svg-back-arrow"></use>
    </svg>
  </div>

  @auth
    <div class="navigation-widget-info-wrap">
      <div class="navigation-widget-info">
        <a class="user-avatar small no-outline" href="{{ route('pages.author', Auth::user()->username) }}">
          <div class="user-avatar-content">
            <div class="hexagon-image-30-32"
              data-src="{{ !empty(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('assets/img/profpic.svg') }}">
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
        </a>

        <p class="navigation-widget-info-title"><a
            href="{{ route('pages.author', Auth::user()->username) }}">{{ Auth::user()->name }}</a></p>

        <p class="navigation-widget-info-text">Welcome Back!</p>
      </div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="navigation-widget-info-button button small secondary" href="{{ route('logout') }}"
          onclick="event.preventDefault(); this.closest('form').submit();">
          <i class="ti ti-logout me-2 ti-sm"></i>
          Logout
        </a>
      </form>
    </div>
  @else
    <div class="navigation-widget-info-wrap">
      <a href="{{ route('login', ['url' => request()->fullUrl()]) }}" class="button secondary text-nowrap px-4">LOGIN / REGISTER</a>
    </div>
  @endauth

  <p class="navigation-widget-section-title">Sections</p>

  <ul class="menu">
    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-newsfeed">
          <use xlink:href="#svg-newsfeed"></use>
        </svg>
        Newsfeed
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-overview">
          <use xlink:href="#svg-overview"></use>
        </svg>
        Overview
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-group">
          <use xlink:href="#svg-group"></use>
        </svg>
        Groups
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-members">
          <use xlink:href="#svg-members"></use>
        </svg>
        Members
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-badges">
          <use xlink:href="#svg-badges"></use>
        </svg>
        Badges
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-quests">
          <use xlink:href="#svg-quests"></use>
        </svg>
        Quests
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-streams">
          <use xlink:href="#svg-streams"></use>
        </svg>
        Streams
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-events">
          <use xlink:href="#svg-events"></use>
        </svg>
        Events
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-forums">
          <use xlink:href="#svg-forums"></use>
        </svg>
        Forums
      </a>
    </li>

    <li class="menu-item">
      <a class="menu-item-link" href="#">
        <svg class="menu-item-link-icon icon-marketplace">
          <use xlink:href="#svg-marketplace"></use>
        </svg>
        Marketplace
      </a>
    </li>
  </ul>

  @auth
    <p class="navigation-widget-section-title">My Profile</p>

    <a class="navigation-widget-section-link" href="{{ route('profile.edit') }}">Profile Info</a>

    <a class="navigation-widget-section-link" href="#">Social &amp; Stream</a>

    <a class="navigation-widget-section-link" href="#">Notifications</a>

    <a class="navigation-widget-section-link" href="#">Messages</a>

    <a class="navigation-widget-section-link" href="#">Friend Requests</a>

    <p class="navigation-widget-section-title">Account</p>

    <a class="navigation-widget-section-link" href="#">Account Info</a>

    <a class="navigation-widget-section-link" href="#">Change Password</a>

    <a class="navigation-widget-section-link" href="#">General Settings</a>

    <p class="navigation-widget-section-title">Groups</p>

    <a class="navigation-widget-section-link" href="#">Manage Groups</a>

    <a class="navigation-widget-section-link" href="#">Invitations</a>

    <p class="navigation-widget-section-title">My Store</p>

    <a class="navigation-widget-section-link" href="#">My Account <span class="highlighted">$250,32</span></a>

    <a class="navigation-widget-section-link" href="#">Sales Statement</a>

    <a class="navigation-widget-section-link" href="#">Manage Items</a>

    <a class="navigation-widget-section-link" href="#">Downloads</a>

    <p class="navigation-widget-section-title">Main Links</p>

    <a class="navigation-widget-section-link" href="#">Home</a>

    <a class="navigation-widget-section-link" href="#">Careers</a>

    <a class="navigation-widget-section-link" href="#">Faqs</a>

    <a class="navigation-widget-section-link" href="#">About Us</a>

    <a class="navigation-widget-section-link" href="#">Our Blog</a>

    <a class="navigation-widget-section-link" href="#">Contact Us</a>

    <a class="navigation-widget-section-link" href="#">Privacy Policy</a>
  @endauth
</nav>

@auth
  {{-- <aside id="chat-widget-messages" class="chat-widget closed sidebar right">
    <div class="chat-widget-messages" data-simplebar>
      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Nick Grissom</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">9</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Matt Parker</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline away">
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
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Neko Bebop</span></p>

          <p class="user-status-text small">Awesome! I'll see you there!</p>

          <p class="user-status-timestamp floaty">54mins</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline offline">
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
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Bearded Wonder</span></p>

          <p class="user-status-text small">Great! Then we'll meet with them at...</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">27</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Sandra Strange</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">10</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">James Murdock</span></p>

          <p class="user-status-text small">Great! Then we'll meet with them at...</p>

          <p class="user-status-timestamp floaty">7hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline away">
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
            </div>
          </div>

          <p class="user-status-title"><span class="bold">The Green Goo</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">26</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Sarah Diamond</span></p>

          <p class="user-status-text small">I'm sending you the latest news of...</p>

          <p class="user-status-timestamp floaty">16hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline offline">
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

                <p class="user-avatar-badge-text">13</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Destroy Dex</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">4</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Damian Greyson</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>

      <div class="chat-widget-message">
        <div class="user-status">
          <div class="user-status-avatar">
            <div class="user-avatar small no-outline online">
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

                <p class="user-avatar-badge-text">3</p>
              </div>
            </div>
          </div>

          <p class="user-status-title"><span class="bold">Paul Lang</span></p>

          <p class="user-status-text small">Can you stream the new game?</p>

          <p class="user-status-timestamp floaty">2hrs</p>
        </div>
      </div>
    </div>

    <form class="chat-widget-form">
      <div class="interactive-input small">
        <input type="text" id="chat-widget-search" name="chat_widget_search" placeholder="Search Messages...">
        <div class="interactive-input-icon-wrap">
          <svg class="interactive-input-icon icon-magnifying-glass">
            <use xlink:href="#svg-magnifying-glass"></use>
          </svg>
        </div>

        <div class="interactive-input-action">
          <svg class="interactive-input-action-icon icon-cross-thin">
            <use xlink:href="#svg-cross-thin"></use>
          </svg>
        </div>
      </div>
    </form>

    <div class="chat-widget-button">
      <div class="chat-widget-button-icon">
        <div class="burger-icon">
          <div class="burger-icon-bar"></div>

          <div class="burger-icon-bar"></div>

          <div class="burger-icon-bar"></div>
        </div>
      </div>

      <p class="chat-widget-button-text">Messages / Chat</p>
    </div>
  </aside>

  <aside id="chat-widget-message" class="chat-widget chat-widget-overlay hidden sidebar right">
    <div class="chat-widget-header">
      <div class="chat-widget-close-button">
        <svg class="chat-widget-close-button-icon icon-back-arrow">
          <use xlink:href="#svg-back-arrow"></use>
        </svg>
      </div>

      <div class="user-status">
        <div class="user-status-avatar">
          <div class="user-avatar small no-outline online">
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
          </div>
        </div>

        <p class="user-status-title"><span class="bold">Nick Grissom</span></p>

        <p class="user-status-tag online">Online</p>
      </div>
    </div>

    <div class="chat-widget-conversation" data-simplebar>
      <div class="chat-widget-speaker left">
        <div class="chat-widget-speaker-avatar">
          <div class="user-avatar tiny no-border">
            <div class="user-avatar-content">
              <div class="hexagon-image-24-26" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
            </div>
          </div>
        </div>

        <p class="chat-widget-speaker-message">Hi Marina! It's been a long time!</p>

        <p class="chat-widget-speaker-timestamp">Yesterday at 8:36PM</p>
      </div>

      <div class="chat-widget-speaker right">
        <p class="chat-widget-speaker-message">Hey Nick!</p>

        <p class="chat-widget-speaker-message">You're right, it's been a really long time! I think the last time we saw
          was at Neko's party</p>

        <p class="chat-widget-speaker-timestamp">10:05AM</p>
      </div>

      <div class="chat-widget-speaker left">
        <div class="chat-widget-speaker-avatar">
          <div class="user-avatar tiny no-border">
            <div class="user-avatar-content">
              <div class="hexagon-image-24-26" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
            </div>
          </div>
        </div>

        <p class="chat-widget-speaker-message">Yeah! I remember now! The stream launch party</p>

        <p class="chat-widget-speaker-message">That reminds me that I wanted to ask you something</p>

        <p class="chat-widget-speaker-message">Can you stream the new game?</p>
      </div>
    </div>

    <form class="chat-widget-form">
      <div class="interactive-input small">
        <input type="text" id="chat-widget-message-text" name="chat_widget_message_text"
          placeholder="Write a message...">
        <div class="interactive-input-icon-wrap">
          <svg class="interactive-input-icon icon-send-message">
            <use xlink:href="#svg-send-message"></use>
          </svg>
        </div>

        <div class="interactive-input-action">
          <svg class="interactive-input-action-icon icon-cross-thin">
            <use xlink:href="#svg-cross-thin"></use>
          </svg>
        </div>
      </div>
    </form>
  </aside> --}}
@endauth
<header class="header">
  <a href="{{ route('pages.home') }}" class="header-actions">
    <div class="header-brand">
      <div class="logo">
        <img src="{{ asset('assets/img/inisiator-favicon-o.svg') }}" alt="" class="h-100">
      </div>

      <h1 class="header-brand-text">Inisiator</h1>
    </div>
  </a>

  <div class="header-actions">
    <div class="sidemenu-trigger navigation-widget-trigger">
      <svg class="icon-grid">
        <use xlink:href="#svg-grid"></use>
      </svg>
    </div>
    <div class="mobilemenu-trigger navigation-widget-mobile-trigger">
      <div class="burger-icon inverted">
        <div class="burger-icon-bar"></div>

        <div class="burger-icon-bar"></div>

        <div class="burger-icon-bar"></div>
      </div>
    </div>

    <nav class="navigation">
      <ul class="menu-main">
        <li class="menu-main-item">
          <a class="menu-main-item-link {{ Route::is('pages.home') ? 'text-primary' : '' }}" href="{{ route('pages.home') }}">HOME</a>
        </li>

        <li class="menu-main-item">
          <a class="menu-main-item-link {{ Route::is('pages.game') ? 'text-primary' : '' }}" href="{{ route('pages.game') }}">PLAY</a>
        </li>

        <li class="menu-main-item">
          <a class="menu-main-item-link" href="#">CAREERS</a>
        </li>

        <li class="menu-main-item">
          <p class="menu-main-item-link">
            <svg class="icon-dots">
              <use xlink:href="#svg-dots"></use>
            </svg>
          </p>

          <ul class="menu-main">
            <li class="menu-main-item">
              <a class="menu-main-item-link" href="#">About Inisiator</a>
            </li>

            <li class="menu-main-item">
              <a class="menu-main-item-link" href="#">Partnership</a>
            </li>

            <li class="menu-main-item">
              <a class="menu-main-item-link" href="#">Contact Us</a>
            </li>

            <li class="menu-main-item">
              <a class="menu-main-item-link" href="#">Privacy Policy</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>

  <div class="header-actions search-bar">
    <form action="{{ route('pages.search') }}" method="GET" class="interactive-input dark">
      <input type="text" value="{{ request('s') }}" name="s" id="search-main" placeholder="Search here for people or groups">
      <div class="interactive-input-icon-wrap">
        <svg class="interactive-input-icon icon-magnifying-glass">
          <use xlink:href="#svg-magnifying-glass"></use>
        </svg>
      </div>

      <div class="interactive-input-action">
        <svg class="interactive-input-action-icon icon-cross-thin">
          <use xlink:href="#svg-cross-thin"></use>
        </svg>
      </div>
    </form>

    {{-- <div class="dropdown-box padding-bottom-small header-search-dropdown">
      <div class="dropdown-box-category">
        <p class="dropdown-box-category-title">Members</p>
      </div>

      <div class="dropdown-box-list small no-scroll">
        <a class="dropdown-box-list-item" href="{{ route('pages.author', Auth::user()->username) }}">
          <div class="user-status notification">
            <div class="user-status-avatar">
              <div class="user-avatar small no-outline">
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
              </div>
            </div>

            <p class="user-status-title"><span class="bold">Neko Bebop</span></p>

            <p class="user-status-text">1 friends in common</p>

            <div class="user-status-icon">
              <svg class="icon-friend">
                <use xlink:href="#svg-friend"></use>
              </svg>
            </div>
          </div>
        </a>

        <a class="dropdown-box-list-item" href="{{ route('pages.author', Auth::user()->username) }}">
          <div class="user-status notification">
            <div class="user-status-avatar">
              <div class="user-avatar small no-outline">
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

                  <p class="user-avatar-badge-text">7</p>
                </div>
              </div>
            </div>

            <p class="user-status-title"><span class="bold">Tim Rogers</span></p>

            <p class="user-status-text">4 friends in common</p>

            <div class="user-status-icon">
              <svg class="icon-friend">
                <use xlink:href="#svg-friend"></use>
              </svg>
            </div>
          </div>
        </a>
      </div>

      <div class="dropdown-box-category">
        <p class="dropdown-box-category-title">Groups</p>
      </div>

      <div class="dropdown-box-list small no-scroll">
        <a class="dropdown-box-list-item" href="group-timeline.html">
          <div class="user-status notification">
            <div class="user-status-avatar">
              <div class="user-avatar small no-border">
                <div class="user-avatar-content">
                  <div class="hexagon-image-40-44" data-src="{{ asset('assets/img/profpic.svg') }}"></div>
                </div>
              </div>
            </div>

            <p class="user-status-title"><span class="bold">Cosplayers of the World</span></p>

            <p class="user-status-text">139 members</p>

            <div class="user-status-icon">
              <svg class="icon-group">
                <use xlink:href="#svg-group"></use>
              </svg>
            </div>
          </div>
        </a>
      </div>

      <div class="dropdown-box-category">
        <p class="dropdown-box-category-title">Marketplace</p>
      </div>

      <div class="dropdown-box-list small no-scroll">
        <a class="dropdown-box-list-item" href="marketplace-product.html">
          <div class="user-status no-padding-top">
            <div class="user-status-avatar">
              <figure class="picture small round liquid">
                <img src="img/marketplace/items/07.jpg" alt="item-07">
              </figure>
            </div>

            <p class="user-status-title"><span class="bold">Mercenaries White Frame</span></p>

            <p class="user-status-text">By Neko Bebop</p>

            <div class="user-status-icon">
              <svg class="icon-marketplace">
                <use xlink:href="#svg-marketplace"></use>
              </svg>
            </div>
          </div>
        </a>
      </div>
    </div> --}}
  </div>

  @guest
    <div class="header-actions">
      <div class="action-list dark">
        <div class="action-list-item-wrap">
          <div class="action-list-item header-dropdown-trigger">
            <a href="{{ route('login', ['url' => request()->fullUrl()]) }}" class="button white-solid text-nowrap px-4">LOGIN / REGISTER</a>
          </div>
        </div>
      </div>
    </div>
    <div class="header-actions">
      <div class="action-list dark">
      </div>
    </div>
  @else
    <div class="header-actions">
      <div class="progress-stat">
        <div class="bar-progress-wrap">
          <p class="bar-progress-info">Next: <span class="bar-progress-text"></span></p>
        </div>

        <div id="logged-user-level" class="progress-stat-bar"></div>
      </div>
    </div>
    <div class="header-actions">
      <div class="action-list dark">
        {{-- <div class="action-list-item-wrap">
          <div class="action-list-item header-dropdown-trigger">
            <svg class="action-list-item-icon icon-shopping-bag">
              <use xlink:href="#svg-shopping-bag"></use>
            </svg>
          </div>

          <div class="dropdown-box no-padding-bottom header-dropdown">
            <div class="dropdown-box-header">
              <p class="dropdown-box-header-title">Shopping Cart <span class="highlighted">3</span></p>
            </div>

            <div class="dropdown-box-list scroll-small no-hover" data-simplebar>
              <div class="dropdown-box-list-item">
                <div class="cart-item-preview">
                  <a class="cart-item-preview-image" href="marketplace-product.html">
                    <figure class="picture medium round liquid">
                      <img src="img/marketplace/items/01.jpg" alt="item-01">
                    </figure>
                  </a>

                  <p class="cart-item-preview-title"><a href="marketplace-product.html">Twitch Stream UI Pack</a></p>

                  <p class="cart-item-preview-text">Regular License</p>

                  <p class="cart-item-preview-price"><span class="highlighted">$</span> 12.00 x 1</p>

                  <div class="cart-item-preview-action">
                    <svg class="icon-delete">
                      <use xlink:href="#svg-delete"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="cart-item-preview">
                  <a class="cart-item-preview-image" href="marketplace-product.html">
                    <figure class="picture medium round liquid">
                      <img src="img/marketplace/items/11.jpg" alt="item-11">
                    </figure>
                  </a>

                  <p class="cart-item-preview-title"><a href="marketplace-product.html">Gaming Coin Badges Pack</a>
                  </p>

                  <p class="cart-item-preview-text">Regular License</p>

                  <p class="cart-item-preview-price"><span class="highlighted">$</span> 6.00 x 1</p>

                  <div class="cart-item-preview-action">
                    <svg class="icon-delete">
                      <use xlink:href="#svg-delete"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="cart-item-preview">
                  <a class="cart-item-preview-image" href="marketplace-product.html">
                    <figure class="picture medium round liquid">
                      <img src="img/marketplace/items/10.jpg" alt="item-10">
                    </figure>
                  </a>

                  <p class="cart-item-preview-title"><a href="marketplace-product.html">Twitch Stream UI Pack</a></p>

                  <p class="cart-item-preview-text">Regular License</p>

                  <p class="cart-item-preview-price"><span class="highlighted">$</span> 26.00 x 1</p>

                  <div class="cart-item-preview-action">
                    <svg class="icon-delete">
                      <use xlink:href="#svg-delete"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="cart-item-preview">
                  <a class="cart-item-preview-image" href="marketplace-product.html">
                    <figure class="picture medium round liquid">
                      <img src="img/marketplace/items/04.jpg" alt="item-04">
                    </figure>
                  </a>

                  <p class="cart-item-preview-title"><a href="marketplace-product.html">Generic Joystick Pack</a></p>

                  <p class="cart-item-preview-text">Regular License</p>

                  <p class="cart-item-preview-price"><span class="highlighted">$</span> 16.00 x 1</p>

                  <div class="cart-item-preview-action">
                    <svg class="icon-delete">
                      <use xlink:href="#svg-delete"></use>
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <div class="cart-preview-total">
              <p class="cart-preview-total-title">Total:</p>

              <p class="cart-preview-total-text"><span class="highlighted">$</span> 60.00</p>
            </div>

            <div class="dropdown-box-actions">
              <div class="dropdown-box-action">
                <a class="button secondary" href="marketplace-cart.html">Shopping Cart</a>
              </div>

              <div class="dropdown-box-action">
                <a class="button primary" href="marketplace-checkout.html">Go to Checkout</a>
              </div>
            </div>
          </div>
        </div> --}}

        <div class="action-list-item-wrap">
          <div class="action-list-item header-dropdown-trigger">
            <svg class="action-list-item-icon icon-friend">
              <use xlink:href="#svg-friend"></use>
            </svg>
          </div>

          <div class="dropdown-box header-dropdown">
            <div class="dropdown-box-header">
              <p class="dropdown-box-header-title">Friend Requests</p>

              <div class="dropdown-box-header-actions">
                <p class="dropdown-box-header-action">Find Friends</p>

                <p class="dropdown-box-header-action">Settings</p>
              </div>
            </div>

            <div class="dropdown-box-list no-hover" data-simplebar>
              <div class="dropdown-box-list-item">
                <div class="user-status request">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">14</p>
                      </div>
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Ginny Danvers</a></p>

                  <p class="user-status-text">6 friends in common</p>

                  <div class="action-request-list">
                    <div class="action-request accept">
                      <svg class="action-request-icon icon-add-friend">
                        <use xlink:href="#svg-add-friend"></use>
                      </svg>
                    </div>

                    <div class="action-request decline">
                      <svg class="action-request-icon icon-remove-friend">
                        <use xlink:href="#svg-remove-friend"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status request">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">3</p>
                      </div>
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Paul Lang</a></p>

                  <p class="user-status-text">2 friends in common</p>

                  <div class="action-request-list">
                    <div class="action-request accept">
                      <svg class="action-request-icon icon-add-friend">
                        <use xlink:href="#svg-add-friend"></use>
                      </svg>
                    </div>

                    <div class="action-request decline">
                      <svg class="action-request-icon icon-remove-friend">
                        <use xlink:href="#svg-remove-friend"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status request">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">9</p>
                      </div>
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Cassie May</a></p>

                  <p class="user-status-text">4 friends in common</p>

                  <div class="action-request-list">
                    <div class="action-request accept">
                      <svg class="action-request-icon icon-add-friend">
                        <use xlink:href="#svg-add-friend"></use>
                      </svg>
                    </div>

                    <div class="action-request decline">
                      <svg class="action-request-icon icon-remove-friend">
                        <use xlink:href="#svg-remove-friend"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <a class="dropdown-box-button secondary" href="#">View all Requests</a>
          </div>
        </div>

        <div class="action-list-item-wrap">
          <div class="action-list-item header-dropdown-trigger">
            <svg class="action-list-item-icon icon-messages">
              <use xlink:href="#svg-messages"></use>
            </svg>
          </div>

          <div class="dropdown-box header-dropdown">
            <div class="dropdown-box-header">
              <p class="dropdown-box-header-title">Messages</p>

              <div class="dropdown-box-header-actions">
                <p class="dropdown-box-header-action">Mark all as Read</p>

                <p class="dropdown-box-header-action">Settings</p>
              </div>
            </div>

            <div class="dropdown-box-list medium" data-simplebar>
              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">Bearded Wonder</span></p>

                  <p class="user-status-text">Great! Then will meet with them at the party...</p>

                  <p class="user-status-timestamp floaty">29 mins ago</p>
                </div>
              </a>

              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">Neko Bebop</span></p>

                  <p class="user-status-text">Awesome! I'll see you there!</p>

                  <p class="user-status-timestamp floaty">54 mins ago</p>
                </div>
              </a>

              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">Nick Grissom</span></p>

                  <p class="user-status-text">Can you stream that new game?</p>

                  <p class="user-status-timestamp floaty">2 hours ago</p>
                </div>
              </a>

              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">26</p>
                      </div>
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">Sarah Diamond</span></p>

                  <p class="user-status-text">I'm sending you the latest news of the release...</p>

                  <p class="user-status-timestamp floaty">16 hours ago</p>
                </div>
              </a>

              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">10</p>
                      </div>
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">James Murdock</span></p>

                  <p class="user-status-text">Great! Then will meet with them at the party...</p>

                  <p class="user-status-timestamp floaty">7 days ago</p>
                </div>
              </a>

              <a class="dropdown-box-list-item" href="#">
                <div class="user-status">
                  <div class="user-status-avatar">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </div>

                  <p class="user-status-title"><span class="bold">The Green Goo</span></p>

                  <p class="user-status-text">Can you stream that new game?</p>

                  <p class="user-status-timestamp floaty">10 days ago</p>
                </div>
              </a>
            </div>

            <a class="dropdown-box-button primary" href="#">View all Messages</a>
          </div>
        </div>

        <div class="action-list-item-wrap">
          <div class="action-list-item header-dropdown-trigger">
            <svg class="action-list-item-icon icon-notification">
              <use xlink:href="#svg-notification"></use>
            </svg>
          </div>

          <div class="dropdown-box header-dropdown">
            <div class="dropdown-box-header">
              <p class="dropdown-box-header-title">Notifications</p>

              <div class="dropdown-box-header-actions">
                <p class="dropdown-box-header-action">Mark all as Read</p>

                <p class="dropdown-box-header-action">Settings</p>
              </div>
            </div>

            <div class="dropdown-box-list" data-simplebar>
              <div class="dropdown-box-list-item unread">
                <div class="user-status notification">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Nick Grissom</a>
                    posted a comment on your <a class="highlighted"
                      href="{{ route('pages.author', Auth::user()->username) }}">status update</a>
                  </p>

                  <p class="user-status-timestamp">2 minutes ago</p>

                  <div class="user-status-icon">
                    <svg class="icon-comment">
                      <use xlink:href="#svg-comment"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status notification">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">26</p>
                      </div>
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Sarah Diamond</a>
                    left a like <img class="reaction" src="{{ asset('assets/img/reactions/like.webp') }}"
                      alt="reaction-like"> reaction on
                    your <a class="highlighted" href="{{ route('pages.author', Auth::user()->username) }}">status
                      update</a></p>

                  <p class="user-status-timestamp">17 minutes ago</p>

                  <div class="user-status-icon">
                    <svg class="icon-thumbs-up">
                      <use xlink:href="#svg-thumbs-up"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status notification">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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

                        <p class="user-avatar-badge-text">13</p>
                      </div>
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Destroy Dex</a>
                    posted a comment on your <a class="highlighted" href="#">photo</a></p>

                  <p class="user-status-timestamp">31 minutes ago</p>

                  <div class="user-status-icon">
                    <svg class="icon-comment">
                      <use xlink:href="#svg-comment"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status notification">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">The Green Goo</a>
                    left a love <img class="reaction" src="{{ asset('assets/img/reactions/love.webp') }}"
                      alt="reaction-love"> reaction on
                    your <a class="highlighted" href="{{ route('pages.author', Auth::user()->username) }}">status
                      update</a></p>

                  <p class="user-status-timestamp">2 hours ago</p>

                  <div class="user-status-icon">
                    <svg class="icon-thumbs-up">
                      <use xlink:href="#svg-thumbs-up"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="dropdown-box-list-item">
                <div class="user-status notification">
                  <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                    <div class="user-avatar small no-outline">
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
                    </div>
                  </a>

                  <p class="user-status-title"><a class="bold"
                      href="{{ route('pages.author', Auth::user()->username) }}">Neko Bebop</a>
                    posted a comment on your <a class="highlighted"
                      href="{{ route('pages.author', Auth::user()->username) }}">status update</a>
                  </p>

                  <p class="user-status-timestamp">3 hours ago</p>

                  <div class="user-status-icon">
                    <svg class="icon-comment">
                      <use xlink:href="#svg-comment"></use>
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <a class="dropdown-box-button secondary" href="#">View all
              Notifications</a>
          </div>
        </div>
      </div>

      <div class="action-item-wrap">
        <div class="action-item dark header-settings-dropdown-trigger">
          <svg class="action-item-icon icon-settings">
            <use xlink:href="#svg-settings"></use>
          </svg>
        </div>

        <div class="dropdown-navigation header-settings-dropdown">
          <div class="dropdown-navigation-header">
            <div class="user-status">
              <a class="user-status-avatar" href="{{ route('pages.author', Auth::user()->username) }}">
                <div class="user-avatar small no-outline">
                  <div class="user-avatar-content">
                    <div class="hexagon-image-30-32"
                      data-src="{{ !empty(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('assets/img/profpic.svg') }}">
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
              </a>

              <p class="user-status-title"><span class="bold">Hi {{ explode(' ', Auth::user()->name)[0] }}!</span>
              </p>

              <p class="user-status-text small"><a
                  href="{{ route('pages.author', Auth::user()->username) }}">{{ '@' . Auth::user()->username }}</a>
              </p>
            </div>
          </div>

          <p class="dropdown-navigation-category">My Account</p>

          <a class="dropdown-navigation-link" href="{{ route('profile.edit') }}">Profile Info</a>
          <a class="dropdown-navigation-link" href="{{ route('profile.edit') }}#change-password">Change Password</a>
          <a class="dropdown-navigation-link" href="{{ route('profile.edit') }}#delete-account">Delete Account</a>

          <p class="dropdown-navigation-category">Groups</p>
          <a class="dropdown-navigation-link" href="#">Manage Groups</a>
          <a class="dropdown-navigation-link" href="#">Invitations</a>

          <p class="dropdown-navigation-category">Partner Program</p>
          <a class="dropdown-navigation-link" href="#">Est. Revenue <span class="highlighted">Rp2.754k</span></a>
          <a class="dropdown-navigation-link" href="#">Details</a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-navigation-button button small secondary" href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="ti ti-logout me-2 ti-sm"></i>
              Logout
            </a>
          </form>
        </div>
      </div>
    </div>
  @endguest
</header>

<aside class="floaty-bar">
  <div class="bar-actions">
    <div class="progress-stat">
      <div class="bar-progress-wrap">
        <p class="bar-progress-info">Next: <span class="bar-progress-text"></span></p>
      </div>

      <div id="logged-user-level-cp" class="progress-stat-bar"></div>
    </div>
  </div>

  <div class="bar-actions">
    <div class="action-list dark">
      {{-- <a class="action-list-item" href="marketplace-cart.html">
        <svg class="action-list-item-icon icon-shopping-bag">
          <use xlink:href="#svg-shopping-bag"></use>
        </svg>
      </a> --}}

      <a class="action-list-item" href="#">
        <svg class="action-list-item-icon icon-friend">
          <use xlink:href="#svg-friend"></use>
        </svg>
      </a>

      <a class="action-list-item" href="#">
        <svg class="action-list-item-icon icon-messages">
          <use xlink:href="#svg-messages"></use>
        </svg>
      </a>

      <a class="action-list-item" href="#">
        <svg class="action-list-item-icon icon-notification">
          <use xlink:href="#svg-notification"></use>
        </svg>
      </a>
    </div>

    <a class="action-item-wrap" href="{{ route('profile.edit') }}">
      <div class="action-item dark">
        <svg class="action-item-icon icon-settings">
          <use xlink:href="#svg-settings"></use>
        </svg>
      </div>
    </a>
  </div>
</aside>
