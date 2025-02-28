<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Vikinger | Home')</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="{{ asset('theme/css/styles.min.css') }}">
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/company/inisiator-icon.svg') }}">

  <!-- Vite -->
  @vite(['resources/js/app.js'])
</head>

<body>
  <div id="app">
    @yield('content')
  </div>

  <!-- Bootstrap Bundle -->
  <script src="{{ asset('theme/js/app.bundle.min.js') }}"></script>
</body>

</html>
