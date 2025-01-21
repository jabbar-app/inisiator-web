@extends('layouts.dashboard')

@section('content')
  <div class="card">
    <div class="card-body py-5">
      <center>
        <div class="d-none d-md-block">
          <img src="{{ asset('assets/img/under-construction.svg') }}" alt="Coming Soon" height="340">
        </div>
        <div class="d-md-none d-block">
          <img src="{{ asset('assets/img/under-construction.svg') }}" alt="Coming Soon" height="200">
        </div>
      </center>
      <div class="text-center">
        <h2 class="my-3 f-default">Segera Hadir!</h2>
        <div id="countdown">
          <h5 id="timer" class="fw-bold">launched in</h5>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Set target date
    const targetDate = new Date('2025-01-23T09:00:00+07:00').getTime();

    // Update the countdown every second
    const countdown = setInterval(() => {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance < 0) {
        clearInterval(countdown);
        document.getElementById('timer').innerHTML = "The event has started!";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById('timer').innerHTML = `
            ${days}d ${hours}h ${minutes}m ${seconds}s
        `;
    }, 1000);
  </script>
@endpush
