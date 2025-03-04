@extends('auth.layout')

@section('content')
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

      <h4 class="mb-1 pt-2">Buat Akun 🚀</h4>
      <p class="mb-4">Untuk saat ini, pendaftaran hanya bisa dilakukan melalui Undangan, silakan masukkan kode referral
        kamu:</p>

      @include('layouts.session-message')

      @if (session('inviter'))
        <!-- Jika Kode Referral Valid -->
        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST"
          onsubmit="return validatePhone()">
          @csrf
          <div class="mb-3">
            <label for="invited_by" class="form-label">Diundang oleh</label>
            <input type="text" class="form-control" id="invited_by" name="invited_by"
              value="{{ session('inviter')->name }}" readonly>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Input Nama Lengkap"
              value="{{ old('name') }}" required autofocus />
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Buat username"
              value="{{ old('username') }}" required />
          </div>
          <div class="mb-3">
            <label class="form-label">No. WhatsApp</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="62XXX" pattern="^62[1-9][0-9]*$"
              oninput="validatePhoneNumber(this)" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@domain.com"
              value="{{ old('email') }}" required />
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
                Saya setuju dengan <a href="javascript:void(0);">syarat & ketentuan</a>.
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100">Register</button>
        </form>
      @else
        <!-- Jika Kode Referral Belum Dimasukkan atau Tidak Valid -->
        <form id="formReferral" class="mb-3" action="{{ route('validate.referral') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="referral_code" class="form-label">Kode Referral</label>
            <input type="text" class="form-control" id="referral_code" name="referral_code"
              placeholder="Masukkan kode referral kamu" required>
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100">Verifikasi</button>
        </form>
      @endif

      <p class="text-center">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login', ['url' => request()->fullUrl()]) }}">
          <span>Login</span>
        </a>
      </p>

      <div class="divider my-4">
        <div class="divider-text">atau</div>
      </div>

      <div class="d-flex justify-content-center">
        <a href="{{ route('pages.request-invitation') }}" class="btn btn-outline-primary">
          Request Undangan
        </a>
      </div>
    </div>
  </div>

  <script>
    function validatePhoneNumber(input) {
      let sanitizedInput = input.value.replace(/\D/g, '');
      if (!sanitizedInput.startsWith('62')) {
        sanitizedInput = '62';
      }
      sanitizedInput = sanitizedInput.replace(/^62[0]*/, '62');
      input.value = sanitizedInput;
    }
  </script>
@endsection
