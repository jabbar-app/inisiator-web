@extends('templates.main')

@section('content')
  <div class="content-grid">


    {{-- <div class="user-preview">
      <figure class="user-preview-cover liquid"
        style="background: url({{ asset('assets/img/backgrounds/cover.webp') }}) center center / cover no-repeat;">
        <img src="{{ asset('assets/img/backgrounds/cover.webp') }}" alt="cover-04" style="display: none;">
      </figure>

      <div class="user-preview-info">
        <div class="user-short-description">
          <a class="user-short-description-avatar user-avatar medium" href="profile-timeline.html">
            <div class="user-avatar-border">
              <div class="hexagon-120-132" style="width: 120px; height: 132px; position: relative;"><canvas
                  width="120" height="132" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            </div>

            <div class="user-avatar-content">
              <div class="hexagon-image-82-90" data-src="img/avatar/05.jpg"
                style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90"
                  style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            </div>

            <div class="user-avatar-progress">
              <div class="hexagon-progress-100-110" style="width: 100px; height: 110px; position: relative;"><canvas
                  width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            </div>

            <div class="user-avatar-progress-border">
              <div class="hexagon-border-100-110" style="width: 100px; height: 110px; position: relative;"><canvas
                  width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            </div>

            <div class="user-avatar-badge">
              <div class="user-avatar-badge-border">
                <div class="hexagon-32-36" style="width: 32px; height: 36px; position: relative;"><canvas
                    width="32" height="36" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              </div>

              <div class="user-avatar-badge-content">
                <div class="hexagon-dark-26-28" style="width: 26px; height: 28px; position: relative;"><canvas
                    width="26" height="28" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              </div>

              <div class="user-avatar-badge-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                  <path d="M13.5 6.5l4 4" />
                </svg>
              </div>
            </div>
          </a>

          <p class="user-short-description-title"><a href="profile-timeline.html">{{ $quiz->user->name }}</a></p>

          <p class="user-short-description-text"><a href="{{ route('pages.author', $quiz->user->username) }}">www.inisiator.com/{{ '@'.$quiz->user->username }}</a></p>
        </div>

        <div class="badge-list small">
          <div class="badge-item">
            <img src="img/badge/silver-s.png" alt="badge-silver-s">
          </div>

          <div class="badge-item">
            <img src="img/badge/fcultivator-s.png" alt="badge-fcultivator-s">
          </div>

          <div class="badge-item">
            <img src="img/badge/scientist-s.png" alt="badge-scientist-s">
          </div>

          <div class="badge-item">
            <img src="img/badge/rmachine-s.png" alt="badge-rmachine-s">
          </div>

          <a class="badge-item" href="profile-badges.html">
            <img src="img/badge/blank-s.png" alt="badge-blank-s">
            <p class="badge-item-text">+29</p>
          </a>
        </div>

        <div class="tns-outer" id="user-preview-stats-slides-01-ow">
          <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span
              class="current">1</span> of 2</div>
          <div id="user-preview-stats-slides-01-mw" class="tns-ovh">
            <div class="tns-inner" id="user-preview-stats-slides-01-iw">
              <div id="user-preview-stats-slides-01"
                class="user-preview-stats-slides  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                style="transition-duration: 0s; transform: translate3d(0%, 0px, 0px);">
                <div class="user-preview-stats-slide tns-item tns-slide-active" id="user-preview-stats-slides-01-item0">
                  <div class="user-stats">
                    <div class="user-stat">
                      <p class="user-stat-title">874</p>

                      <p class="user-stat-text">posts</p>
                    </div>

                    <div class="user-stat">
                      <p class="user-stat-title">60</p>

                      <p class="user-stat-text">friends</p>
                    </div>

                    <div class="user-stat">
                      <p class="user-stat-title">3.9k</p>

                      <p class="user-stat-text">visits</p>
                    </div>
                  </div>
                </div>

                <div class="user-preview-stats-slide tns-item" id="user-preview-stats-slides-01-item1"
                  aria-hidden="true" tabindex="-1">
                  <p class="user-preview-text">Hello! I'm James Hart, but I go by the name of Destroy Dex on my stream
                    channel. Come to check out the latest gaming news!</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="user-preview-stats-roster-01" class="user-preview-stats-roster slider-roster"
          aria-label="Carousel Pagination">
          <div class="slider-roster-item tns-nav-active" data-nav="0" aria-label="Carousel Page 1 (Current Slide)"
            aria-controls="user-preview-stats-slides-01"></div>

          <div class="slider-roster-item" data-nav="1" tabindex="-1" aria-label="Carousel Page 2"
            aria-controls="user-preview-stats-slides-01"></div>
        </div>

        <div class="social-links small">
          <a class="social-link small twitter" href="#">
            <svg class="social-link-icon icon-twitter">
              <use xlink:href="#svg-twitter"></use>
            </svg>
          </a>

          <a class="social-link small instagram" href="#">
            <svg class="social-link-icon icon-instagram">
              <use xlink:href="#svg-instagram"></use>
            </svg>
          </a>

          <a class="social-link small twitch" href="#">
            <svg class="social-link-icon icon-twitch">
              <use xlink:href="#svg-twitch"></use>
            </svg>
          </a>

          <a class="social-link small discord" href="#">
            <svg class="social-link-icon icon-discord">
              <use xlink:href="#svg-discord"></use>
            </svg>
          </a>
        </div>

        <div class="user-preview-actions">
          <p class="button secondary">Add Friend +</p>

          <p class="button primary">Send Message</p>
        </div>
      </div>
    </div> --}}


    {{-- <div class="container mt-4">
    <div class="text-center">
      <h1 class="mb-4">{{ $quiz->user->name }}'s Quiz</h1>
      <p class="text-muted">{{ $quiz->description ?? 'No description available.' }}</p>

      <div class="mt-4">
        <p><strong>Number of Questions:</strong> {{ $quiz->questions->count() }}</p>
        <p><strong>Created By:</strong> {{ $quiz->user->name ?? 'Unknown' }}</p>
        <p><strong>Date Created:</strong> {{ $quiz->created_at->format('d M Y') }}</p>
      </div>
    </div> --}}

    @include('layouts.session-message')
    <div class="section-banner">
      <img class="section-banner-icon" src="{{ asset('theme/img/quests-icon.webp') }}" alt="quests-icon">
      <div class="d-none d-md-block">
        <div class="d-flex justify-content-between align-items-center">
          <p class="section-banner-title">{{ $quiz->user->name }}'s Quiz</p>
          @if (Auth::check() && Auth::user()->id == $quiz->user->id)
            <div class="button tertiary w-25" data-bs-toggle="modal" data-bs-target="#customizeQuizModal" role="button"
              tabindex="0" style="cursor: pointer;">Customize Quiz
            </div>
          @else
            @if (!empty($response->identifier))
              <p class="button secondary w-25">Your Score: {{ $response->score }}</p>
            @else
              <a href="{{ route('play.dare.start', $quiz->slug) }}" class="button secondary w-25">Play Quiz</a>
            @endif
          @endif
        </div>
      </div>
      <div class="d-block d-sm-none">
        <p class="section-banner-title">{{ $quiz->user->name }}'s Quiz</p>
      </div>
    </div>

    @if (!empty($quiz->song))
      <div class="mt-3">
        <audio controls autoplay style="width: 100%;">
          <source src="{{ asset('assets/audio/' . $quiz->song) }}" type="audio/mpeg">
          Browser Anda tidak mendukung elemen audio.
        </audio>
      </div>
    @endif

    <div class="d-block d-sm-none">
      <a href="{{ route('dare-responses.create', ['slug' => $quiz->slug]) }}" class="button secondary w-100 mt-3">Play
        Quiz</a>
    </div>

    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <section class="section">
          <div class="section-header">
            <div class="section-header-info">
              <p class="section-pretitle">{{ $quiz->user->name }}'s</p>

              <h2 class="section-title">Top Leaderboard</h2>
            </div>
          </div>

          @if ($leaderboard->isNotEmpty())
            <table class="table text-center">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th class="text-start">Name</th>
                  <th>Score</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($leaderboard as $rank => $response)
                  <tr>
                    <td>{{ ($leaderboard->currentPage() - 1) * $leaderboard->perPage() + $rank + 1 }}</td>
                    <td class="text-start">{{ $response->responder_name }}</td>
                    <td>{{ $response->score }}</td>
                    <td>{{ formatTime($response->time) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <!-- Tampilkan pagination -->
            <div class="d-flex justify-content-center mt-4">
              {{ $leaderboard->links() }}
            </div>
          @else
            <p class="text-center text-muted my-4">No participants yet. Be the first to play!</p>
          @endif

          <div class="content-actions">
            <div class="content-action">
              <div class="meta-line">
                <div class="meta-line-list reaction-item-list">
                  @foreach (['Like', 'Love', 'Wow', 'Angry', 'Sad'] as $reaction)
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

                        @if (isset($reactions[$reaction]) && count($reactions[$reaction]) > 0)
                          @foreach ($reactions[$reaction] as $name)
                            <p class="simple-dropdown-text">{{ $name }}</p>
                          @endforeach

                          @if (count($reactions[$reaction]) > 5)
                            <p class="simple-dropdown-text">
                              <span class="bold">and {{ count($reactions[$reaction]) - 5 }} more...</span>
                            </p>
                          @endif
                        @else
                          <p class="simple-dropdown-text">No reactions yet.</p>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>

                <p class="meta-line-text">{{ number_format($quiz->reactions->count()) }}</p>
              </div>
            </div>

            <div class="content-action">
              <div class="meta-line">
                <p class="meta-line-link">{{ number_format($quiz->messages->count()) }} Messages</p>
              </div>

              <div class="meta-line">
                <p class="meta-line-text">0 Shares</p>
              </div>
            </div>
          </div>

          <div class="post-options">
            {{-- <div class="post-option-wrap" style="position: relative;">
              <div class="post-option reaction-options-dropdown-trigger">
                <svg class="post-option-icon icon-thumbs-up">
                  <use xlink:href="#svg-thumbs-up"></use>
                </svg>

                <p class="post-option-text">React!</p>
              </div>

              <div class="reaction-options reaction-options-dropdown"
                style="position: absolute; z-index: 9999; bottom: 54px; left: -16px; opacity: 0; visibility: hidden; transform: translate(0px, 20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                <div class="reaction-option text-tooltip-tft" data-title="Like" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/like.webp') }}"
                    alt="reaction-like">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -24px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Like</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Love" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/love.webp') }}"
                    alt="reaction-love">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Love</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Dislike" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/dislike.webp') }}"
                    alt="reaction-dislike">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -31.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Dislike</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Happy" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/happy.webp') }}"
                    alt="reaction-happy">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Happy</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Funny" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/funny.webp') }}"
                    alt="reaction-funny">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Funny</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Wow" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/wow.webp') }}"
                    alt="reaction-wow">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Wow</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Angry" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/angry.webp') }}"
                    alt="reaction-angry">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -29.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Angry</p>
                  </div>
                </div>

                <div class="reaction-option text-tooltip-tft" data-title="Sad" style="position: relative;">
                  <img class="reaction-option-image" src="{{ asset('assets/img/reactions/sad.webp') }}"
                    alt="reaction-sad">
                  <div class="xm-tooltip"
                    style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -23px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                    <p class="xm-tooltip-text">Sad</p>
                  </div>
                </div>
              </div>
            </div> --}}

            <!-- Tombol React -->
            <div class="post-option-wrap" style="position: relative;">
              <div class="post-option reaction-options-dropdown-trigger">
                <svg class="post-option-icon icon-thumbs-up">
                  <use xlink:href="#svg-thumbs-up"></use>
                </svg>
                <p class="post-option-text">React!</p>
              </div>

              <!-- Dropdown untuk pilihan reaksi -->
              <div class="reaction-options reaction-options-dropdown">
                @foreach (['Like', 'Love', 'Wow', 'Angry', 'Sad'] as $reaction)
                  <form action="{{ route('dare-reactions.store') }}" method="POST" class="reaction-form">
                    @csrf
                    <input type="hidden" name="dare_quiz_id" value="{{ $quiz->id }}">
                    <input type="hidden" name="name" value="{{ $response->name ?? 'Anonymous' }}">
                    <input type="hidden" name="content" value="{{ $reaction }}">
                    <button type="submit" class="reaction-option text-tooltip-tft" data-title="{{ $reaction }}">
                      <img class="reaction-option-image"
                        src="{{ asset('assets/img/reactions/' . strtolower($reaction) . '.webp') }}"
                        alt="reaction-{{ strtolower($reaction) }}">
                    </button>
                  </form>
                @endforeach
              </div>
            </div>

            <div class="post-option" data-bs-toggle="modal" data-bs-target="#sendMessageModal" role="button"
              tabindex="0" style="cursor: pointer;">
              <svg class="post-option-icon icon-comment">
                <use xlink:href="#svg-comment"></use>
              </svg>
              <div class="post-option-text">
                Send Message
              </div>
            </div>

            <div class="post-option">
              <svg class="post-option-icon icon-share">
                <use xlink:href="#svg-share"></use>
              </svg>

              <p class="post-option-text">Share</p>
            </div>
          </div>

          @guest
            <a href="{{ route('play.dare.create') }}" class="button primary w-100 mt-4">Create my own quiz</a>
          @endguest

        </section>
      </div>

      <div class="col-sm-12 col-lg-6">
        <section class="section">
          <div class="section-header mb-3">
            <div class="section-header-info">
              <p class="section-pretitle">Comments, Questions and Answers</p>

              <h2 class="section-title">{{ $quiz->user->name }}'s Wall</h2>
            </div>
          </div>
          <div id="comments" class="post-comment-list">
            @foreach ($quiz->messages as $message)
              @if ($message->is_visible || Auth::check() && Auth::user()->id == $message->quiz->user->id)
                <div class="post-comment px-0 py-2 bg-transparent">

                  <p class="post-comment-text">
                    <span class="post-comment-text-author">{{ $message->name }}</span> {{ $message->content }}
                  </p>

                  <div class="content-actions">
                    <div class="content-action">
                      <div class="meta-line">
                        <div class="meta-line-list reaction-item-list small">
                          <div class="reaction-item" style="position: relative;">
                            <img class="reaction-image reaction-item-dropdown-trigger"
                              src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy">

                            <div class="simple-dropdown padded reaction-item-dropdown"
                              style="position: absolute; z-index: 9999; bottom: 38px; left: -16px; opacity: 0; visibility: hidden; transform: translate(0px, 20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                              <p class="simple-dropdown-text"><img class="reaction"
                                  src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy"> <span
                                  class="bold">Happy</span></p>

                              <p class="simple-dropdown-text">Marcus Jhonson</p>
                            </div>
                          </div>

                          <div class="reaction-item" style="position: relative;">
                            <img class="reaction-image reaction-item-dropdown-trigger"
                              src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">

                            <div class="simple-dropdown padded reaction-item-dropdown"
                              style="position: absolute; z-index: 9999; bottom: 38px; left: -16px; opacity: 0; visibility: hidden; transform: translate(0px, 20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                              <p class="simple-dropdown-text"><img class="reaction"
                                  src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">
                                <span class="bold">Like</span>
                              </p>

                              <p class="simple-dropdown-text">Neko Bebop</p>

                              <p class="simple-dropdown-text">Nick Grissom</p>

                              <p class="simple-dropdown-text">Sarah Diamond</p>
                            </div>
                          </div>
                        </div>

                        <p class="meta-line-text">4</p>
                      </div>

                      <div class="meta-line" style="position: relative;">
                        <p class="meta-line-link light reaction-options-small-dropdown-trigger">React!</p>

                        <div class="reaction-options small reaction-options-small-dropdown"
                          style="position: absolute; z-index: 9999; bottom: 30px; left: -80px; opacity: 0; visibility: hidden; transform: translate(0px, 16px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                          <div class="reaction-option text-tooltip-tft" data-title="Like" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/like.webp') }}"
                              alt="reaction-like">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -24px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Like</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Love" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/love.webp') }}"
                              alt="reaction-love">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Love</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Dislike"
                            style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/dislike.webp') }}"
                              alt="reaction-dislike">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -31.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Dislike</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Happy" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/happy.webp') }}"
                              alt="reaction-happy">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Happy</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Funny" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/funny.webp') }}"
                              alt="reaction-funny">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Funny</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Wow" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/wow.webp') }}"
                              alt="reaction-wow">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Wow</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Angry" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/angry.webp') }}"
                              alt="reaction-angry">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -29.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Angry</p>
                            </div>
                          </div>

                          <div class="reaction-option text-tooltip-tft" data-title="Sad" style="position: relative;">
                            <img class="reaction-option-image" src="{{ asset('assets/img/reactions/sad.webp') }}"
                              alt="reaction-sad">
                            <div class="xm-tooltip"
                              style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -23px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                              <p class="xm-tooltip-text">Sad</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      @auth
                        @if (Auth::user()->id == $quiz->user->id)
                          <div class="meta-line">
                            <p class="meta-line-link light">Reply</p>
                          </div>
                        @endif
                      @endauth

                      <div class="meta-line">
                        <p class="meta-line-timestamp">{{ $message->created_at->diffForHumans() }}</p>
                      </div>

                      <div class="meta-line settings">
                        <div class="post-settings-wrap" style="position: relative;">
                          <div class="post-settings post-settings-dropdown-trigger">
                            <svg class="post-settings-icon icon-more-dots">
                              <use xlink:href="#svg-more-dots"></use>
                            </svg>
                          </div>

                          <div class="simple-dropdown post-settings-dropdown"
                            style="position: absolute; z-index: 9999; bottom: 30px; right: 0px; opacity: 0; visibility: hidden; transform: translate(0px, 16px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                            <p class="simple-dropdown-link">Report Post</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @foreach ($message->replies as $reply)
                  <div class="post-comment unread reply-2 px-4 py-2 d-flex" style="gap: 8px;">
                    <img
                      src="{{ $reply->user->avatar ? asset($reply->user->avatar) : asset('assets/img/profpic.svg') }}"
                      alt="" class="avatar-circle-36">

                    <div>
                      <p class="post-comment-text"><span
                          class="post-comment-text-author">{{ $reply->user->username }}</span>{{ $reply->content }}</p>

                      <div class="content-actions">
                        <div class="content-action">
                          <div class="meta-line">
                            <div class="meta-line-list reaction-item-list small">
                              <div class="reaction-item" style="position: relative;">
                                <img class="reaction-image reaction-item-dropdown-trigger"
                                  src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like">

                                <div class="simple-dropdown padded reaction-item-dropdown"
                                  style="position: absolute; z-index: 9999; bottom: 38px; left: -16px; opacity: 0; visibility: hidden; transform: translate(0px, 20px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                                  <p class="simple-dropdown-text"><img class="reaction"
                                      src="{{ asset('assets/img/reactions/like.webp') }}" alt="reaction-like"> <span
                                      class="bold">Like</span></p>

                                  <p class="simple-dropdown-text">Neko Bebop</p>
                                </div>
                              </div>
                            </div>

                            <p class="meta-line-text">1</p>
                          </div>

                          <div class="meta-line" style="position: relative;">
                            <p class="meta-line-link light reaction-options-small-dropdown-trigger">React!</p>

                            <div class="reaction-options small reaction-options-small-dropdown"
                              style="position: absolute; z-index: 9999; bottom: 30px; left: -80px; opacity: 0; visibility: hidden; transform: translate(0px, 16px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                              <div class="reaction-option text-tooltip-tft" data-title="Like"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/like.webp') }}"
                                  alt="reaction-like">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -24px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Like</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Love"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/love.webp') }}"
                                  alt="reaction-love">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Love</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Dislike"
                                style="position: relative;">
                                <img class="reaction-option-image"
                                  src="{{ asset('assets/img/reactions/dislike.webp') }}" alt="reaction-dislike">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -31.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Dislike</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Happy"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/happy.webp') }}"
                                  alt="reaction-happy">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Happy</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Funny"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/funny.webp') }}"
                                  alt="reaction-funny">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -30px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Funny</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Wow"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/wow.webp') }}"
                                  alt="reaction-wow">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -26px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Wow</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Angry"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/angry.webp') }}"
                                  alt="reaction-angry">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -29.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Angry</p>
                                </div>
                              </div>

                              <div class="reaction-option text-tooltip-tft" data-title="Sad"
                                style="position: relative;">
                                <img class="reaction-option-image" src="{{ asset('assets/img/reactions/sad.webp') }}"
                                  alt="reaction-sad">
                                <div class="xm-tooltip"
                                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -28px; left: 50%; margin-left: -23px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                                  <p class="xm-tooltip-text">Sad</p>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="meta-line">
                            <p class="meta-line-link light">Reply</p>
                          </div>

                          <div class="meta-line">
                            <p class="meta-line-timestamp">{{ $reply->created_at->diffForHumans() }}</p>
                          </div>

                          <div class="meta-line settings">
                            <div class="post-settings-wrap" style="position: relative;">
                              <div class="post-settings post-settings-dropdown-trigger">
                                <svg class="post-settings-icon icon-more-dots">
                                  <use xlink:href="#svg-more-dots"></use>
                                </svg>
                              </div>

                              <div class="simple-dropdown post-settings-dropdown"
                                style="position: absolute; z-index: 9999; bottom: 30px; right: 0px; opacity: 0; visibility: hidden; transform: translate(0px, 16px); transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;">
                                <p class="simple-dropdown-link">Report Post</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @endif
            @endforeach

            {{-- <p class="post-comment-heading">Load More Comments <span class="highlighted">1+</span></p> --}}
          </div>
        </section>
      </div>
    </div>
  </div>

  <div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="quick-post">
          <div class="quick-post-header">
            <h4 class="m-3">Send message to {{ $quiz->user->name }}</h4>
          </div>

          <div class="quick-post-body p-3">
            <form action="{{ route('dare-messages.store') }}" method="POST" class="form">
              @csrf
              <input type="hidden" name="dare_quiz_id" value="{{ $quiz->id }}">
              <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Message or Question</label>
                <textarea name="content" id="content" rows="4" class="form-control"
                  placeholder="Write your message or question here..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>

          <div class="quick-post-footer">
            <div class="quick-post-footer-actions">
              <div class="quick-post-footer-action text-tooltip-tft-medium" data-title="Insert Photo"
                style="position: relative;">
                <svg class="quick-post-footer-action-icon icon-camera">
                  <use xlink:href="#svg-camera"></use>
                </svg>
                <div class="xm-tooltip"
                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -32px; left: 50%; margin-left: -42.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                  <p class="xm-tooltip-text">Insert Photo</p>
                </div>
              </div>

              <div class="quick-post-footer-action text-tooltip-tft-medium" data-title="Insert GIF"
                style="position: relative;">
                <svg class="quick-post-footer-action-icon icon-gif">
                  <use xlink:href="#svg-gif"></use>
                </svg>
                <div class="xm-tooltip"
                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -32px; left: 50%; margin-left: -35.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                  <p class="xm-tooltip-text">Insert GIF</p>
                </div>
              </div>

              <div class="quick-post-footer-action text-tooltip-tft-medium" data-title="Insert Tag"
                style="position: relative;">
                <svg class="quick-post-footer-action-icon icon-tags">
                  <use xlink:href="#svg-tags"></use>
                </svg>
                <div class="xm-tooltip"
                  style="white-space: nowrap; position: absolute; z-index: 99999; top: -32px; left: 50%; margin-left: -36.5px; opacity: 0; visibility: hidden; transform: translate(0px, 10px); transition: 0.3s ease-in-out;">
                  <p class="xm-tooltip-text">Insert Tag</p>
                </div>
              </div>
            </div>

            <div class="quick-post-footer-actions">
              <p class="button small void">Discard</p>

              <p class="button small secondary">Post</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Song -->
  <div class="modal fade" id="customizeQuizModal" tabindex="-1" aria-labelledby="customizeQuizModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-nowrap" id="customizeQuizModalLabel">Pilih Lagu untuk Quiz</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="songForm" action="{{ route('quiz.updateSong', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="song" class="form-label">Pilih Lagu</label>
              <select class="form-select" id="song" name="song">
                <option value="">-- Pilih Lagu --</option>
                <option value="song1.mp3" {{ $quiz->song == 'song1.mp3' ? 'selected' : '' }}>Lagu 1</option>
                <option value="song2.mp3" {{ $quiz->song == 'song2.mp3' ? 'selected' : '' }}>Lagu 2</option>
                <option value="song3.mp3" {{ $quiz->song == 'song3.mp3' ? 'selected' : '' }}>Lagu 3</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" form="songForm" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const reactionTriggers = document.querySelectorAll('.reaction-options-dropdown-trigger');

      reactionTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
          e.stopPropagation();
          const dropdown = trigger.querySelector('.reaction-options');
          dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
        });
      });

      // Tutup dropdown saat klik di luar
      document.addEventListener('click', () => {
        reactionTriggers.forEach(trigger => {
          const dropdown = trigger.querySelector('.reaction-options');
          dropdown.style.display = 'none';
        });
      });
    });

    document.getElementById('songForm').addEventListener('submit', function(e) {
      e.preventDefault();

      fetch(this.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
          body: JSON.stringify({
            song: document.getElementById('song').value,
            _method: 'PUT',
          }),
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            alert('Lagu berhasil diperbarui!');
            location.reload(); // Reload halaman untuk melihat perubahan
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    });
  </script>
@endpush
