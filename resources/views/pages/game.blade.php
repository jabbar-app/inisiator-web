@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="container">
      <div class="row mb-2">
        <div class="col-12">
          <div class="alert alert-info">
            Main game dapat hadiah!
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="card">
            <a href="#" class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                  <img src="{{ asset('assets/img/profpic.svg') }}" alt="" class="rounded" width="48">
                  <div>
                    <h5 class="mb-0">Halo</h5>
                    <p class="text-muted mb-0">2 hari lalu</p>
                  </div>
                </div>
                <div class="badge bg-label-primary">Full-time</div>
              </div>

              <div class="progress-bar"></div>

              {{-- <h4>{{ $game->title }}</h4>
              <p>{{ $game->description }}</p> --}}
              <button class="btn btn-primary">Play Here</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
