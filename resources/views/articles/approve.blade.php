@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
          <div class="card-title mb-0">
            <h5 class="mb-0">Article Overview</h5>
            <small class="text-muted">Title: {{ $article->title }}</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
              <a class="dropdown-item" href="javascript:void(0);">View More</a>
              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <h2>{{ $article->title }}</h2>
          {!! $article->content !!}

          <form action="{{ route('articles.approve', $article) }}" method="POST">
            @csrf
            <button type="submit">Approve</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
