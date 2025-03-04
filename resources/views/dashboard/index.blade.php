@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="widget-box">
            <div class="widget-box-settings">
              <div class="post-settings-wrap" style="position: relative;">
                <div class="post-settings widget-box-post-settings-dropdown-trigger">
                  <svg class="post-settings-icon icon-more-dots">
                    <use xlink:href="#svg-more-dots"></use>
                  </svg>
                </div>

                <div class="simple-dropdown widget-box-post-settings-dropdown"
                  style="position: absolute; z-index: 9999; top: 30px; right: 9px; opacity: 0; visibility: hidden; transform: translate(0px, -20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="simple-dropdown-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); this.closest('form').submit();">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      Logout
                    </a>
                  </form>
                </div>
              </div>
            </div>

            <h2>Hi, {{ Auth::user()->name }}!</h2>

            <div class="widget-box-content">
              <h2 class="widget-box-title mb-2">Est. Revenue ({{ now()->locale('en')->translatedFormat('F Y') }}):</h2>
              <p class="widget-box-text mb-2">
                <span id="english-text" style="display: inline;">
                  This revenue estimate is a projection and may differ from actual earnings. Final earnings for this month
                  will
                  be finalized on the 3rd day of the following month.
                </span>
                <span id="indonesian-text" style="display: none;">
                  Estimasi pendapatan ini merupakan proyeksi dan mungkin berbeda dari pendapatan aktual. Pendapatan akhir
                  kamu
                  untuk bulan ini akan ditetapkan pada hari ke-3 di bulan berikutnya.
                </span>
                <a href="javascript:void(0);" id="translate-link" onclick="toggleLanguage()">[Terjemahkan]</a>
              </p>

              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h2 class="mb-1 text-info">Rp{{ number_format($totalEarnings, 0, ',', '.') }},-</h2>
                  <p class="widget-box-text">
                    @if ($percentageChange != 0)
                      {{ number_format($percentageChange, 1, ',', '.') }}%
                      {{ $percentageChange > 0 ? 'increase' : 'decrease' }}
                      compared to last month
                    @else
                      No change from last month
                    @endif
                  </p>
                </div>
                <a href="{{ route('earnings.index') }}" class="button primary w-25">More details</a>
              </div>

              {{-- Tampilkan View Grafik di sini --}}
              <div class="d-none d-md-block mt-4">
                <canvas id="monthlyStatsChart" style="height: 300px;"></canvas>
              </div>

              <div class="week-box">
                @foreach ($weekEarnings as $day => $amount)
                  <div class="week-box-item {{ strtolower($day) == strtolower(now()->format('l')) ? 'active' : '' }}">
                    <p class="week-box-item-title">
                      @if ($amount > 0)
                        Rp{{ number_format($amount, 0, ',', '.') }}
                      @else
                        -
                      @endif
                    </p>
                    <p class="week-box-item-text">{{ $day }}s</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="widget-box mt-5">
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-7 col-12 mb-sm-2">
                <div class="d-flex justify-content-between align-items-center">
                  @php
                    $rewards = [25, 50, 25, 50, 10, 15, 2500];
                    $streak = Auth::user()->check_in_streak ?? 0;
                  @endphp

                  @foreach ($rewards as $index => $reward)
                    <div class="text-center" style="flex: 1;">
                      <div class="icon mb-2">
                        @if ($streak > $index)
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="#00c7d9" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                              d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                          </svg>
                        @else
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
                            <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
                            <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
                            <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
                            <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
                            <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
                            <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
                            <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
                            <path d="M9 12l2 2l4 -4" />
                          </svg>
                        @endif
                      </div>

                      <p class="mb-0" style="font-size: 14px;">Day {{ $index + 1 }}</p>
                      <strong>Rp{{ number_format($reward, 0, ',', '.') }}</strong>
                    </div>

                    @if ($index < count($rewards) - 1)
                      <div class="d-none d-md-block">
                        <div class="progress-line mt-2"
                          style="width: 20px; height: 2px; background-color: {{ $streak > $index ? '#00c7d9' : '#dcdcdc' }};">
                        </div>
                      </div>
                    @endif
                  @endforeach

                </div>
              </div>

              <div class="col-lg-4 col-md-5 col-12 text-end">
                @if (Auth::user()->check_in_date === now()->format('Y-m-d'))
                  <button class="button white w-100" disabled>Checked-In</button>
                @else
                  <form action="{{ route('check-in') }}" method="POST">
                    @csrf
                    <div class="d-none d-md-block">
                      <button type="submit" class="button secondary">
                        Daily Check-In
                      </button>
                    </div>
                    <div class="d-block d-md-none">
                      <button type="submit" class="button secondary mt-2">
                        Daily Check-In
                      </button>
                    </div>
                  </form>
                @endif
              </div>
            </div>
          </div>

          <div class="row my-4">
            <div class="col-12">
              @include('components.adsense-responsive')
            </div>
          </div>

          <div class="d-none d-md-block">
            <nav class="section-navigation mt-4 d-flex justify-content-center">
              <div id="section-navigation-slider" class="section-menu">

                <a class="section-menu-item active" href="{{ route('dashboard') }}">
                  <svg class="section-menu-item-icon icon-blog-posts">
                    <use xlink:href="#svg-blog-posts"></use>
                  </svg>

                  <p class="section-menu-item-text">Dashboard</p>
                </a>

                <a class="section-menu-item" href="#">
                  <svg class="section-menu-item-icon icon-timeline">
                    <use xlink:href="#svg-timeline"></use>
                  </svg>

                  <p class="section-menu-item-text">Timeline</p>
                </a>

                <a class="section-menu-item" href="#">
                  <svg class="section-menu-item-icon icon-friend">
                    <use xlink:href="#svg-friend"></use>
                  </svg>

                  <p class="section-menu-item-text">Friends</p>
                </a>

                <a class="section-menu-item" href="#">
                  <svg class="section-menu-item-icon icon-group">
                    <use xlink:href="#svg-group"></use>
                  </svg>

                  <p class="section-menu-item-text">Groups</p>
                </a>

                {{-- <a class="section-menu-item" href="#">
                <svg class="section-menu-item-icon icon-photos">
                  <use xlink:href="#svg-photos"></use>
                </svg>

                <p class="section-menu-item-text">Photos</p>
              </a>

              <a class="section-menu-item" href="#">
                <svg class="section-menu-item-icon icon-videos">
                  <use xlink:href="#svg-videos"></use>
                </svg>

                <p class="section-menu-item-text">Videos</p>
              </a> --}}

                <a class="section-menu-item" href="#">
                  <svg class="section-menu-item-icon icon-badges">
                    <use xlink:href="#svg-badges"></use>
                  </svg>

                  <p class="section-menu-item-text">Quests</p>
                </a>

                <a class="section-menu-item" href="{{ route('profile.edit') }}">
                  <svg class="section-menu-item-icon icon-profile">
                    <use xlink:href="#svg-profile"></use>
                  </svg>

                  <p class="section-menu-item-text">Profile</p>
                </a>

                {{-- <a class="section-menu-item" href="#">
                <svg class="section-menu-item-icon icon-streams">
                  <use xlink:href="#svg-streams"></use>
                </svg>

                <p class="section-menu-item-text">Streams</p>
              </a>

              <a class="section-menu-item" href="#">
                <svg class="section-menu-item-icon icon-forum">
                  <use xlink:href="#svg-forum"></use>
                </svg>

                <p class="section-menu-item-text">Forum</p>
              </a>

              <a class="section-menu-item" href="#">
                <svg class="section-menu-item-icon icon-store">
                  <use xlink:href="#svg-store"></use>
                </svg>

                <p class="section-menu-item-text">Store</p>
              </a> --}}
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
          </div>

          <section class="section">
            <div class="section-header">
              <div class="section-header-info">
                <p class="section-pretitle">{{ Auth::user()->name }}'s</p>
                <h2 class="section-title">Statistic Articles</h2>
              </div>
              <a href="{{ route('articles.create') }}" class="button primary w-25">Write Article</a>
            </div>

            <div class="section-filters-bar v5">
              <div class="section-filters-bar-actions">
                <div class="filter-tabs">
                  <div class="filter-tab active">
                    <p class="filter-tab-text">All Posts</p>
                  </div>

                  <div class="filter-tab">
                    <p class="filter-tab-text">Most Earning</p>
                  </div>

                  <div class="filter-tab">
                    <p class="filter-tab-text">Most Popular</p>
                  </div>
                </div>

                <form class="form">
                  <div class="form-select">
                    <label for="forum-filter-category">Filter By</label>
                    <select id="forum-filter-category" name="forum_filter_category">
                      <option value="0">Topics Started</option>
                      <option value="1">My Replies</option>
                      <option value="2">Liked Topics</option>
                    </select>
                    <svg class="form-select-icon icon-small-arrow">
                      <use xlink:href="#svg-small-arrow"></use>
                    </svg>
                  </div>
                </form>
              </div>

              <div class="section-filters-bar-actions">
                <form class="form">
                  <div class="form-item split medium">
                    <div class="form-select small">
                      <label for="forum-filter-order">Order By</label>
                      <select id="forum-filter-order" name="forum_filter_order">
                        <option value="0">Newest First</option>
                        <option value="1">Oldest First</option>
                      </select>
                      <svg class="form-select-icon icon-small-arrow">
                        <use xlink:href="#svg-small-arrow"></use>
                      </svg>
                    </div>

                    <button class="button primary">Apply Filter</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="table table-forum-discussion">
              <div class="table-header">
                <div class="table-header-column">
                  <p class="table-header-title">Detail Articles</p>
                </div>

                <div class="table-header-column centered padded-medium">
                  <p class="table-header-title">Status</p>
                </div>

                <div class="table-header-column centered padded-medium">
                  <p class="table-header-title">Earnings</p>
                </div>

                <div class="table-header-column padded-big-left">
                  <p class="table-header-title">Published In</p>
                </div>
              </div>

              <div class="table-body">
                @foreach ($articles as $article)
                  <div class="table-row medium">
                    <div class="table-column">
                      <div class="discussion-preview">
                        <a class="discussion-preview-title" href="{{ route('articles.show', $article->slug) }}">
                          {{ $article->title }}
                        </a>

                        <div class="discussion-preview-meta">

                          {{-- <a class="user-avatar micro no-border" href="{{ route('pages.author', $article->user->username) }}">
                            <div class="user-avatar-content">
                              <div class="hexagon-image-18-20" data-src="{{ $article->user->avatar ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}"
                                style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                                  style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                            </div>
                          </a> --}}

                          <p class="discussion-preview-meta-text">
                            Written in <a class="highlighted" href="#">{{ $article->category->title }}</a>
                            {{ $article->updated_at->diffForHumans() }}
                            //
                            @if ($article->status === 'approved')
                              approved by
                              <a href="{{ route('pages.author', $article->user->username) }}">
                                {{ '@' . $article->user->username }}
                              </a>
                            @else
                              waiting for approval
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="table-column centered padded-medium">
                      <p class="table-title">{{ Str::ucfirst($article->status) }}</p>
                    </div>

                    <div class="table-column centered padded-medium">
                      <p class="table-title">Rp{{ number_format($article->eranings, 0, ',', '.') }}</p>
                    </div>

                    <div class="table-column padded-big-left">
                      <div class="user-status">
                        <a class="user-status-avatar" href="{{ route('pages.author', $article->user->username) }}">
                          <div class="user-avatar small no-outline">
                            <div class="user-avatar-content">
                              <div class="hexagon-image-30-32"
                                data-src="{{ $article->user->avatar ? asset($article->user->avatar) : asset('assets/img/profpic.svg') }}"
                                style="width: 30px; height: 32px; position: relative;"><canvas width="30"
                                  height="32" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                            </div>

                            <div class="user-avatar-progress">
                              <div class="hexagon-progress-40-44"
                                style="width: 40px; height: 44px; position: relative;">
                                <canvas width="40" height="44"
                                  style="position: absolute; top: 0px; left: 0px;"></canvas>
                              </div>
                            </div>

                            <div class="user-avatar-progress-border">
                              <div class="hexagon-border-40-44" style="width: 40px; height: 44px; position: relative;">
                                <canvas width="40" height="44"
                                  style="position: absolute; top: 0px; left: 0px;"></canvas>
                              </div>
                            </div>

                            <div class="user-avatar-badge">
                              <div class="user-avatar-badge-border">
                                <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;">
                                  <canvas width="22" height="24"
                                    style="position: absolute; top: 0px; left: 0px;"></canvas>
                                </div>
                              </div>

                              <div class="user-avatar-badge-content">
                                <div class="hexagon-dark-16-18" style="width: 16px; height: 18px; position: relative;">
                                  <canvas width="16" height="18"
                                    style="position: absolute; top: 0px; left: 0px;"></canvas>
                                </div>
                              </div>

                              <p class="user-avatar-badge-text">6</p>
                            </div>
                          </div>
                        </a>

                        <p class="user-status-title">
                          <a class="bold" href="{{ route('pages.author', $article->user->username) }}">
                            {{ $article->user->name }}
                          </a>
                        </p>

                        <p class="user-status-text small">Personal page, {{ $article->updated_at->diffForHumans() }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </section>

          <div class="row my-2">
            <div class="col-12">
              @include('components.adsense-responsive')
            </div>
          </div>

          {{-- <section class="section">
            <div class="section-header">
              <div class="section-header-info">
                <p class="section-pretitle">Kumpulkan XP lebih banyak dengan main games seru!</p>
                <h2 class="section-title">Games & Quiz Seru</h2>
              </div>
            </div>

            <div class="grid grid-3-3-3-3 centered">
              <!-- PRODUCT CATEGORY BOX -->
              <a class="product-category-box category-all" href="marketplace-category.html">
                <!-- PRODUCT CATEGORY BOX TITLE -->
                <p class="product-category-box-title">Browse All</p>
                <!-- /PRODUCT CATEGORY BOX TITLE -->

                <!-- PRODUCT CATEGORY BOX TEXT -->
                <p class="product-category-box-text">Check out all items</p>
                <!-- /PRODUCT CATEGORY BOX TEXT -->

                <!-- PRODUCT CATEGORY BOX TAG -->
                <p class="product-category-box-tag">1360 items</p>
                <!-- /PRODUCT CATEGORY BOX TAG -->
              </a>
              <!-- /PRODUCT CATEGORY BOX -->

              <!-- PRODUCT CATEGORY BOX -->
              <a class="product-category-box category-featured" href="marketplace-category.html">
                <!-- PRODUCT CATEGORY BOX TITLE -->
                <p class="product-category-box-title">Featured</p>
                <!-- /PRODUCT CATEGORY BOX TITLE -->

                <!-- PRODUCT CATEGORY BOX TEXT -->
                <p class="product-category-box-text">Handpicked by us</p>
                <!-- /PRODUCT CATEGORY BOX TEXT -->

                <!-- PRODUCT CATEGORY BOX TAG -->
                <p class="product-category-box-tag">254 items</p>
                <!-- /PRODUCT CATEGORY BOX TAG -->
              </a>
              <!-- /PRODUCT CATEGORY BOX -->

              <!-- PRODUCT CATEGORY BOX -->
              <a class="product-category-box category-digital" href="marketplace-category.html">
                <!-- PRODUCT CATEGORY BOX TITLE -->
                <p class="product-category-box-title">Digital</p>
                <!-- /PRODUCT CATEGORY BOX TITLE -->

                <!-- PRODUCT CATEGORY BOX TEXT -->
                <p class="product-category-box-text">Logos, banners...</p>
                <!-- /PRODUCT CATEGORY BOX TEXT -->

                <!-- PRODUCT CATEGORY BOX TAG -->
                <p class="product-category-box-tag">1207 items</p>
                <!-- /PRODUCT CATEGORY BOX TAG -->
              </a>
              <!-- /PRODUCT CATEGORY BOX -->

              <!-- PRODUCT CATEGORY BOX -->
              <a class="product-category-box category-physical" href="marketplace-category.html">
                <!-- PRODUCT CATEGORY BOX TITLE -->
                <p class="product-category-box-title">Physical</p>
                <!-- /PRODUCT CATEGORY BOX TITLE -->

                <!-- PRODUCT CATEGORY BOX TEXT -->
                <p class="product-category-box-text">Prints, joysticks...</p>
                <!-- /PRODUCT CATEGORY BOX TEXT -->

                <!-- PRODUCT CATEGORY BOX TAG -->
                <p class="product-category-box-tag">153 items</p>
                <!-- /PRODUCT CATEGORY BOX TAG -->
              </a>
              <!-- /PRODUCT CATEGORY BOX -->
            </div>

            <div class="grid grid-3-3-3-3 centered">
              <div class="quest-item">
                <figure class="quest-item-cover liquid"
                  style="background: url('{{ asset('theme/img/landing-background.webp') }}') center center / cover no-repeat;">
                  <img src="{{ asset('theme/img/landing-background.webp') }}" alt="cover-01" style="display: none;">
                </figure>

                <p class="text-sticker small-text">
                  <svg class="text-sticker-icon icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                  60 EXP
                </p>

                <div class="quest-item-info">
                  <div class="quest-item-badge">
                    <img src="{{ asset('theme/img/completedq-l.webp') }}" alt="openq-b" style="width: 46px;">
                  </div>

                  <p class="quest-item-title">Social King</p>

                  <p class="quest-item-text">You have linked at least 8 social networks to your profile</p>

                  <div class="progress-stat">
                    <div id="quest-sk" class="progress-stat-bar" style="width: 228px; height: 4px; position: relative;">
                      <canvas width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas><canvas
                        width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas>
                    </div>

                    <div class="bar-progress-wrap small">
                      <p class="bar-progress-info negative start"><span class="bar-progress-text no-space">7<span
                            class="bar-progress-unit">/</span>8</span>completed</p>
                    </div>
                  </div>

                  <div class="quest-item-meta">
                    <div class="user-avatar-list">
                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="{{ asset('assets/img/profpic.svg') }}"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>
                    </div>

                    <div class="quest-item-meta-info">
                      <p class="quest-item-meta-title">+24 authors</p>

                      <p class="quest-item-meta-text">played this games</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="quest-item">
                <figure class="quest-item-cover liquid"
                  style="background: url(&quot;img/quest/cover/02.png&quot;) center center / cover no-repeat;">
                  <img src="img/quest/cover/02.png" alt="cover-02" style="display: none;">
                </figure>

                <p class="text-sticker small-text">
                  <svg class="text-sticker-icon icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                  40 EXP
                </p>

                <div class="quest-item-info">
                  <div class="quest-item-badge">
                    <img src="img/quest/completedq-b.png" alt="completedq-b">
                  </div>

                  <p class="quest-item-title">Friendly User</p>

                  <p class="quest-item-text">Give 50 like and/or love reactions on your friends' posts</p>

                  <div class="progress-stat">
                    <div id="quest-fu" class="progress-stat-bar" style="width: 228px; height: 4px; position: relative;">
                      <canvas width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas><canvas
                        width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas>
                    </div>

                    <div class="bar-progress-wrap small">
                      <p class="bar-progress-info negative start"><span class="bar-progress-text no-space">50<span
                            class="bar-progress-unit">/</span>50</span>completed</p>
                    </div>
                  </div>

                  <div class="quest-item-meta">
                    <div class="user-avatar-list">
                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/14.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/16.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/11.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/08.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/15.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/05.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/04.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/13.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>
                    </div>

                    <div class="quest-item-meta-info">
                      <p class="quest-item-meta-title">+33 friends</p>

                      <p class="quest-item-meta-text">completed this quest</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="quest-item">
                <figure class="quest-item-cover liquid"
                  style="background: url(&quot;img/quest/cover/03.png&quot;) center center / cover no-repeat;">
                  <img src="img/quest/cover/03.png" alt="cover-03" style="display: none;">
                </figure>

                <p class="text-sticker small-text">
                  <svg class="text-sticker-icon icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                  40 EXP
                </p>

                <div class="quest-item-info">
                  <div class="quest-item-badge">
                    <img src="img/quest/openq-b.png" alt="openq-b">
                  </div>

                  <p class="quest-item-title">Nothing to Hide</p>

                  <p class="quest-item-text">You have completed all your profile information fields</p>

                  <div class="progress-stat">
                    <div id="quest-nth" class="progress-stat-bar" style="width: 228px; height: 4px; position: relative;">
                      <canvas width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas><canvas
                        width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas>
                    </div>

                    <div class="bar-progress-wrap small">
                      <p class="bar-progress-info negative start"><span class="bar-progress-text no-space">67<span
                            class="bar-progress-unit">%</span></span>completed</p>
                    </div>
                  </div>

                  <div class="quest-item-meta">
                    <div class="user-avatar-list">
                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/10.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/04.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/13.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/03.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/02.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/22.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/14.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/12.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>
                    </div>

                    <div class="quest-item-meta-info">
                      <p class="quest-item-meta-title">+24 friends</p>

                      <p class="quest-item-meta-text">completed this quest</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="quest-item">
                <figure class="quest-item-cover liquid"
                  style="background: url(&quot;img/quest/cover/04.png&quot;) center center / cover no-repeat;">
                  <img src="img/quest/cover/04.png" alt="cover-04" style="display: none;">
                </figure>

                <p class="text-sticker small-text">
                  <svg class="text-sticker-icon icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                  100 EXP
                </p>

                <div class="quest-item-info">
                  <div class="quest-item-badge">
                    <img src="img/quest/openq-b.png" alt="openq-b">
                  </div>

                  <p class="quest-item-title">Store Manager</p>

                  <p class="quest-item-text">You have uploaded at least 10 items in your shop</p>

                  <div class="progress-stat">
                    <div id="quest-sm" class="progress-stat-bar" style="width: 228px; height: 4px; position: relative;">
                      <canvas width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas><canvas
                        width="228" height="4" style="position: absolute; top: 0px; left: 0px;"></canvas>
                    </div>

                    <div class="bar-progress-wrap small">
                      <p class="bar-progress-info negative start"><span class="bar-progress-text no-space">5<span
                            class="bar-progress-unit">/</span>10</span>completed</p>
                    </div>
                  </div>

                  <div class="quest-item-meta">
                    <div class="user-avatar-list">
                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/15.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/07.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/03.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/11.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/14.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/13.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/05.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>

                      <div class="user-avatar micro no-stats">
                        <div class="user-avatar-border">
                          <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                              width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>

                        <div class="user-avatar-content">
                          <div class="hexagon-image-18-20" data-src="img/avatar/22.jpg"
                            style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                              style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                        </div>
                      </div>
                    </div>

                    <div class="quest-item-meta-info">
                      <p class="quest-item-meta-title">+5 friends</p>

                      <p class="quest-item-meta-text">completed this quest</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="friendship-dare">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title f-rajdhani">Friendship Dare</p>
                    <p class="badge-item-preview-text f-rajdhani">Buktikan siapa teman sejatimu! Jawab tantangan kocak & ungkap
                      seberapa
                      dalam mereka mengenalmu</p>
                    <p class="badge-item-preview-timestamp f-rajdhani text-info mb-4">+100 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="meme-master">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Meme Master</p>
                    <p class="badge-item-preview-text">Tebak lanjutan meme viral Indonesia! Uji kecanduanmu pada meme lokal</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+80 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="gaul-challenge">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Bahasa Gaul 2024</p>
                    <p class="badge-item-preview-text">Uji skill bahasa slangmu! Tebak arti kata-kata kekinian seperti "Kepo
                      Mintol"</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+120 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                @include('components.adsense-responsive')
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="drakor-trivia">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Drakor Detective</p>
                    <p class="badge-item-preview-text">Tebak drama Korea dari cuplikan dialog & plot twist-nya! Untuk para
                      bibimbap lovers</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+150 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="tiktok-challenge">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">TikTok Remix</p>
                    <p class="badge-item-preview-text">Lanjutkan lirik challenge musik TikTok! Beat yang salah = malu-maluin
                    </p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+90 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="food-quiz">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Jurus Food Vlogger</p>
                    <p class="badge-item-preview-text">Tebak makanan lokal dari deskripsi receh atau foto yang di-zoom aneh</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+110 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="celeb-trivia">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Raja/Ratu Gosip</p>
                    <p class="badge-item-preview-text">Tebak selebgram dari foto masa kecil atau fakta random yang bikin
                      geleng-geleng</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+130 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                <div class="badge-item-preview h-100">
                  <img class="badge-item-preview-image" src="{{ asset('assets/img/profpic.svg') }}" alt="riddle-game">
                  <div class="badge-item-preview-info">
                    <p class="badge-item-preview-title">Riddle Receh</p>
                    <p class="badge-item-preview-text">Teka-teki kocak ala netizen Indonesia. Jawabannya bikin ngakak atau
                      ngakak!</p>
                    <p class="badge-item-preview-timestamp text-info mb-4">+70 XP</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 mb-4">
                @include('components.adsense-responsive')
              </div>

            </div>
          </section> --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('monthlyStatsChart').getContext('2d');

      const monthlyStatsChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: @json($dates),
          datasets: [{
              label: 'Views',
              data: @json($viewsData),
              borderColor: '#00c7d9',
              backgroundColor: 'rgba(0, 199, 217, 0.1)',
              borderWidth: 2,
              fill: true,
            },
            {
              label: 'Reads',
              data: @json($readsData),
              borderColor: '#ff6384',
              backgroundColor: 'rgba(255, 99, 132, 0.1)',
              borderWidth: 2,
              fill: true,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              grid: {
                display: false
              },
              title: {
                display: true,
                text: 'Tanggal'
              }
            },
            y: {
              beginAtZero: true,
              grid: {
                color: '#e0e0e0'
              },
              title: {
                display: true,
                text: 'Jumlah'
              }
            }
          },
          plugins: {
            tooltip: {
              enabled: true,
              mode: 'index',
              intersect: false
            },
            legend: {
              position: 'top',
              labels: {
                boxWidth: 12,
                padding: 20
              }
            }
          }
        }
      });
    });
  </script>
  <script>
    let isEnglish = true;

    function toggleLanguage() {
      const englishText = document.getElementById('english-text');
      const indonesianText = document.getElementById('indonesian-text');
      const translateLink = document.getElementById('translate-link');

      if (isEnglish) {
        englishText.style.display = 'none';
        indonesianText.style.display = 'inline';
        translateLink.textContent = '[Translate]';
      } else {
        englishText.style.display = 'inline';
        indonesianText.style.display = 'none';
        translateLink.textContent = '[Terjemahkan]';
      }

      isEnglish = !isEnglish;
    }

    // Set default language to English on page load
    window.onload = function() {
      document.getElementById('english-text').style.display = 'inline';
      document.getElementById('indonesian-text').style.display = 'none';
    };
  </script>
@endpush
