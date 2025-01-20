<section>
  <header class="mb-4">
    <h2 class="h5 text-primary">
      {{ __('Profile Information') }}
    </h2>
    <p class="text-muted">
      {{ __("Update your account's profile information including your avatar, name, username, email, and phone.") }}
    </p>
  </header>

  <!-- Form to send verification -->
  <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
    @csrf
  </form>

  <!-- Main Profile Update Form -->
  <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
    @csrf
    @method('patch')
    <div class="row">
      <div class="col-4">
        <!-- Avatar Field -->
        <div class="row mb-3">
          <label class="form-label" for="avatar">Avatar</label>
          <div class="text-center">
            {{-- {{ dd($user->avatar) }} --}}
            <!-- Display Current or Default Avatar -->
            <img id="preview-avatar"
              src="{{ $user->avatar ? asset($user->avatar) : asset('assets/images/default-avatar.png') }}"
              alt="User Avatar" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">

            <!-- File Input -->
            <input type="file" name="avatar" class="form-control" id="avatar" accept="image/*">

            <!-- Hidden Input to Store Cropped Image -->
            <input type="hidden" name="cropped_avatar" id="cropped-avatar">
          </div>
        </div>

        <!-- Modal for Cropping -->
        <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop and Adjust Avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="crop-container text-center">
                  <img id="image-to-crop" src="" alt="Image to Crop" style="max-width: 100%;">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop-save">Save Changes</button>
              </div>
            </div>
          </div>
        </div>

        <style>
          .crop-container img {
            max-height: 400px;
            object-fit: contain;
          }
        </style>
      </div>

      <div class="col-8">
        <!-- Name Field -->
        <div class="mb-3">
          <label for="name" class="form-label">{{ __('Name') }}</label>
          <input id="name" name="name" type="text" class="form-control"
            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
          @if ($errors->has('name'))
            <div class="text-danger mt-1">
              {{ $errors->first('name') }}
            </div>
          @endif
        </div>

        <!-- Username Field -->
        <div class="mb-3">
          <label for="username" class="form-label">{{ __('Username') }}</label>
          <input id="username" name="username" type="text" class="form-control"
            value="{{ old('username', $user->username) }}" required autocomplete="username">
          @if ($errors->has('username'))
            <div class="text-danger mt-1">
              {{ $errors->first('username') }}
            </div>
          @endif
        </div>

        <!-- Email Field -->
        <div class="mb-3">
          <label for="email" class="form-label">{{ __('Email') }}</label>
          <input id="email" name="email" type="email" class="form-control"
            value="{{ old('email', $user->email) }}" required autocomplete="email">
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

        <!-- Phone Field -->
        <div class="mb-3">
          <label for="phone" class="form-label">{{ __('Phone') }}</label>
          <input id="phone" name="phone" type="tel" class="form-control"
            value="{{ old('phone', $user->phone) }}" pattern="^62[1-9][0-9]*$" required autocomplete="phone">
          @if ($errors->has('phone'))
            <div class="text-danger mt-1">
              {{ $errors->first('phone') }}
            </div>
          @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3">
          <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

          @if (session('status') === 'profile-updated')
            <p class="text-success m-0" id="saved-message">
              {{ __('Profile updated successfully.') }}
            </p>
          @endif
        </div>
      </div>
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
