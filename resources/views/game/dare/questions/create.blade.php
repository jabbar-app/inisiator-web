@extends('layouts.game')

@section('content')
  <form action="{{ route('dare-questions.store') }}" method="POST">
    @csrf

    <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">
    <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">

    <div class="flex justify-between items-center gap-5">
      <div class="flex justify-center items-center gap-1 bg-white py-2 px-4 rounded-xl dark:bg-color9">
        <i class="ph ph-user"></i>
        <p class="text-xs font-semibold text-nowrap">{{ $currentQuestionIndex }} of 20</p>
      </div>
      <div class="w-full bg-p1 bg-opacity-10 h-2 rounded-full relative">
        <span class="absolute top-0 left-0 bg-p1 h-2 rounded-full"
          style="width: {{ ($currentQuestionIndex / 20) * 100 }}%"></span>
      </div>
      <div class="flex justify-center items-center gap-1 bg-p1 text-white py-2 px-4 rounded-xl ">
        <i class="ph ph-puzzle-piece"></i>
        <p class="text-xs font-semibold text-nowrap">{{ $currentQuestionIndex }} of 20</p>
      </div>
    </div>

    <div
      class="bg-white dark:bg-color11 p-4 rounded-xl mt-20 text-center flex flex-col justify-center items-center relative">
      <p class="text-2xl font-semibold pt-8">Question {{ $currentQuestionIndex }}</p>
      <p class="text-lg font-semibold px-4 pt-3 border-t border-dashed border-color21 dark:border-color24">
        <span class="editable" id="question-text">{{ $templateQuestion['question'] ?? 'Enter your question here' }}</span>
        <input type="hidden" name="question" id="question-hidden" value="{{ $templateQuestion['question'] ?? '' }}">
        <i class="ph ph-pencil-line edit-icon" data-edit="question"></i>
      </p>
    </div>

    <div class="flex flex-col gap-4 pt-8">
      @foreach ($templateQuestion['options'] ?? [] as $index => $option)
        <div class="flex justify-between items-center bg-white dark:bg-color9 py-4 px-5 rounded-2xl option"
          data-correct="{{ $option['is_correct'] ?? false }}">
          <p class="text-sm font-semibold">
            <span class="editable" id="option-text-{{ $index }}">{{ $option['text'] }}</span>
            <input type="hidden" name="options[]" id="option-hidden-{{ $index }}" value="{{ $option['text'] }}">
            <i class="ph ph-pencil-line edit-icon" data-edit="option-{{ $index }}"></i>
          </p>
          <div class="size-8 rounded-full text-white border border-color21 flex justify-center items-center icon">
            <input type="radio" name="correct_answer" value="{{ $option['text'] }}" class="hidden correct-radio">
            <i class="ph ph-check"></i>
          </div>
        </div>
      @endforeach
    </div>

    <div class="pt-12">
      <button type="submit"
        class="py-3 text-center bg-p2 dark:bg-p1 rounded-full text-sm font-semibold text-white block w-full disabled:opacity-50 disabled:cursor-not-allowed"
        id="next-button" {{ $currentQuestionIndex >= 20 ? 'name=finish' : 'name=next' }} disabled>
        {{ $currentQuestionIndex < 20 ? 'Next' : 'Finish' }}
      </button>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const options = document.querySelectorAll('.option');
      const nextButton = document.getElementById('next-button');

      options.forEach(option => {
        option.addEventListener('click', () => {
          options.forEach(opt => opt.classList.remove('correct'));
          option.classList.add('correct');
          const radio = option.querySelector('.correct-radio');
          radio.checked = true;
          nextButton.removeAttribute('disabled');
        });
      });

      const editIcons = document.querySelectorAll('.edit-icon');
      editIcons.forEach(icon => {
        icon.addEventListener('click', () => {
          const editType = icon.dataset.edit;
          let currentText;

          if (editType === 'question') {
            currentText = document.getElementById('question-text').textContent.trim();
          } else if (editType.startsWith('option-')) {
            const index = editType.split('-')[1];
            currentText = document.getElementById(`option-text-${index}`).textContent.trim();
          }

          const newText = prompt('Edit text:', currentText);
          if (newText) {
            if (editType === 'question') {
              document.getElementById('question-text').textContent = newText;
              document.getElementById('question-hidden').value = newText;
            } else if (editType.startsWith('option-')) {
              const index = editType.split('-')[1];
              document.getElementById(`option-text-${index}`).textContent = newText;
              document.getElementById(`option-hidden-${index}`).value = newText;
            }
          }
        });
      });
    });
  </script>
@endpush
