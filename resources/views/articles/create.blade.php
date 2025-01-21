@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center f-default">
      <div class="col-12">
        <div class="card shadow-sm p-4 border-0">
          <h2 class="mb-4 text-center f-mono">Buat Artikel Baru</h2>

          <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
            @csrf

            <div class="row">
              <div class="col-xl-8 col-sm-12">
                <!-- Input Judul -->
                <div class="mb-3">
                  <label for="title" class="form-label fw-semibold">Judul</label>
                  <input type="text" name="title" id="title" class="form-control"
                    placeholder="Tulis Judul Artikel" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                  <label for="content" class="form-label fw-semibold">Konten</label>
                  <div id="editor-container" class="border rounded p-2 bg-white" style="height: 400px;"></div>
                  <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                  <small class="text-muted">Kamu sudah menulis
                    <span id="content-word-count" style="color: inherit;">0</span>
                    dari minimal 300 kata yang direkomendasikan.
                  </small>
                </div>

                <div class="mb-3">
                  <label for="excerpt" class="form-label fw-semibold">Ringkasan</label>
                  <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Tulis ringkasan di sini."
                    required>{{ old('excerpt') }}</textarea>
                  <small class="text-muted">
                    Kamu sudah menulis <span id="excerpt-word-count" style="color: inherit;">0</span>
                    dari 30 kata maksimal untuk ringkasan.
                  </small>
                </div>
              </div>

              <div class="col-xl-4 col-sm-12">
                <!-- Input Featured Image -->
                <div class="mb-3">
                  <label class="form-label fw-semibold">Featured Image (Opsional)</label>
                  <div id="drop-zone" class="drop-zone text-center p-4 border rounded position-relative">
                    <p class="m-0 text-muted">Tarik & Lepas gambar di sini atau klik untuk memilih</p>
                  </div>
                  <input type="file" name="img_featured" id="img_featured" class="d-none" accept="image/*">
                  <input type="hidden" name="compressed_image" id="compressed_image">
                  <small class="text-muted d-block mt-2">Gambar akan otomatis dikompresi sebelum diunggah.</small>
                </div>

                <!-- Select Kategori -->
                <div class="mb-3">
                  <label for="category_id" class="form-label fw-semibold">Kategori</label>
                  <select name="category_id" id="category_id" class="form-select" required>
                    <option value="" selected disabled>- Pilih Kategori -</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <!-- Input Tags -->
                <div class="mb-3">
                  <label for="tags" class="form-label fw-semibold">Tags</label>
                  <input type="text" class="w-100" id="tags" name="tags" placeholder="Pilih Tag"
                    value="{{ old('tags') }}">
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/@yaireo/tagify/dist/tagify.css">
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
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/compressorjs/dist/compressor.min.js"></script>
  <script src="https://unpkg.com/@yaireo/tagify"></script>
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

      quill.on('text-change', function() {
        document.getElementById('content').value = quill.root.innerHTML;
      });

      const dropZone = document.getElementById('drop-zone');
      const fileInput = document.getElementById('img_featured');
      const compressedInput = document.getElementById('compressed_image');

      dropZone.addEventListener('click', () => {
        fileInput.click();
      });

      dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
      });

      dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
      });

      dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
          compressAndPreviewImage(files[0]);
        }
      });

      fileInput.addEventListener('change', (e) => {
        if (fileInput.files.length > 0) {
          compressAndPreviewImage(fileInput.files[0]);
        }
      });

      function compressAndPreviewImage(file) {
        new Compressor(file, {
          quality: 1,
          mimeType: 'image/webp',
          maxWidth: 1024,
          success(result) {
            const reader = new FileReader();
            reader.readAsDataURL(result);
            reader.onload = () => {
              compressedInput.value = reader.result; // Set Base64 data
              dropZone.innerHTML = `<p class="m-0 text-success">${file.name} (terkompresi)</p>`;
            };
          },
          error(err) {
            console.error(err.message);
          },
        });
      }
    });
  </script>
@endpush
