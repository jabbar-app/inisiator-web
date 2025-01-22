<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-no-customizer">

<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#ffffff">

  <!-- Meta Title -->
  <title>Inisiator — A storytelling platform.</title>

  <!-- Meta Description -->
  <meta name="description"
    content="Inisiator adalah platform storytelling untuk berbagi cerita inspiratif, mendalam, dan bermakna. Temukan kisah-kisah menarik dari berbagai kategori, seperti hubungan, budaya, teknologi, dan eksplorasi." />

  <!-- Meta Keywords -->
  <meta name="keywords"
    content="storytelling, cerita inspiratif, platform cerita, hubungan, teknologi, budaya, eksplorasi, psikologi, edukasi" />

  <!-- Canonical URL -->
  <link rel="canonical" href="https://inisiator.com" />

  <!-- Author -->
  <meta name="author" content="Inisiator Team" />

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="Inisiator - A storytelling platform." />
  <meta property="og:description"
    content="Tempat untuk menemukan dan berbagi cerita yang mendalam dan bermakna. Jelajahi berbagai kisah inspiratif tentang hubungan, budaya, eksplorasi, dan banyak lagi." />
  <meta property="og:image" content="{{ asset('assets/img/profpic.svg') }}" />
  <meta property="og:url" content="https://inisiator.com" />
  <meta property="og:type" content="website" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Inisiator - A storytelling platform." />
  <meta name="twitter:description"
    content="Temukan cerita inspiratif dan bermakna dari berbagai kategori, mulai dari hubungan hingga eksplorasi." />
  <meta name="twitter:image" content="{{ asset('assets/img/profpic.svg') }}" />

  <!-- Mobile Optimization -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/company/inisiator-icon.svg') }}" />

  <!-- Bootstrap, Font Awesome, Aminate, Owl Carausel, Normalize CSS -->
  <link href="{{ asset('front/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/owl.theme.default.min.css') }}" rel="stylesheet">

  <!-- Site CSS -->
  <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/widgets.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/color-default.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">

  <!-- Bunny fonts-->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=b612-mono:400,400i,700,700i|cabin:400,700|lora:400,400i,700,700i"
    rel="stylesheet" />

  <!-- Icons fonts-->
  <link rel="stylesheet" href="{{ asset('front/css/fontello.css') }}">

  <!--Poprup-->
  <link rel="stylesheet" href="{{ asset('front/css/popup.css') }}">
  <link rel="stylesheet" href="{{ asset('front/css/customize.css') }}">

  <script src="{{ asset('front/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front/js/jquery.bpopup.min.js') }}"></script>

  {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}"> --}}
  @include('layouts.css')
</head>

