@extends('layouts.dashboard')

@section('content')
  <div class="container mt-4">
    <h1>Edit Template</h1>

    <form action="{{ route('dare-templates.update', $dareTemplate) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" id="question" name="question" class="form-control" value="{{ $dareTemplate->question }}"
          required>
      </div>

      <div id="options-container" class="mb-3">
        <label class="form-label">Options</label>
        @php
          $options = json_decode($dareTemplate->options, true);
        @endphp

        @foreach ($options as $key => $option)
          <div class="option-group mb-2">
            <div class="input-group">
              <input type="text" name="options[{{ $key }}][text]" class="form-control"
                value="{{ $option['text'] }}" placeholder="Option {{ $key + 1 }}" required>
              <select name="options[{{ $key }}][is_image]" class="form-select ms-2 toggle-image">
                <option value="false" {{ !$option['is_image'] ? 'selected' : '' }}>No Image</option>
                <option value="true" {{ $option['is_image'] ? 'selected' : '' }}>Add Image</option>
              </select>
            </div>
            <div class="image-upload mt-2" style="{{ $option['is_image'] ? '' : 'display: none;' }}">
              @if ($option['is_image'] && isset($option['image_url']))
                <p class="mb-1">Current Image:</p>
                <img src="{{ asset($option['image_url']) }}" alt="Option Image"
                  style="max-width: 100px; max-height: 100px;" class="mb-2">
              @endif
              <input type="file" class="form-control image-input" name="options[{{ $key }}][image]"
                accept="image/*">
              <input type="hidden" name="options[{{ $key }}][compressed_image]" class="compressed-image">
              <p class="compressed-status text-muted mt-1"></p>
            </div>
          </div>
        @endforeach
      </div>
      <button type="button" id="add-option" class="btn btn-secondary mb-3">Add Option</button>

      <div class="mb-3">
        <label for="correct_answer" class="form-label">Correct Answer (Optional)</label>
        <input type="text" id="correct_answer" name="correct_answer" class="form-control"
          value="{{ $dareTemplate->correct_answer }}">
      </div>

      <button type="submit" class="btn btn-primary">Update Template</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/compressorjs/dist/compressor.min.js"></script>
  <script>
    const attachEvents = () => {
      document.querySelectorAll('.toggle-image').forEach(select => {
        select.removeEventListener('change', toggleImageVisibility);
        select.addEventListener('change', toggleImageVisibility);
      });

      document.querySelectorAll('.image-input').forEach(input => {
        input.removeEventListener('change', handleImageCompression);
        input.addEventListener('change', handleImageCompression);
      });
    };

    const toggleImageVisibility = (event) => {
      const imageUpload = event.target.closest('.option-group').querySelector('.image-upload');
      imageUpload.style.display = event.target.value === 'true' ? 'block' : 'none';
    };

    const handleImageCompression = (event) => {
      const file = event.target.files[0];
      const optionGroup = event.target.closest('.option-group');
      const compressedInput = optionGroup.querySelector('.compressed-image');
      const statusText = optionGroup.querySelector('.compressed-status');

      if (file) {
        new Compressor(file, {
          quality: 0.8,
          maxWidth: 1024,
          success(result) {
            const reader = new FileReader();
            reader.onload = () => {
              compressedInput.value = reader.result; // Base64 hasil kompresi
              statusText.textContent = `${file.name} (Compressed)`;
              statusText.classList.remove('text-danger');
              statusText.classList.add('text-success');
            };
            reader.readAsDataURL(result);
          },
          error(err) {
            console.error('Compression Error:', err.message);
            statusText.textContent = 'Failed to compress image.';
            statusText.classList.remove('text-success');
            statusText.classList.add('text-danger');
          }
        });
      }
    };

    document.getElementById('add-option').addEventListener('click', function() {
      const container = document.getElementById('options-container');
      const optionCount = container.children.length;

      const newOption = `
        <div class="option-group mb-2">
          <div class="input-group">
            <input type="text" name="options[${optionCount}][text]" class="form-control" placeholder="Option ${optionCount + 1}" required>
            <select name="options[${optionCount}][is_image]" class="form-select ms-2 toggle-image">
              <option value="false" selected>No Image</option>
              <option value="true">Add Image</option>
            </select>
          </div>
          <div class="image-upload mt-2" style="display: none;">
            <input type="file" class="form-control image-input" name="options[${optionCount}][image]" accept="image/*">
            <input type="hidden" name="options[${optionCount}][compressed_image]" class="compressed-image">
            <p class="compressed-status text-muted mt-1"></p>
          </div>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', newOption);
      attachEvents();
    });

    attachEvents();
  </script>
@endsection
