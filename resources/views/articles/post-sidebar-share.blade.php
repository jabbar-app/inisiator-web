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
      href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
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
        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
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
