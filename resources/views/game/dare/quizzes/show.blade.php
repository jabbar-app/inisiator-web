@extends('layouts.dashboard')

@section('content')
  <div class="container mt-4">
    <div class="text-center">
      <h1 class="mb-4">{{ $dareQuiz->title ?? 'Quiz Title' }}</h1>
      <p class="text-muted">{{ $dareQuiz->description ?? 'No description available.' }}</p>

      <div class="mt-4">
        <p><strong>Number of Questions:</strong> {{ $dareQuiz->questions->count() }}</p>
        <p><strong>Created By:</strong> {{ $dareQuiz->user->name ?? 'Unknown' }}</p>
        <p><strong>Date Created:</strong> {{ $dareQuiz->created_at->format('d M Y') }}</p>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('dare-responses.create', ['quiz_id' => $dareQuiz->id]) }}" class="btn btn-primary btn-lg">
        <i class="ph ph-play-circle"></i> Play
      </a>
    </div>

    <!-- Leaderboard Section -->
    <div class="mt-5">
      <h2 class="text-center mb-4">Leaderboard</h2>

      @if ($leaderboard->isNotEmpty())
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Name</th>
              <th>Score</th>
              <th>Time (s)</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($leaderboard as $rank => $response)
              <tr>
                <td>{{ $rank + 1 }}</td>
                <td>{{ $response->responder_name }}</td>
                <td>{{ $response->score }}</td>
                <td>{{ $response->time }}</td>
                <td>{{ $response->location ?? 'Unknown' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p class="text-center text-muted">No participants yet. Be the first to play!</p>
      @endif
    </div>
  </div>
@endsection
