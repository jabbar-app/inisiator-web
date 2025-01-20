<section>
  <header class="mb-4">
    <h2 class="h5 text-primary">
      {{ __('Update Password') }}
    </h2>
    <p class="text-muted">
      {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div class="mb-3">
      <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
      <input id="update_password_current_password" name="current_password" type="password" class="form-control"
        autocomplete="current-password">
      @if ($errors->updatePassword->has('current_password'))
        <div class="text-danger mt-1">
          {{ $errors->updatePassword->first('current_password') }}
        </div>
      @endif
    </div>

    <!-- New Password -->
    <div class="mb-3">
      <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
      <input id="update_password_password" name="password" type="password" class="form-control"
        autocomplete="new-password">
      @if ($errors->updatePassword->has('password'))
        <div class="text-danger mt-1">
          {{ $errors->updatePassword->first('password') }}
        </div>
      @endif
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
      <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
      <input id="update_password_password_confirmation" name="password_confirmation" type="password"
        class="form-control" autocomplete="new-password">
      @if ($errors->updatePassword->has('password_confirmation'))
        <div class="text-danger mt-1">
          {{ $errors->updatePassword->first('password_confirmation') }}
        </div>
      @endif
    </div>

    <!-- Save Button -->
    <div class="d-flex align-items-center gap-3">
      <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

      @if (session('status') === 'password-updated')
        <p class="text-success m-0" id="password-updated-message">
          {{ __('Saved.') }}
        </p>
      @endif
    </div>
  </form>
</section>

<script>
  // Hide success message after 2 seconds
  document.addEventListener('DOMContentLoaded', function() {
    const updatedMessage = document.getElementById('password-updated-message');
    if (updatedMessage) {
      setTimeout(() => {
        updatedMessage.style.display = 'none';
      }, 2000);
    }
  });
</script>
