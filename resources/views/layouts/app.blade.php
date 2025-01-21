<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#ffffff">

  <!-- Meta Title -->
  <title>Inisiator - A storytelling platform.</title>

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

  {{-- Dashboard CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />

  @stack('styles')


  <script src="{{ asset('front/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front/js/jquery.bpopup.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#popup_this').bPopup();
    });
  </script>
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
                      <a href="{{ route('login') }}" class="btn rounded-pill">Login/Register</a>
                    @else
                      <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
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

  <!-- ads popup -->
  {{-- <div id="popup_this">
    <span class="button b-close">
      <span>X</span>
    </span>
    <a href="#" target="_blank"><img src="{{ asset('front/img/wp-version.png') }}" alt="ads"></a>
  </div> --}}

  <!--Scripts-->
  <script src="{{ asset('front/js/bootstrap.js') }}"></script>
  <script src="{{ asset('front/js/jquery-scrolltofixed-min.js') }}"></script>
  <script src="{{ asset('front/js/theia-sticky-sidebar.js') }}"></script>
  <script src="{{ asset('front/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
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
