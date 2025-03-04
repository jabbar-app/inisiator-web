@extends('templates.main')

@section('title', 'Playing Ground')
@section('meta_description', 'Playing Ground')
@section('meta_keywords', )

@section('content')

  <div class="content-grid full">
    <div class="container">
      <div class="section-header mb-4">
        <div class="section-header-info">
          <p class="section-pretitle">See what's next!</p>

          <h2 class="section-title">Upcoming Events</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-md-4 mb-4">
          <div class="event-preview">
            <figure class="event-preview-cover liquid">
              <img src="{{ asset('assets/img/backgrounds/cover.webp') }}" alt="cover-47" style="display: none;">
            </figure>

            <div class="event-preview-info">
              <div class="event-preview-info-top">
                <div class="date-sticker w-25">
                  <p class="date-sticker-day">480</p>

                  <p class="date-sticker-month">XP</p>
                </div>

                <p class="event-preview-title popup-event-information-trigger">Breakfast with Neko</p>

                <p class="event-preview-timestamp"><span class="bold">8:30</span> AM</p>

                <p class="event-preview-text">Hi Neko! I'm creating this event to invite you to have breakfast before
                  work.
                  Meet me at Coffebucks.</p>
              </div>

              <div class="event-preview-info-bottom">
                <div class="decorated-text">
                  <svg class="decorated-text-icon icon-pin">
                    <use xlink:href="#svg-pin"></use>
                  </svg>

                  <p class="decorated-text-content">Downtown Coffeebucks</p>
                </div>

                <div class="meta-line">
                  <div class="meta-line-list user-avatar-list">
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
                        <div class="hexagon-image-18-20" data-src="img/avatar/01.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>
                  </div>

                  <p class="meta-line-text">will assist</p>
                </div>

                <p class="button white white-tertiary">Remove from Calendar</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
          <div class="event-preview">
            <figure class="event-preview-cover liquid"
              style="background: url(&quot;img/cover/23.jpg&quot;) center center / cover no-repeat;">
              <img src="img/cover/23.jpg" alt="cover-23" style="display: none;">
            </figure>

            <div class="event-preview-info">
              <div class="event-preview-info-top">
                <div class="date-sticker">
                  <p class="date-sticker-day">13</p>

                  <p class="date-sticker-month">Aug</p>
                </div>

                <p class="event-preview-title popup-event-information-trigger">Streaming Party</p>

                <p class="event-preview-timestamp"><span class="bold">10:00</span> PM - <span
                    class="bold">11:30</span>
                  PM</p>

                <p class="event-preview-text">The biggest party for Twitch streamers! Come and join us at Shenron Arena.
                </p>
              </div>

              <div class="event-preview-info-bottom">
                <div class="decorated-text">
                  <svg class="decorated-text-icon icon-pin">
                    <use xlink:href="#svg-pin"></use>
                  </svg>

                  <p class="decorated-text-content">Shenron Arena</p>
                </div>

                <div class="meta-line">
                  <div class="meta-line-list user-avatar-list">
                    <div class="user-avatar micro no-stats">
                      <div class="user-avatar-border">
                        <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-18-20" data-src="img/avatar/09.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>

                    <div class="user-avatar micro no-stats">
                      <div class="user-avatar-border">
                        <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
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
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-18-20" data-src="img/avatar/12.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>

                    <div class="user-avatar micro no-stats">
                      <div class="user-avatar-border">
                        <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
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
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-18-20" data-src="img/avatar/06.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>
                  </div>

                  <p class="meta-line-text">+31 will assist</p>
                </div>

                <p class="button white white-tertiary">Remove from Calendar</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
          <div class="event-preview">
            <figure class="event-preview-cover liquid"
              style="background: url(&quot;img/cover/33.jpg&quot;) center center / cover no-repeat;">
              <img src="img/cover/33.jpg" alt="cover-33" style="display: none;">
            </figure>

            <div class="event-preview-info">
              <div class="event-preview-info-top">
                <div class="date-sticker">
                  <p class="date-sticker-day">26</p>

                  <p class="date-sticker-month">Aug</p>
                </div>

                <p class="event-preview-title popup-event-information-trigger">CosWorld 2019 After Party</p>

                <p class="event-preview-timestamp"><span class="bold">11:00</span> PM</p>

                <p class="event-preview-text">Join us at the CosWorld after party! We'll be eating, drinking and having a
                  great time exchanging experiences...</p>
              </div>

              <div class="event-preview-info-bottom">
                <div class="decorated-text">
                  <svg class="decorated-text-icon icon-pin">
                    <use xlink:href="#svg-pin"></use>
                  </svg>

                  <p class="decorated-text-content">CosWorld Arena</p>
                </div>

                <div class="meta-line">
                  <div class="meta-line-list user-avatar-list">
                    <div class="user-avatar micro no-stats">
                      <div class="user-avatar-border">
                        <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-18-20" data-src="img/avatar/06.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>

                    <div class="user-avatar micro no-stats">
                      <div class="user-avatar-border">
                        <div class="hexagon-22-24" style="width: 22px; height: 24px; position: relative;"><canvas
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
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
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
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
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
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
                            width="22" height="24" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-18-20" data-src="img/avatar/05.jpg"
                          style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20"
                            style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                      </div>
                    </div>
                  </div>

                  <p class="meta-line-text">+24 will assist</p>
                </div>

                <p class="button white white-tertiary">Remove from Calendar</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
