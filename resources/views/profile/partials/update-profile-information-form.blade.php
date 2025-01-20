<section>
  <header class="mb-4">
    <h2 class="h5 text-primary">
      {{ __('Profile Information') }}
    </h2>
    <p class="text-muted">
      {{ __("Update your account's profile information and email address.") }}
    </p>
  </header>

  <!-- Form to send verification -->
  <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
    @csrf
  </form>

  <!-- Main Profile Update Form -->
  <form method="post" action="{{ route('profile.update') }}" class="mt-4">
    @csrf
    @method('patch')

    <!-- Name Field -->
    <div class="mb-3">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}"
        required autofocus autocomplete="name">
      @if ($errors->has('name'))
        <div class="text-danger mt-1">
          {{ $errors->first('name') }}
        </div>
      @endif
    </div>

    <!-- Email Field -->
    <div class="mb-3">
      <label for="email" class="form-label">{{ __('Email') }}</label>
      <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}"
        required autocomplete="username">
      @if ($errors->has('email'))
        <div class="text-danger mt-1">
          {{ $errors->first('email') }}
        </div>
      @endif

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div class="mt-2">
          <p class="text-muted">
            {{ __('Your email address is unverified.') }}
            <button form="send-verification" class="btn btn-link p-0 align-baseline">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="text-success mt-2">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif
    </div>

    <!-- Save Button -->
    <div class="d-flex align-items-center gap-3">
      <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

      @if (session('status') === 'profile-updated')
        <p class="text-success m-0" id="saved-message">
          {{ __('Saved.') }}
        </p>
      @endif
    </div>
  </form>
</section>

<script>
  // Hide saved message after 2 seconds
  document.addEventListener('DOMContentLoaded', function() {
    const savedMessage = document.getElementById('saved-message');
    if (savedMessage) {
      setTimeout(() => {
        savedMessage.style.display = 'none';
      }, 2000);
    }
  });
</script>
