@extends('auth.layout')

@section('content')
  <!-- Register Card -->
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
      <h4 class="mb-1 pt-2">Mulai menghasilkan 🚀</h4>
      <p class="mb-4">Tulis artikel atau selesaikan misi, daftar sekarang!</p>

      <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST"
        onsubmit="return validatePhone()">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
            autofocus />
        </div>
        <div class="mb-3">
          <label class="form-label">No. WhatsApp</label>
          <input type="tel" name="phone" value="{{ request()->query('phone') ?: old('phone') }}" placeholder="62XXX"
            pattern="^62[1-9][0-9]*$" oninput="validatePhoneNumber(this)" class="form-control" required>
          {{-- <small class="text-muted">Awalan input yang diperbolehkan adalah 62.</small> --}}
        </div>

        <script>
          function validatePhoneNumber(input) {
            // Remove all non-digit characters
            let sanitizedInput = input.value.replace(/\D/g, '');

            // Check if the first two digits are "62"
            if (!sanitizedInput.startsWith('62')) {
              sanitizedInput = '62';
            }

            // Remove leading zeroes after "62"
            sanitizedInput = sanitizedInput.replace(/^62[0]*/, '62');

            // Update the input value with the sanitized version
            input.value = sanitizedInput;
          }
        </script>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="name@domain.com"
            required />
        </div>
        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="password">Password</label>
          <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password" required />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
            <label class="form-check-label" for="terms-conditions">
              Saya setuju dengan
              <a href="javascript:void(0);">syarat & ketentuan</a>.
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid w-100">Register</button>
      </form>

      <p class="text-center">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}">
          <span>Login</span>
        </a>
      </p>

      <div class="divider my-4">
        <div class="divider-text">atau gunakan</div>
      </div>

      <div class="d-flex justify-content-center">
        <a href="javascript:void(0);" class="btn btn-label-google-plus">
          <i class="tf-icons fa-brands fa-google fs-5 me-2"></i> Google
        </a>
      </div>
    </div>
  </div>
  <!-- Register Card -->
@endsection
