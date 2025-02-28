@extends('templates.main')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0/dist/css/tabler.min.css">
@endpush

@section('content')
  <div class="content-grid">
    {{-- <div class="section-banner">
      <img class="section-banner-icon" src="{{ asset('theme/img/quests-icon.webp') }}" alt="quests-icon">
      <p class="section-banner-title">Create Question</p>
      <p class="section-banner-text">Complete quests to gain experience and level up!</p>
    </div> --}}

    <div class="row">
      <div class="col-12">
        <form id="response-form" action="{{ route('dare-responses.store') }}" method="POST">
          @csrf
          <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
          <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">
          <input type="hidden" name="response" id="response-input">
          <input type="hidden" name="time" id="time-input">

          <div class="widget-box my-4">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
              <div class="w-100 bg-light rounded-pill" style="height: 8px;">
                <div class="bg-primary rounded-pill"
                  style="height: 8px; width: {{ ($currentQuestionIndex / $totalQuestions) * 100 }}%;">
                </div>
              </div>
              <h3 class="bg-primary text-white text-nowrap py-2 px-3 m-0 rounded-pill">
                {{ $currentQuestionIndex }} of {{ $totalQuestions }}
              </h3>
            </div>

            <div class="text-center d-flex flex-column justify-content-center align-items-center position-relative mb-4">
              <p class="fw-semibold mb-2">Question {{ $currentQuestionIndex }}</p>
              <h1 class="pt-3 border-top border-dashed">
                {{ $question->question }}
              </h1>
            </div>
          </div>

          <div class="d-flex flex-column gap-3">
            @foreach ($question->options as $index => $option)
              <div class="widget-box d-flex justify-content-between align-items-center p-3 rounded-3 option"
                data-correct="{{ $option === $question->correct_answer ? 'true' : 'false' }}">
                <label class="d-flex justify-content-between align-items-center w-full cursor-pointer">
                  <h2 class="mb-0 me-2">
                    {{ $option }}
                  </h2>

                  {{-- Correct Icon --}}
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-check d-none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                  </svg>

                  {{-- Incorrect Icon --}}
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-x d-none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                  </svg>

                  <input type="radio" name="response" value="{{ $option }}"
                    class="visually-hidden response-radio">
                </label>
              </div>
            @endforeach
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const options = document.querySelectorAll('.option');
      const form = document.getElementById('response-form');
      const responseInput = document.getElementById('response-input');
      const timeInput = document.getElementById('time-input'); // Get the time input field

      let duration = 1000; // Countdown duration in seconds
      let currentTime = duration;
      let timer;

      // Function to update the countdown display
      function updateCountdown() {
        const countdownElement = document.getElementById('countdown');
        if (countdownElement) {
          countdownElement.textContent = currentTime;
        }
      }

      // Start the countdown timer
      function startTimer() {
        timer = setInterval(() => {
          if (currentTime > 0) {
            currentTime--;
            updateCountdown();
          } else {
            clearInterval(timer);
            responseInput.value = "No Answer"; // Set empty response
            timeInput.value = 0; // Set time to 0 when time's up
            form.submit(); // Auto-submit the form
          }
        }, 1000);
      }

      // Initialize countdown
      updateCountdown();
      startTimer();

      // Handle option selection
      options.forEach(option => {
        option.addEventListener('click', () => {
          clearInterval(timer); // Stop countdown on selection
          const isCorrect = option.dataset.correct === 'true';

          // Reset all options
          options.forEach(opt => {
            opt.classList.remove('bg-success', 'bg-danger',
              'text-white'); // Reset background and text color
            opt.querySelector('h2').classList.remove('text-white'); // Reset text color for h2
            opt.querySelector('.icon-tabler-check').classList.add('d-none'); // Hide correct icon
            opt.querySelector('.icon-tabler-x').classList.add('d-none'); // Hide incorrect icon
          });

          // Add class based on correctness
          if (isCorrect) {
            option.classList.add('bg-success', 'text-white'); // Set background to green and text to white
            option.querySelector('h2').classList.add('text-white'); // Set h2 text to white
            option.querySelector('.icon-tabler-check').classList.remove('d-none'); // Show correct icon
          } else {
            option.classList.add('bg-danger', 'text-white'); // Set background to red and text to white
            option.querySelector('h2').classList.add('text-white'); // Set h2 text to white
            option.querySelector('.icon-tabler-x').classList.remove('d-none'); // Show incorrect icon
          }

          // Set response value and submit form
          const radio = option.querySelector('.response-radio');
          responseInput.value = radio.value;
          timeInput.value = duration - currentTime; // Set the time taken to answer
          setTimeout(() => {
            form.submit();
          }, 1000);
        });
      });
    });
  </script>
@endpush
