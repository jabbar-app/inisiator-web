@extends('templates.main')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0/dist/css/tabler.min.css">
@endpush

@php
  $title = $quiz->user->name . "'s Quiz";
@endphp

@section('content')
  <div class="content-grid">
    <div class="row">
      <div class="col-12">
        <div class="widget-box">
          <h1 class="text-center">Welcome to the {{ $quiz->user->name }}'s Quiz!</h1>
          <p class="text-center">Please enter your name to start the quiz.</p>
          <form action="{{ route('play.dare.storeName', $quiz->slug) }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="responder_name" class="form-label">Your Name</label>
              <input type="text" name="responder_name" id="responder_name" class="form-control" required>
            </div>
            <div class="text-center mt-4">
              <button type="submit" class="button primary">Start Quiz</button>
            </div>
          </form>
        </div>

        <div class="mt-4">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>
@endsection
