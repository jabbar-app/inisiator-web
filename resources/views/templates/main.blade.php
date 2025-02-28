<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/vendor/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/vendor/tiny-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
  <link rel="icon" href="{{ asset('assets/img/company/inisiator-icon.svg') }}">
  <title>
    @yield('title' . ' | ', 'Home | ') Inisiator
  </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Forum&family=Noto+Serif+JP:wght@200..900&display=swap">

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Tangkap semua link dengan href="#"
      const links = document.querySelectorAll('a[href="#"]');

      // Tambahkan event listener untuk setiap link
      links.forEach(link => {
        link.addEventListener('click', function(event) {
          event.preventDefault(); // Mencegah perilaku default link

          // Hitung tanggal besok
          const today = new Date();
          const tomorrow = new Date(today);
          tomorrow.setDate(today.getDate() + 4);

          // Format tanggal ke "28 Feb 2025"
          const options = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
          };
          const formattedDate = tomorrow.toLocaleDateString('en-US', options);

          // Tampilkan SweetAlert2
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
