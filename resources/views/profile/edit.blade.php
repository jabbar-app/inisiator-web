@extends('templates.main')

@push('styles')
  <style>
    /* .upload-box {
          cursor: pointer;
          text-align: center;
          padding: 20px;
          border: 2px dashed #ccc;
          border-radius: 10px;
          transition: border-color 0.3s ease;
        }

        .upload-box:hover {
          border-color: #007bff;
        }

        .upload-box-icon {
          width: 50px;
          height: 50px;
          margin-bottom: 10px;
        }

        .upload-box-title {
          font-size: 18px;
          font-weight: bold;
          margin-bottom: 5px;
        }

        .upload-box-text {
          font-size: 14px;
          color: #666;
        } */
  </style>
@endpush

@section('content')
  <div class="content-grid">
    <div class="section-banner">
      <img class="section-banner-icon" src="{{ asset('theme/img/accounthub-icon.webp') }}" alt="accounthub-icon">
      <p class="section-banner-title">Account Hub</p>
      <p class="section-banner-text">Profile info, messages, settings and much more!</p>
    </div>

    <div class="grid grid-3-9 medium-space">
      <!-- Sidebar -->
      <div class="account-hub-sidebar">
        <div class="sidebar-box no-padding">
          <div class="sidebar-menu">
            <div class="sidebar-menu-item">
              <div class="sidebar-menu-header accordion-trigger-linked">
                <svg class="sidebar-menu-header-icon icon-profile">
                  <use xlink:href="#svg-profile"></use>
                </svg>
                <div class="sidebar-menu-header-control-icon">
                  <svg class="sidebar-menu-header-control-icon-open icon-minus-small">
                    <use xlink:href="#svg-minus-small"></use>
                  </svg>
                  <svg class="sidebar-menu-header-control-icon-closed icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                </div>
                <p class="sidebar-menu-header-title">My Profile</p>
                <p class="sidebar-menu-header-text">Change your avatar &amp; cover, accept friends, read messages and
                  more!</p>
              </div>
              <div class="sidebar-menu-body accordion-content-linked accordion-open">
                <a class="sidebar-menu-link active" href="hub-profile-info.html">Profile Info</a>
                <a class="sidebar-menu-link" href="hub-profile-social.html">Social &amp; Stream</a>
                <a class="sidebar-menu-link" href="hub-profile-notifications.html">Notifications</a>
                <a class="sidebar-menu-link" href="hub-profile-messages.html">Messages</a>
                <a class="sidebar-menu-link" href="hub-profile-requests.html">Friend Requests</a>
              </div>
            </div>

            <div class="sidebar-menu-item">
              <div class="sidebar-menu-header accordion-trigger-linked">
                <svg class="sidebar-menu-header-icon icon-settings">
                  <use xlink:href="#svg-settings"></use>
                </svg>
                <div class="sidebar-menu-header-control-icon">
                  <svg class="sidebar-menu-header-control-icon-open icon-minus-small">
                    <use xlink:href="#svg-minus-small"></use>
                  </svg>
                  <svg class="sidebar-menu-header-control-icon-closed icon-plus-small">
                    <use xlink:href="#svg-plus-small"></use>
                  </svg>
                </div>
                <p class="sidebar-menu-header-title">Account</p>
                <p class="sidebar-menu-header-text">Change settings, configure notifications, and review your privacy</p>
              </div>
              <div class="sidebar-menu-body accordion-content-linked">
                <a class="sidebar-menu-link" href="hub-account-info.html">Account Info</a>
                <a class="sidebar-menu-link" href="hub-account-password.html">Change Password</a>
                <a class="sidebar-menu-link" href="hub-account-settings.html">General Settings</a>
              </div>
            </div>
          </div>
          <div class="sidebar-box-footer">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="button tertiary" href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="ti ti-logout me-2 ti-sm"></i>
                Logout
              </a>
            </form>
            <a href="{{ route('dashboard') }}" class="button white small-space">Dashboard</a>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="account-hub-content">
        <div class="section-header">
          <div class="section-header-info">
            <p class="section-pretitle">My Profile</p>
            <h2 class="section-title">Profile Info</h2>
          </div>
        </div>

        <div class="grid-column">
          <div class="row">
            <!-- Avatar and Cover Section -->
            <div class="col-sm-12 col-md-4">
              <div class="user-preview small fixed-height">
                <figure class="user-preview-cover liquid">
                  <img src="{{ $user->cover ? asset($user->cover) : asset('assets/img/backgrounds/cover.webp') }}"
                    alt="cover-01">
                </figure>

                <div class="user-preview-info">
                  <div class="user-short-description small">
                    <div class="user-short-description-avatar user-avatar">
                      <div class="user-avatar-border">
                        <div class="hexagon-100-110"></div>
                      </div>

                      <div class="user-avatar-content">
                        <div class="hexagon-image-68-74" data-src="{{ $user->avatar ? asset($user->avatar) : asset('assets/img/profpic.svg') }}" style="width: 68px; height: 74px; position: relative;">
                          <canvas width="68" height="74" style="position: absolute; top: 0px; left: 0px;"></canvas>
                        </div>
                      </div>

                      <div class="user-avatar-progress">
                        <div class="hexagon-progress-84-92"></div>
                      </div>

                      <div class="user-avatar-progress-border">
                        <div class="hexagon-border-84-92"></div>
                      </div>

                      <div class="user-avatar-badge">
                        <div class="user-avatar-badge-border">
                          <div class="hexagon-28-32"></div>
                        </div>

                        <div class="user-avatar-badge-content">
                          <div class="hexagon-dark-22-24"></div>
                        </div>

                        <p class="user-avatar-badge-text">24</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Change Avatar Button -->
            <div class="col-sm-12 col-md-4">
              <div class="upload-box" onclick="document.getElementById('avatar').click()">
                <svg class="upload-box-icon icon-members">
                  <use xlink:href="#svg-members"></use>
                </svg>
                <p class="upload-box-title">Change Avatar</p>
                <p class="upload-box-text">110x110px size minimum</p>
              </div>
            </div>

            <!-- Change Cover Button -->
            <div class="col-sm-12 col-md-4">
              <div class="upload-box" onclick="document.getElementById('cover').click()">
                <svg class="upload-box-icon icon-photos">
                  <use xlink:href="#svg-photos"></use>
                </svg>
                <p class="upload-box-title">Change Cover</p>
                <p class="upload-box-text">1184x300px size minimum</p>
              </div>
            </div>
          </div>

          <!-- Update Profile Information Form -->
          <div class="widget-box">
            <p class="widget-box-title">Profile Information</p>
            <div class="widget-box-content">
              <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <!-- Hidden Inputs for Avatar and Cover -->
                <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none;">
                <input type="file" name="cover" id="cover" accept="image/*" style="display: none;">

                <!-- Name Field -->
                <div class="form-row split">
                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        required>
                    </div>
                  </div>

                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="username">Username</label>
                      <input type="text" id="username" name="username"
                        value="{{ old('username', $user->username) }}" required>
                    </div>
                  </div>
                </div>

                <!-- Bio Field -->
                <div class="form-row">
                  <div class="form-item">
                    <div class="form-input small full">
                      <label for="bio">Bio</label>
                      <textarea id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                  </div>
                </div>

                <!-- Email Field -->
                <div class="form-row split">
                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="email">Email</label>
                      <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}"
                        required>
                    </div>
                  </div>

                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="phone">Phone</label>
                      <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        required>
                    </div>
                  </div>
                </div>

                <!-- Save Button -->
                <div class="form-row">
                  <div class="form-item">
                    <button type="submit" class="button primary">Save Changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Update Password Form -->
          <div class="widget-box" id="change-password">
            <p class="widget-box-title">Update Password</p>
            <div class="widget-box-content">
              <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="form-row">
                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="current_password">Current Password</label>
                      <input type="password" id="current_password" name="current_password" required>
                    </div>
                  </div>
                </div>

                <!-- New Password -->
                <div class="form-row">
                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="password">New Password</label>
                      <input type="password" id="password" name="password" required>
                    </div>
                  </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-row">
                  <div class="form-item">
                    <div class="form-input small active">
                      <label for="password_confirmation">Confirm Password</label>
                      <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                  </div>
                </div>

                <!-- Save Button -->
                <div class="form-row">
                  <div class="form-item">
                    <button type="submit" class="button primary">Update Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Delete Account Section -->
          <div class="widget-box" id="delete-account">
            <p class="widget-box-title">Delete Account</p>
            <div class="widget-box-content">
              <p class="text-muted mb-4">Once your account is deleted, all of its resources and data will be permanently
                deleted. Before deleting your account, please download any data or information that you wish to retain.
              </p>
              <button type="button" class="button tertiary" data-bs-toggle="modal"
                data-bs-target="#confirmUserDeletionModal">
                Delete Account
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Account Modal -->
  <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="{{ route('profile.destroy') }}">
          @csrf
          @method('delete')

          <div class="modal-header">
            <h5 class="modal-title text-danger" id="confirmUserDeletionModalLabel">Are you sure you want to delete your
              account?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <p class="text-muted">Please enter your password to confirm you would like to permanently delete your
              account.</p>

            <!-- Password Input -->
            <div class="form-row">
              <div class="form-item">
                <div class="form-input small active">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="button secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="button danger">Delete Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const avatarInput = document.getElementById('avatar');
      const coverInput = document.getElementById('cover');
      const previewAvatar = document.querySelector('.user-avatar-content .hexagon-image-68-74');
      const previewCover = document.querySelector('.user-preview-cover img');

      // Handle avatar change
      avatarInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            previewAvatar.style.backgroundImage = `url(${e.target.result})`;
          };
          reader.readAsDataURL(file);
        }
      });

      // Handle cover change
      coverInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            previewCover.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    });
  </script>
@endpush
