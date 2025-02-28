@extends('templates.main')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0/dist/css/tabler.min.css">
  <style>
    .edit-icon {
      transition: transform 0.2s ease, color 0.2s ease;
    }

    .edit-icon:hover {
      transform: scale(1.1);
      color: #00c7d9;
      cursor: pointer;
    }
  </style>
@endpush

@section('content')
  <div class="content-grid">
    <div class="section-banner">
      <img class="section-banner-icon" src="{{ asset('theme/img/quests-icon.webp') }}" alt="quests-icon">

      <p class="section-banner-title">Create Question</p>

      <p class="section-banner-text">Complete quests to gain experience and level up!</p>
    </div>

    <div class="row">
      <div class="col-12">

        <form action="{{ route('questions.store') }}" method="POST">
          @csrf

          <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">
          <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">

          <div class="widget-box my-4">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
              <div class="w-100 bg-light rounded-pill" style="height: 8px;">
                <div class="bg-primary rounded-pill"
                  style="height: 8px; width: {{ ($currentQuestionIndex / 20) * 100 }}%;">
                </div>
              </div>
              <h3 class="bg-primary text-white text-nowrap py-2 px-3 m-0 rounded-pill">
                {{ $currentQuestionIndex }} of 20
              </h3>
            </div>
            <div class="text-center d-flex flex-column justify-content-center align-items-center position-relative mb-4">
              <p class="fw-semibold mb-2">Question {{ $currentQuestionIndex }}</p>
              <h1 class="pt-3 border-top border-dashed">
                <span class="editable"
                  id="question-text">{{ $templateQuestion['question'] ?? 'Enter your question here' }}</span>
                <input type="hidden" name="question" id="question-hidden"
                  value="{{ $templateQuestion['question'] ?? '' }}">
                <div class="cursor-pointer edit-icon" data-edit="question">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-question">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 20l6 -6l3 -3l1.5 -1.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z" />
                    <path d="M13.5 6.5l4 4" />
                    <path d="M19 22v.01" />
                    <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                  </svg>
                </div>
              </h1>

              <button id="change-question-button" class="button primary w-25">Change Question</button>
            </div>
          </div>

          <div class="d-flex flex-column gap-3">
            @foreach ($templateQuestion['options'] ?? [] as $index => $option)
              <div class="widget-box d-flex justify-content-between align-items-center p-3 rounded-3 option"
                data-correct="{{ $option['is_correct'] ?? false }}">
                <div class="d-flex">
                  <h2 class="mb-0 me-2">
                    <span class="editable" id="option-text-{{ $index }}">{{ $option['text'] }}</span>
                    <input type="hidden" name="options[]" id="option-hidden-{{ $index }}"
                      value="{{ $option['text'] }}">
                  </h2>

                  <div class="cursor-pointer mt-1 edit-icon" data-edit="option-{{ $index }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-question">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M8 20l6 -6l3 -3l1.5 -1.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z" />
                      <path d="M13.5 6.5l4 4" />
                      <path d="M19 22v.01" />
                      <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                    </svg>
                  </div>
                </div>
                <div
                  class="rounded-circle text-white border border-2 border-white d-flex justify-content-center align-items-center"
                  style="width: 32px; height: 32px;">
                  <input type="radio" name="correct_answer" value="{{ $option['text'] }}"
                    class="visually-hidden correct-radio">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                  </svg>
                </div>
              </div>
            @endforeach
          </div>

          <div class="mt-5">
            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-semibold" id="next-button"
              {{ $currentQuestionIndex >= 20 ? 'name=finish' : 'name=next' }} disabled>
              <h2 class="m-0 p-0">{{ $currentQuestionIndex < 20 ? 'Next' : 'Finish' }}</h2>
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-12">
        @include('components.adsense-responsive')
      </div>
    </div>
  </div>

  <!-- Modal untuk Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label">Pastikan tetap ada kata 'kamu' di dalam pertanyaan yang di-edit.</label>
          <textarea id="editTextarea" class="form-control" rows="4"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="button white" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="button primary" id="saveChanges">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0/dist/js/tabler.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const changeQuestionButton = document.getElementById('change-question-button');
      const questionTextElement = document.getElementById('question-text');
      const questionHiddenElement = document.getElementById('question-hidden');
      const optionsContainer = document.querySelector('.d-flex.flex-column.gap-3');

      if (changeQuestionButton) {
        changeQuestionButton.addEventListener('click', function(event) {
          event.preventDefault();

          // Kirim permintaan AJAX untuk mendapatkan pertanyaan baru
          fetch(
              `/play/dare/questions/change/{{ $quiz_id }}?currentQuestionIndex={{ $currentQuestionIndex }}`, {
                headers: {
                  'Accept': 'application/json',
                },
              })
            .then(response => response.json())
            .then(data => {
              if (data.error) {
                alert(data.error);
                return;
              }

              // Perbarui pertanyaan
              questionTextElement.textContent = data.question;
              questionHiddenElement.value = data.question;

              // Perbarui opsi jawaban
              optionsContainer.innerHTML = ''; // Kosongkan opsi sebelumnya
              data.options.forEach((option, index) => {
                const optionHtml = `
                        <div class="widget-box d-flex justify-content-between align-items-center p-3 rounded-3 option">
                            <div class="d-flex">
                                <h2 class="mb-0 me-2">
                                    <span class="editable" id="option-text-${index}">${option.text}</span>
                                    <input type="hidden" name="options[]" id="option-hidden-${index}" value="${option.text}">
                                </h2>
                                <div class="cursor-pointer mt-1 edit-icon" data-edit="option-${index}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-question">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 20l6 -6l3 -3l1.5 -1.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z" />
                                        <path d="M13.5 6.5l4 4" />
                                        <path d="M19 22v.01" />
                                        <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                                    </svg>
                                </div>
                            </div>
                            <div class="rounded-circle text-white border border-2 border-white d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;">
                                <input type="radio" name="correct_answer" value="${option.text}" class="visually-hidden correct-radio">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </div>
                        </div>
                    `;
                optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
              });
            })
            .catch(error => {
              console.error('Error:', error);
            });
        });
      }
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const options = document.querySelectorAll('.option');
      const nextButton = document.getElementById('next-button');

      // Handle klik pada opsi jawaban
      options.forEach(option => {
        option.addEventListener('click', () => {
          options.forEach(opt => opt.classList.remove('bg-success', 'text-white'));
          option.classList.add('bg-success', 'text-white');
          const radio = option.querySelector('.correct-radio');
          radio.checked = true;
          nextButton.removeAttribute('disabled');
        });
      });

      // Handle klik pada ikon edit
      const editIcons = document.querySelectorAll('.edit-icon');
      const editModal = new bootstrap.Modal(document.getElementById('editModal'));
      let currentEditType = null;
      let currentEditIndex = null;

      editIcons.forEach(icon => {
        icon.addEventListener('click', () => {
          const editType = icon.dataset.edit;

          if (editType === 'question') {
            currentEditType = 'question';
            const currentText = document.getElementById('question-text').textContent.trim();
            document.getElementById('editTextarea').value = currentText;
          } else if (editType.startsWith('option-')) {
            currentEditType = 'option';
            currentEditIndex = editType.split('-')[1];
            const currentText = document.getElementById(`option-text-${currentEditIndex}`).textContent.trim();
            document.getElementById('editTextarea').value = currentText;
          }

          // Tampilkan modal
          editModal.show();
        });
      });

      // Handle simpan perubahan
      document.getElementById('saveChanges').addEventListener('click', () => {
        const newText = document.getElementById('editTextarea').value.trim();

        if (newText) {
          if (currentEditType === 'question') {
            document.getElementById('question-text').textContent = newText;
            document.getElementById('question-hidden').value = newText;
          } else if (currentEditType === 'option') {
            const optionTextElement = document.getElementById(`option-text-${currentEditIndex}`);
            const optionHiddenElement = document.getElementById(`option-hidden-${currentEditIndex}`);
            const correctAnswerRadio = document.querySelector('input[name="correct_answer"]:checked');

            // Simpan nilai lama dari opsi yang diubah
            const oldText = optionTextElement.textContent.trim();

            // Perbarui teks opsi
            optionTextElement.textContent = newText;
            optionHiddenElement.value = newText;

            // Perbarui nilai correct_answer jika opsi yang diubah adalah jawaban yang benar
            if (correctAnswerRadio && correctAnswerRadio.value === oldText) {
              correctAnswerRadio.value = newText;
              document.querySelector('input[name="correct_answer"]').value = newText;
            }
          }
        }

        // Tutup modal
        editModal.hide();
      });
    });
  </script>
@endpush