<body class="home">
  <div class="top-scroll-bar"></div>

  <!--Mobile navigation-->
  <div class="sticky-header fixed d-lg-none d-md-block">
    <div class="text-right">
      <div class="container mobile-menu-fixed pr-5">
        <h1 class="logo-small navbar-brand">
          <a href="{{ route('pages.home') }}" class="logo">Inisiator</a>
        </h1>
        @auth
          <a class="author-avatar" href="{{ route('dashboard') }}"><img
              src="{{ Auth::user()->avatar ?? asset('assets/img/profpic.svg') }}" alt="{{ Auth::user()->name }}"></a>
        @endauth

        <a href="javascript:void(0)" class="menu-toggle-icon">
          <span class="lines"></span>
        </a>
      </div>
    </div>

    <div class="mobi-menu">
      <div class="mobi-menu__logo">
        <h1 class="logo navbar-brand"><a href="{{ route('pages.home') }}" class="logo">Inisiator</a></h1>
      </div>
      <form action="{{ route('pages.search') }}" method="get" class="menu-search-form d-lg-flex">
        <input type="text" class="search_field" placeholder="Search..." value="{{ request('s') }}" name="s">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
      <nav>
        <ul>
          <li class="{{ Route::is('pages.home') ? 'current-menu-item' : '' }}"><a
              href="{{ route('pages.home') }}">Home</a></li>
          <li class="menu-item-has-children"><a href="categories.html">Categories</a>
            <ul class="sub-menu">
              <li><a href="categories.html">Politics</a></li>
              <li><a href="categories.html">Health</a></li>
              <li><a href="categories.html">Design</a></li>
            </ul>
          </li>
          <li><a href="typography.html">Typography</a></li>
          <li><a href="categories.html">Politics</a></li>
          <li><a href="categories.html">Health</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </div>
  <!--Mobile navigation-->

  <div id="wrapper">
    <header id="header" class="d-lg-block d-none">
      <div class="mx-4">
        <div class="align-items-center w-100">
          <div class="d-flex justify-content-between">
            <div class="d-flex">
              <h1 class="logo text-left float-left navbar-brand">
                <a href="{{ route('pages.home') }}" class="logo">Inisiator</a>
              </h1>
              <form action="{{ route('pages.search') }}" method="get" class="search-container">
                <i class="ti ti-search search-icon"></i>
                <input type="text" class="form-control search-input" placeholder="Search..."
                  value="{{ request('s') }}" name="s">
              </form>
            </div>
            <div class="header-right float-right w-50">
              <div class="d-inline-flex float-right text-right align-items-center">
                <ul class="social-network heading navbar-nav d-lg-flex align-items-center">
                  <li><a href="#" target="_blank"><i class="icon-linkedin"></i></a></li>
                  <li><a href="https://twitter.com/inisiatorcom" target="_blank"><i class="icon-twitter"></i></a>
                  </li>
                  <li><a href="https://instagram.com/inisiatorcom" target="_blank"><i class="icon-instagram"></i></a>
                  </li>
                </ul>
                <ul class="top-menu heading navbar-nav w-100 d-lg-flex align-items-center">
                  <li>
                    @guest
                      <a href="{{ route('login') }}" class="btn  btn-outline-primary rounded-pill px-4">Login/Register</a>
                    @else
                      <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">Dashboard</a>
                    @endguest
                  </li>
                </ul>
                @auth
                  <a class="author-avatar" href="{{ route('pages.author', Auth::user()->username) }}"><img
                      src="{{ Auth::user()->avatar ?? asset('assets/img/profpic.svg') }}"
                      alt="{{ Auth::user()->name }}"></a>
                @endauth
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <p class="text-center mt-2 mb-0 bg-light position-relative dismissible-alert"
        style="padding: 14px 40px 14px 0; color: #212121; font-size: 14px;">

        <img src="{{ asset('assets/img/rocket.svg') }}" alt="Inisiator" height="16" style="margin-top: -4px;">
        Tingkatkan views hingga 10x lipat. Dapatkan
        <a href="#" style="text-decoration: underline; font-weight: 600;">badge verifikasi</a> sekarang!

        <!-- Close button -->
        <a href="javascript:void(0);" onclick="closeBanner()" class="position-absolute btn-banner-close">
          ×
        </a>
        <script>
          function closeBanner() {
            console.log('halo');
          }
        </script>
      </p>

      <nav id="main-menu" class="stick d-lg-block d-none">
        <div class="container">
          <div class="menu-primary">
            <ul class="d-flex justify-content-start" style="gap: 2rem;">
              <li><a href="{{ route('articles.create') }}"><i class="ti ti-plus mb-1"></i></a></li>
              <li><a href="{{ route('pages.home') }}" class="{{ Route::is('pages.home') ? 'menu-active' : '' }}"><a
                    href="{{ route('pages.home') }}">Home</a></li>
              <li><a href="#">Following</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    @include('layouts.session-message')
    @yield('content')

    <footer class="mt-5">
      <div class="container">
        <div class="divider"></div>
        <div class="row">
          <div class="col-md-6 copyright text-xs-center">
            <p>2025 &copy; Inisiator by <a href="https://lomba.id">LombaLomba</a></p>
          </div>
          <div class="col-md-6">
            <ul class="social-network inline text-md-right text-sm-center">
              <li class="list-inline-item"><a href="#"><i class="icon-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="icon-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="icon-behance"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div> <!--#wrapper-->
  <a href="#" class="back-to-top heading"><i class="icon-left-open-big"></i><span
      class="d-lg-inline d-md-none">Top</span></a>

  <div id="modalAdblock" style="display: none;">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h6 class="fw-normal mb-2" style="font-size: 18px;">
              <img src="{{ asset('assets/img/company/inisiator-icon.svg') }}" alt="Inisiator" height="24">
              Inisiator Prime
            </h6>
            <h1 class="fw-bold mb-3">It looks like you’re using an ad-blocker!</h1>
            <p class="text-muted">
              This website is an advertising-supported platform, and we noticed you have ad-blocking enabled.
              Here are two ways you can keep enjoying our content:
            </p>
            <div class="d-flex justify-content-center align-items-center">
              <div class="p-4 text-center">
                <small class="text-muted">TURN OFF YOUR AD-BLOCKER</small>
                <a href="" class="btn btn-outline-primary rounded-pill btn-block mt-2">RELOAD</a>
              </div>
              <div class="p-4 text-center">
                <small class="text-muted">JOIN OUR MEMBERSHIP</small>
                <a href="" class="btn btn-primary rounded-pill btn-block px-4 mt-2">GET ACCESS NOW</a>
              </div>
            </div>

            <small class="row justify-content-between mx-1 mt-4">
              <a href="#">Learn more about Inisiator Prime</a>
              @guest
                <span>
                  Already a member? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </span>
              @endguest
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // Create a dummy ad element
      const adBlockTester = document.createElement('div');
      adBlockTester.className = 'ad-banner'; // Class name commonly blocked by adblockers
      adBlockTester.style.display = 'none'; // Hide it visually
      document.body.appendChild(adBlockTester);

      // Check if adblock is active
      const isAdblockActive = window.getComputedStyle(adBlockTester).getPropertyValue('display') === 'none';

      if (isAdblockActive) {
        $('#modalAdblock').bPopup(); // Show the popup
      }

      // Clean up: remove the test element
      document.body.removeChild(adBlockTester);
    });
  </script>

  <!--Scripts-->
  <script src="{{ asset('front/js/bootstrap.js') }}"></script>
  <script src="{{ asset('front/js/jquery-scrolltofixed-min.js') }}"></script>
  <script src="{{ asset('front/js/theia-sticky-sidebar.js') }}"></script>
  <script src="{{ asset('front/js/scripts.js') }}"></script>

  @include('layouts.js')
  @stack('scripts')
</body>

</html>

@push('scripts')
  <script>
    function close() {
      console.log('halo');
    }

    document.addEventListener('DOMContentLoaded', () => {
      const closeBtn = document.querySelector('.alert-close-btn');
      const alertBox = document.querySelector('.dismissible-alert');

      closeBtn.addEventListener('click', () => {
        alertBox.style.display = 'none'; // Hide the <p> element
      });
    });
  </script>
@endpush
