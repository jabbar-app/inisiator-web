@extends('layouts.game')

@section('content')
  <form id="response-form" action="{{ route('dare-responses.store') }}" method="POST">
    @csrf
    <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">
    <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">
    <input type="hidden" name="response" id="response-input">

    <div class="flex justify-between items-center gap-5">
      <div class="flex justify-center items-center gap-1 bg-white py-2 px-4 rounded-xl dark:bg-color9">
        <i class="ph ph-user"></i>
        <p class="text-xs font-semibold text-nowrap">{{ $currentQuestionIndex }} of {{ $totalQuestions }}</p>
      </div>
      <div class="w-full bg-p1 bg-opacity-10 h-2 rounded-full relative">
        <span class="absolute top-0 left-0 bg-p1 h-2 rounded-full"
          style="width: {{ ($currentQuestionIndex / $totalQuestions) * 100 }}%"></span>
      </div>
      <div class="flex justify-center items-center gap-1 bg-p1 text-white py-2 px-4 rounded-xl">
        <i class="ph ph-puzzle-piece"></i>
        <p class="text-xs font-semibold text-nowrap">{{ $currentQuestionIndex }} of {{ $totalQuestions }}</p>
      </div>
    </div>


    <div
      class="bg-white dark:bg-color11 p-4 rounded-xl mt-20 text-center flex flex-col justify-center items-center relative">
      <div
        class="h-full w-full bg-white dark:bg-color9 rounded-full flex justify-center items-center text-lg font-bold p-1.5 relative progress">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
          <circle cx="16" cy="16" r="15.5" class="progress-bar__background" />
          <circle cx="16" cy="16" r="15.5" class="progress-bar__progress" />
          <p class="text-lg font-bold absolute top-[30px] left-[31px] countdown-text">10</p>
        </svg>
      </div>
      <p class="text-lg font-semibold px-4 pt-3 border-b border-dashed border-color21 dark:border-color24">
        "{{ $question->question }}"
      </p>
      <p class="pt-3">Question {{ $currentQuestionIndex }}</p>
    </div>

    <div class="flex flex-col gap-4 pt-8">
      @foreach ($question->options as $index => $option)
        <div class="flex justify-between items-center bg-white dark:bg-color9 py-4 px-5 rounded-2xl option"
          data-correct="{{ $option === $question->correct_answer ? 'true' : 'false' }}">
          <label class="flex justify-between items-center w-full cursor-pointer">
            <p class="text-sm font-semibold">
              {{ $option }}
            </p>
            <input type="radio" name="response" value="{{ $option }}" class="hidden response-radio">
            <div class="size-8 rounded-full text-white border border-color21 flex justify-center items-center icon">
              <i class="ph"></i>
            </div>
          </label>
        </div>
      @endforeach
    </div>

  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const options = document.querySelectorAll('.option');
      const form = document.getElementById('response-form');
      const responseInput = document.getElementById('response-input');
      const countdownElement = document.querySelector('.progress-bar__progress');
      const countdownText = document.querySelector('.countdown-text');

      let duration = 10; // Countdown duration in seconds
      let currentTime = duration;

      function updateProgress() {
        const percentage = (currentTime / duration) * 100;
        countdownElement.style.strokeDashoffset = 100 - percentage;
        countdownText.textContent = currentTime;
      }

      // Timer for countdown
      const timer = setInterval(() => {
        if (currentTime > 0) {
          currentTime--;
          updateProgress();
        } else {
          clearInterval(timer);
          countdownText.textContent = "Time's up!";
          responseInput.value = "No Answer"; // Set empty response
          form.submit(); // Auto-submit the form
        }
      }, 1000);

      updateProgress();

      // Handle option selection
      options.forEach(option => {
        option.addEventListener('click', () => {
          clearInterval(timer); // Stop countdown on selection
          const isCorrect = option.dataset.correct === 'true';

          // Reset all options
          options.forEach(opt => {
            opt.classList.remove('correct', 'wrong');
            opt.querySelector('.icon i').className = 'ph';
          });

          // Add class based on correctness
          if (isCorrect) {
            option.classList.add('correct');
            option.querySelector('.icon i').className = 'ph ph-check';
          } else {
            option.classList.add('wrong');
            option.querySelector('.icon i').className = 'ph ph-x';
          }

          // Set response value and submit form
          const radio = option.querySelector('.response-radio');
          responseInput.value = radio.value;
          setTimeout(() => {
            form.submit();
          }, 1000);
        });
      });
    });
  </script>

  <style>
    .option.correct {
      background-color: #4caf50;
      color: white;
      border-color: #4caf50;
    }

    .option.correct .icon {
      background-color: white;
      color: #4caf50;
    }

    .option.wrong {
      background-color: #f44336;
      color: white;
      border-color: #f44336;
    }

    .option.wrong .icon {
      background-color: white;
      color: #f44336;
    }

    .progress-bar__background {
      fill: none;
      stroke: rgba(236, 137, 68, 0.4);
      stroke-width: 2.8;
    }

    .progress-bar__progress {
      fill: none;
      stroke: #ff710f;
      stroke-dasharray: 100 100;
      stroke-dashoffset: 100;
      stroke-linecap: round;
      stroke-width: 2.8;
      transition: stroke-dashoffset 1s ease-in-out;
    }
  </style>
@endpush
