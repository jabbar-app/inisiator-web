@extends('layouts.dashboard')

@section('content')
  <div class="container mt-4">
    <h1>Create New Quiz</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('dare-quizzes.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="slug" class="form-label">Quiz Slug (Optional)</label>
        <input type="text" id="slug" name="slug" class="form-control" placeholder="Enter quiz slug"
          value="{{ old('slug') }}">
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" id="location" name="location" class="form-control" value="Auto-detected" disabled>
        <small class="form-text text-muted">Location will be automatically detected based on your IP.</small>
      </div>

      <div class="mb-3">
        <label for="device" class="form-label">Device Information</label>
        <input type="text" id="device" name="device" class="form-control" value="Auto-detected" disabled>
        <small class="form-text text-muted">Device information will be automatically detected.</small>
      </div>

      <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
  </div>
@endsection
