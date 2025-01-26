@extends('layouts.dashboard')

@section('content')
  <div class="container mt-4">
    <h1>Create New Template</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('dare-templates.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" id="question" name="question" class="form-control" value="{{ old('question') }}" required>
      </div>

      <div id="options-container" class="mb-3">
        <label class="form-label">Options</label>
        @php
          $oldOptions = old('options', []);
        @endphp

        @foreach ($oldOptions as $key => $option)
          <div class="option-group mb-2">
            <div class="input-group">
              <input type="text" name="options[{{ $key }}][text]" class="form-control"
                placeholder="Option {{ $key + 1 }}" value="{{ $option['text'] ?? '' }}" required>
              <select name="options[{{ $key }}][is_image]" class="form-select ms-2 toggle-image">
                <option value="false"
                  {{ isset($option['is_image']) && $option['is_image'] == 'false' ? 'selected' : '' }}>No Image</option>
                <option value="true"
                  {{ isset($option['is_image']) && $option['is_image'] == 'true' ? 'selected' : '' }}>Add Image</option>
              </select>
            </div>
            <div class="image-upload mt-2"
              style="{{ isset($option['is_image']) && $option['is_image'] == 'true' ? '' : 'display: none;' }}">
              <input type="file" class="form-control image-input" accept="image/*">
              <input type="hidden" name="options[{{ $key }}][compressed_image]" class="compressed-image"
                value="{{ $option['compressed_image'] ?? '' }}">
              <p class="compressed-status text-muted mt-1">
                {{ isset($option['compressed_image']) ? 'Compressed image loaded' : '' }}</p>
            </div>
          </div>
        @endforeach

        @if (empty($oldOptions))
          <div class="option-group mb-2">
            <div class="input-group">
              <input type="text" name="options[0][text]" class="form-control" placeholder="Option 1" required>
              <select name="options[0][is_image]" class="form-select ms-2 toggle-image">
                <option value="false" selected>No Image</option>
                <option value="true">Add Image</option>
              </select>
            </div>
            <div class="image-upload mt-2" style="display: none;">
              <input type="file" class="form-control image-input" accept="image/*">
              <input type="hidden" name="options[0][compressed_image]" class="compressed-image">
              <p class="compressed-status text-muted mt-1"></p>
            </div>
          </div>
        @endif
      </div>
      <button type="button" id="add-option" class="btn btn-secondary mb-3">Add Option</button>

      {{-- <div class="mb-3">
        <label for="correct_answer" class="form-label">Correct Answer (Optional)</label>
        <input type="text" id="correct_answer" name="correct_answer" class="form-control"
          value="{{ old('correct_answer') }}">
      </div> --}}

      <button type="submit" class="btn btn-primary">Save Template</button>
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
          quality: 0.6,
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
                    <input type="file" class="form-control image-input" accept="image/*">
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
