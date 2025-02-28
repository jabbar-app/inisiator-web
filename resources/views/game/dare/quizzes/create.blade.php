@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <div class="row m-0">
      <div class="col-sm-12 col-md-6 mx-auto">
        <div class="widget-box">
          @guest
            <h3 class="mb-3">Create Account</h3>
            <p>Verify your account by input <strong>valid</strong> WhatsApp Number first. We'll send <strong>confirmation
                code</strong> to this number below:</p>
            <div class="widget-box-content">
              <form action="{{ route('register.whatsapp') }}" method="POST" class="form"
                onsubmit="return validateWhatsAppNumber()">
                @csrf

                <div class="form-item mb-4">
                  <label for="country-code" class="form-label">Country Code</label>
                  <select id="country-code" name="country_code" class="form-select"
                    style="border: 1px solid #dedeea; border-radius: 14px;">
                    @foreach ($countryCodes as $code => $country)
                      <option value="{{ $code }}" {{ $code == 62 ? 'selected' : '' }}>{{ $country }} (+{{ $code }})</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-item mb-4">
                  <div class="form-input small">
                    <label for="phone">WhatsApp</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required autofocus
                      oninput="validateNumberInput(this)">
                    @error('phone')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                  <div class="">
                    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                  </div>
                  <button type="submit" class="button primary w-auto px-5">Validate</button>
                </div>
              </form>

            </div>
          @else
            @if (empty(Auth::user()->username))
              <h2 class="mb-3">Complete Profile</h2>
              <p><strong>WhatsApp Validated! </strong> Please complete your profile below.</p>
              <div class="widget-box-content">
                <form action="{{ route('register.update') }}" method="POST" class="form">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  <div class="form-item mb-4">
                    <div class="form-input small">
                      <label for="name">Full Name</label>
                      <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-item mb-4">
                    <div class="form-input small">
                      <label for="username">Username</label>
                      <input type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="off">
                      @error('username')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-item mb-4">
                    <div class="form-input small">
                      <label for="email">Email Address</label>
                      <input type="text" id="email" name="email" value="{{ old('email') }}" autocomplete="off"
                        required>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-item mb-4">
                    <div class="form-input small">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" autocomplete="off" required>
                      @error('password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <div></div>
                    <button type="submit" class="button primary w-auto px-5">Next</button>
                  </div>
                </form>

              </div>
            @else
              <h2 class="mb-3">Create Quiz</h2>
              <div class="widget-box-content">
                <a href="{{ route('play.dare.store') }}" class="button primary w-auto px-5">Next</a>
              </div>
            @endif
          @endguest
        </div>

        <div class="mt-4">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function getWhatsAppNumberFromURL() {
      const url = window.location.href;

      const match = url.match(/\/(\d+)$/);
      if (match && match[1]) {
        return match[1];
      }
      return null;
    }

    function fillWhatsAppNumber() {
      const phoneInput = document.getElementById('phone');
      const whatsappNumber = getWhatsAppNumberFromURL();

      if (whatsappNumber) {
        phoneInput.value = whatsappNumber;
      }
    }

    window.onload = fillWhatsAppNumber;
  </script>
  <script>
    function validateNumberInput(input) {
      input.value = input.value.replace(/\D/g, '');
    }

    function validateWhatsAppNumber() {
      const phoneInput = document.getElementById('phone');
      const countryCodeInput = document.getElementById('country-code');
      let phoneNumber = phoneInput.value.trim();

      phoneNumber = phoneNumber.replace(/\D/g, '');

      if (phoneNumber.length === 0) {
        alert('Nomor WhatsApp tidak boleh kosong.');
        return false;
      }

      const countryCode = countryCodeInput.value;

      if (phoneNumber.startsWith('0')) {
        phoneNumber = countryCode + phoneNumber.substring(1);
      } else if (!phoneNumber.startsWith(countryCode)) {
        phoneNumber = countryCode + phoneNumber;
      }

      if (phoneNumber.length < 10) {
        alert('Nomor WhatsApp tidak valid.');
        return false;
      }

      phoneInput.value = phoneNumber;

      return true;
    }
  </script>
@endpush
