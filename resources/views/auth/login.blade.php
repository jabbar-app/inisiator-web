@extends('auth.layout')

@section('content')
  <!-- Login Card -->
  <div class="card">
    <div class="card-body">
      <!-- Logo -->
      <div class="app-brand justify-content-center mb-4 mt-2">
        <a href="/" class="app-brand-link">
          <img src="{{ asset('assets/img/company/inisiator-icon.svg') }}" class="app-brand-logo demo">
          <span class="app-brand-text demo text-body fw-bold">Inisiator</span>
        </a>
      </div>
      <!-- /Logo -->
      <h4 class="mb-1 pt-2">Login 🚀</h4>
      @if (request('message'))
        <div class="alert alert-warning my-3">
          {{ request('message') }}
        </div>
      @else
        <p class="mb-4">Masukkan email dan password untuk mengakses dashboard.</p>
      @endif

      <form action="{{ route('login') }}" method="POST" id="formAuthentication" class="mb-3">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required
            autofocus />
        </div>
        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="password">Password</label>
          <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
      </form>

      <p class="text-center">
        <span>Belum punya akun?</span>
        <a href="{{ route('register') }}">
          <span>Register</span>
        </a>
      </p>

      {{-- <div class="divider my-4">
        <div class="divider-text">atau gunakan</div>
      </div>

      <div class="d-flex justify-content-center">
        <a href="javascript:;" class="btn btn-label-google-plus">
          <i class="tf-icons fa-brands fa-google fs-5 me-2"></i> Google
        </a>
      </div> --}}
    </div>
  </div>
  <!-- Login Card -->
@endsection
