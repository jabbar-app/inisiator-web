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
              <a href="{{ route('articles.show', $related->slug) }}" class="fw-400">{{ $related->title }}</a>
            </h5>
          </div>
          <div class="post-preview-info-bottom">
            <p class="post-preview-text fw-300">{{ Str::words(strip_tags($related->content), 36, '...') }}</p>
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
                      <img class="reaction" src="{{ asset('assets/img/reactions/happy.webp') }}" alt="reaction-happy">
                      <span class="bold">Happy</span>
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
              <a class="meta-line-link fw-400"
                href="{{ route('articles.show', $related->slug) }}#comments">{{ $related->comments_count ?? 0 }}
                Comments</a>
            </div>
            <div class="meta-line">
              <p class="meta-line-text fw-400">0 Shares</p>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
