@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="container">
      <article class="entry-wrapper mb-5">
        <h1 class="text-center mb-3 mt-5">404</h1>

        <!-- Search Form -->
        <div class="row">
          <div class="col-md-6 col-sm-12 mx-auto">
            <form action="{{ route('articles.search') }}" method="GET">
              <div class="d-flex align-items-center">
                <input type="text" class="form-control w-100" placeholder="Cari di sini..." value="{{ request('s') }}"
                  name="s" style="border-radius: 0px;" required>
                <button type="submit" class="btn btn-primary" style="border-radius: 0px; height: 50px;">Temukan</button>
              </div>
            </form>
          </div>
        </div>

        <p class="text-center my-5 h-100">
          The link you clicked may be broken or the page may have been removed.<br>
          Visit the <a href="{{ route('pages.home') }}" class="fw-bold">Homepage</a> or <a href="{{ route('pages.contact') }}" class="fw-bold">Contact
            us</a>
          about the problem.
        </p>
      </article>
    </div>
    <div style="height: 140px;"></div>
  </main>
@endsection
