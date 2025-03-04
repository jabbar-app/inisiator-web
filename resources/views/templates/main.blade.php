<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @yield('title', 'Home')&nbsp;|&nbsp;Inisiator
  </title>

  <meta name="description" content="@yield('meta_description', 'Deskripsi default untuk Inisiator.')">
  <meta name="keywords" content="@yield('meta_keywords', 'kata kunci, inisiator, website')">

  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ request()->url() }}">
  <meta property="og:title" content="@yield('title', 'Home')&nbsp;|&nbsp;Inisiator">
  <meta property="og:description" content="@yield('meta_description', 'Deskripsi default untuk Inisiator.')">
  <meta property="og:image" content="@yield('meta_image', asset('assets/img/profpic.svg'))">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ request()->url() }}">
  <meta property="twitter:title" content="@yield('title', 'Home')&nbsp;|&nbsp;Inisiator">
  <meta property="twitter:description" content="@yield('meta_description', 'Deskripsi default untuk Inisiator.')">
  <meta property="twitter:image" content="@yield('meta_image', asset('assets/img/profpic.svg'))">

  <link rel="canonical" href="{{ request()->url() }}">

  {{-- <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/vendor/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/vendor/tiny-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
  <link rel="icon" href="{{ asset('assets/img/profpic.svg') }}">

  {{-- CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  @if (app()->environment('prod'))
    <script>
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault(); // Blokir klik kanan
      });

      document.addEventListener('keydown', function(e) {
        // Blokir Ctrl+U, Ctrl+Shift+I, Ctrl+Shift+J, F12
        if (e.ctrlKey && (e.key === 'u' || e.key === 'U')) {
          e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'i')) {
          e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && (e.key === 'J' || e.key === 'j')) {
          e.preventDefault();
        }
        if (e.key === 'F12') {
          e.preventDefault();
        }
      });
    </script>
  @endif

  @stack('styles')
</head>

<body>
  @if (!request()->is('play*'))
    @include('templates.header')
  @endif

  <main id="content">
    <div class="d-none d-md-block" style="margin-top: 80px;"></div>
    <div class="d-block d-md-none" style="margin-top: 48px;"></div>
    {{-- <hr class="mt-0">
    <div class="container">
      <div class="d-flex" style="gap: 24px;">
        <a href="#">+</a>
        <a href="#" class="text-primary">STORY</a>
        <a href="#">PLAY</a>
        <a href="#">JOB OPPORTUNITIES</a>
        <a href="#">TRENDING</a>
      </div>
    </div>
    <hr> --}}
    @yield('content')
  </main>

  <script src="{{ asset('theme/js/app.bundle.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const links = document.querySelectorAll('a[href="#"]');
      links.forEach(link => {
        link.addEventListener('click', function(event) {
          event.preventDefault();
          const today = new Date();
          const tomorrow = new Date(today);
          tomorrow.setDate(today.getDate() + 4);
          const options = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
          };
          const formattedDate = tomorrow.toLocaleDateString('en-US', options);
          Swal.fire({
            title: 'Fitur Segera Hadir!',
            text: `Fitur akan segera tersedia pada tanggal ${formattedDate}.`,
            icon: 'info',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#00c7d9',
          });
        });
      });
    });
  </script>
  @stack('scripts')
</body>

</html>
