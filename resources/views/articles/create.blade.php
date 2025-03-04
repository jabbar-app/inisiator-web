@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="widget-box">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data"
              class="needs-validation">
              @csrf

              <div class="row">
                <div class="col-xl-8 col-sm-12">
                  <!-- Input Judul -->
                  <div class="mb-3">
                    <label for="title" class="form-label mb-2">Write title</label>
                    <input type="text" name="title" id="title"
                      class="form-control title-article box-input-article fw-bold text-black"
                      placeholder="Story Title Here" value="{{ old('title') }}" required>
                  </div>

                  <div class="mb-3">
                    <label for="content" class="form-label mb-2">Write story</label>
                    <div id="editor-container" class="border rounded p-2 bg-white" style="height: 400px;"></div>
                    <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                    <small class="text-muted">Kamu sudah menulis
                      <span id="content-word-count" style="color: inherit;">0</span>
                      dari minimal 300 kata yang direkomendasikan.
                    </small>
                  </div>

                  <div class="mb-3">
                    <label for="excerpt" class="form-label mb-2">Excerpt (Summary)</label>
                    <textarea name="excerpt" id="excerpt" class="form-control box-input-article" rows="3"
                      placeholder="..." required>{{ old('excerpt') }}</textarea>
                    <small class="text-muted">
                      Kamu sudah menulis <span id="excerpt-word-count" style="color: inherit;">0</span>
                      dari 30 kata maksimal untuk ringkasan.
                    </small>
                  </div>
                </div>

                <div class="col-xl-4 col-sm-12">
                  <!-- Input Featured Image -->
                  <div class="mb-3">
                    <label class="form-label mb-2">Featured Image (Opsional)</label>
                    <div id="drop-zone" class="drop-zone text-center p-4 border rounded position-relative">
                      <p class="m-0 text-muted">Tarik & Lepas gambar di sini atau klik untuk memilih</p>
                    </div>
                    <input type="file" name="img_featured" id="img_featured" class="d-none" accept="image/*">
                    <input type="hidden" name="compressed_image" id="compressed_image">
                    <small class="text-muted d-block mt-2">Gambar akan otomatis dikompresi sebelum diunggah.</small>
                  </div>

                  <!-- Select Segmen -->
                  <div class="mb-3">
                    <label for="category_id" class="form-label mb-2">Pick a category</label>
                    <select name="category_id" id="category_id" class="form-select select2" required>
                      <option value="" selected disabled>- Pilih Segmen -</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-content="{{ $category->content }}"
                          {{ old('category_id') == $category->id ? 'selected' : '' }}>
                          {{ $category->title }}
                        </option>
                      @endforeach
                    </select>
                    <div id="category-description" class="mt-2 p-3 bg-light rounded border" style="display: none;">
                      <p class="m-0 text-muted">Pilih Segmen di atas untuk membaca deskripsi.</p>
                    </div>
                  </div>

                  @push('scripts')
                    <script>
                      $(document).ready(function() {
                        // Initialize Select2
                        $('.select2').select2({
                          placeholder: "- Pilih Segmen -",
                          width: '100%'
                        });

                        // Display category description on change
                        $('#category_id').on('change', function() {
                          const selectedOption = $(this).find('option:selected');
                          const content = selectedOption.data('content');

                          if (content) {
                            $('#category-description').html(content).fadeIn();
                          } else {
                            $('#category-description').html(
                              '<p class="m-0 text-muted">Pilih Segmen di atas untuk melihat deskripsi.</p>').fadeIn();
                          }
                        });

                        // Trigger change event to show description if a category is preselected
                        $('#category_id').trigger('change');
                      });
                    </script>
                  @endpush


                  <!-- Input Tags -->
                  {{-- <div class="mb-3">
                    <label for="tags" class="form-label mb-2">Tags</label>
                    <input id="TagifyCustomInlineSuggestion" name="tags" class="form-control" placeholder="Pilih Tag"
                      value="" required />
                  </div> --}}

                  <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="height: 200px;"></div>
@endsection

@push('styles')
  <!-- External Styles -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <style>
    .drop-zone {
      cursor: pointer;
      transition: background-color 0.3s, border-color 0.3s;
    }

    .drop-zone.dragover {
      background-color: #e3f2fd;
      border-color: #2196f3;
    }

    .ql-editor {
      min-height: 200px;
    }

    .tags-inline .tagify__dropdown__item {
      display: inline-block;
      margin: 2px 4px;
      padding: 5px 8px;
      border-radius: 4px;
      background-color: #f4f4f4;
      cursor: pointer;
    }
  </style>
@endpush

@push('scripts')
  <!-- External Scripts -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/compressorjs/dist/compressor.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Initialize Quill Editor
      const quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
          toolbar: [
            [{
              header: [1, 2, 3, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
              list: 'ordered'
            }, {
              list: 'bullet'
            }],
            ['link'],
            ['clean']
          ]
        }
      });

      // Set existing content (if any)
      var existingContent = {!! json_encode(old('content', '')) !!};
      quill.root.innerHTML = existingContent;

      function updateWordCount(element, wordCountElementId, maxWords, isContent = true, yellowThreshold = 10) {
        const wordCountElement = document.getElementById(wordCountElementId);
        const words = element.value.trim().split(/\s+/).filter(word => word.length > 0).length;

        // Update only the word count number
        wordCountElement.textContent = words;

        // Apply color based on word count logic
        if (isContent) {
          // Content logic: red/yellow below 300, green above 300
          if (words < maxWords - yellowThreshold) {
            wordCountElement.style.color = 'red';
          } else if (words < maxWords) {
            wordCountElement.style.color = 'orange';
          } else {
            wordCountElement.style.color = 'green';
          }
        } else {
          // Excerpt logic: green below 30, red above 30
          if (words <= maxWords) {
            wordCountElement.style.color = 'green';
          } else {
            wordCountElement.style.color = 'red';
          }
        }
      }

      // Update Content Word Count
      quill.on('text-change', function() {
        const content = quill.root.innerText.trim();
        document.getElementById('content').value = quill.root.innerHTML;
        updateWordCount({
          value: content
        }, 'content-word-count', 300, true, 30);
      });

      // Update Excerpt Word Count
      document.getElementById('excerpt').addEventListener('input', function() {
        updateWordCount(this, 'excerpt-word-count', 30, false);
      });

      // Drop Zone and File Upload Logic
      const dropZone = document.getElementById('drop-zone');
      const fileInput = document.getElementById('img_featured');
      const compressedInput = document.getElementById('compressed_image');

      const addDropZoneListeners = () => {
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
          e.preventDefault();
          dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

        dropZone.addEventListener('drop', (e) => {
          e.preventDefault();
          dropZone.classList.remove('dragover');
          if (e.dataTransfer.files.length) handleImageCompression(e.dataTransfer.files[0]);
        });

        fileInput.addEventListener('change', () => {
          if (fileInput.files.length) handleImageCompression(fileInput.files[0]);
        });
      };

      const handleImageCompression = (file) => {
        new Compressor(file, {
          quality: 1,
          mimeType: file.type,
          maxWidth: 1024,
          success(result) {
            const reader = new FileReader();
            reader.onload = () => {
              compressedInput.value = reader.result;
              dropZone.innerHTML = `<p class="m-0 text-success">${file.name} (Compressed)</p>`;
            };
            reader.readAsDataURL(result);
          },
          error(err) {
            console.error('Compression Error:', err.message);
          }
        });
      };

      addDropZoneListeners();
    });
  </script>
@endpush
