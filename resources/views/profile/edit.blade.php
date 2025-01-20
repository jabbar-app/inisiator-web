@extends('layouts.dashboard')

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Update Profile Information -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <!-- Update Password -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <!-- Delete User -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
@endsection


@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const avatarInput = document.getElementById('avatar');
      const previewAvatar = document.getElementById('preview-avatar');
      const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
      const imageToCrop = document.getElementById('image-to-crop');
      const croppedAvatarInput = document.getElementById('cropped-avatar');

      let cropper;

      // Handle file input change
      avatarInput.addEventListener('change', (event) => {
        const file = event.target.files[0];

        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            imageToCrop.src = e.target.result; // Set image to crop modal
            cropModal.show(); // Show modal
          };
          reader.readAsDataURL(file);
        }
      });

      // Initialize cropper when modal is shown
      document.getElementById('cropModal').addEventListener('shown.bs.modal', () => {
        cropper = new Cropper(imageToCrop, {
          aspectRatio: 1, // Square aspect ratio for avatar
          viewMode: 2, // Restrict cropper to image boundary
          scalable: true, // Allow scaling
          zoomable: true, // Allow zooming
        });
      });

      // Destroy cropper when modal is hidden
      document.getElementById('cropModal').addEventListener('hidden.bs.modal', () => {
        if (cropper) {
          cropper.destroy();
          cropper = null;
        }
      });

      // Save cropped image
      document.getElementById('crop-save').addEventListener('click', () => {
        if (cropper) {
          const canvas = cropper.getCroppedCanvas({
            width: 300, // Output image width
            height: 300, // Output image height
          });

          // Convert to WebP if supported, otherwise fallback to PNG
          const isWebpSupported = canvas.toDataURL('image/webp').indexOf('data:image/webp') === 0;
          const croppedDataUrl = isWebpSupported ?
            canvas.toDataURL('image/webp', 0.75) // WebP format with 75% quality
            :
            canvas.toDataURL('image/png'); // Fallback to PNG

          // Show cropped image in preview
          previewAvatar.src = croppedDataUrl;

          // Save cropped image data to hidden input
          croppedAvatarInput.value = croppedDataUrl;

          cropModal.hide(); // Close modal
        }
      });
    });
  </script>
@endpush

@push('scripts')
  <script>
    function copy() {
      const referralCodeInput = document.getElementById('referral_code');
      const referralCode = referralCodeInput.value;

      if (navigator.clipboard && navigator.clipboard.writeText) {
        // Browser supports navigator.clipboard
        navigator.clipboard.writeText(referralCode).then(function() {
          Swal.fire({
            icon: 'success',
            title: 'Kode Referral Disalin',
            text: 'Kode referral berhasil disalin ke clipboard.',
            timer: 2000,
            showConfirmButton: false
          });
        }).catch(function() {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Menyalin',
            text: 'Terjadi kesalahan saat menyalin kode. Coba lagi.',
          });
        });
      } else {
        // Fallback for older browsers
        referralCodeInput.select();
        referralCodeInput.setSelectionRange(0, 99999); // For mobile devices

        try {
          const successful = document.execCommand('copy');
          if (successful) {
            Swal.fire({
              icon: 'success',
              title: 'Kode Referral Disalin',
              text: 'Kode referral berhasil disalin ke clipboard.',
              timer: 2000,
              showConfirmButton: false
            });
          } else {
            throw new Error('Copy failed');
          }
        } catch (err) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Menyalin',
            text: 'Browser Anda tidak mendukung salin otomatis.',
          });
        }
      }
    }
  </script>
@endpush
