@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <div class="container">
      {{-- <div class="section-banner mb-5" style="padding-top: 28px;">
        <img class="section-banner-icon" src="{{ asset('theme/img/events-icon.webp') }}" alt="events-icon">
        <p class="section-banner-title">Dashboard</p>
        <p class="section-banner-text">Welcome back, {{ Auth::user()->name }}!</p>
      </div> --}}

      <div class="row">
        <div class="col-sm-12 col-md-6 mb-3">
          <div class="widget-box">
            <h3 class="mb-2">Rp{{ number_format($userEarning, 0, ',', '.') }},-</h3>
            <span class="text-muted">Estimasi Penghasilan</span>
          </div>
        </div>
        <div class="col-sm-12 col-md-3 mb-3">
          <div class="widget-box">
            <h3 class="mb-2">{{ number_format($totalViews, 0, ',', '.') }}</h3>
            <span class="text-muted">Total Artikel Views</span>
          </div>
        </div>
        <div class="col-sm-12 col-md-3 mb-3">
          <div class="widget-box">
            <h3 class="mb-2">{{ Str::ucfirst(Auth::user()->rank ?? 'Beginner') }}</h3>
            <span class="text-muted">XP: {{ Auth::user()->xp ?? 0 }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('dashboard.stats')

  <div class="content-grid full p-0 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="widget-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3 class="m-0">My Articles</h3>
              <a href="{{ route('articles.create') }}" class="button secondary px-5 text-nowrap">Write New
                Post</a>
            </div>
            <div class="table-responsive" style="padding: 7px 0;">
              <table id="articlesTable" class="table">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($articles as $article)
                    <tr>
                      <td>{{ $article->title }}</td>
                      <td>{{ $article->category->title ?? '-' }}</td>
                      <td class="text-center">
                        <small class="rounded-pill bg-success text-white px-3 py-1">
                          {{ ucfirst($article->status) }}
                        </small>
                      </td>
                      <td class="text-center">{{ number_format($article->stats->sum('views'), 0, ',', '.') }}</td>
                      <td class="d-flex justify-content-center" style="gap: 8px;">
                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                          class="btn btn-info rounded-pill btn-sm px-4">
                          <small>Lihat</small>
                        </a>
                        <a href="{{ route('articles.edit', $article->slug) }}"
                          class="btn btn-warning rounded-pill btn-sm px-4">
                          <small>Edit</small>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="height: 200px;"></div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <style>
    div.dataTables_wrapper div.dataTables_length select {
      width: auto;
      display: inline-block;
      padding: 0 10px;
      margin: 0;
      text-align: center;
    }

    .dataTables_filter {
      float: right !important;
      text-align: right !important;
    }

    .dataTables_filter input {
      margin-left: 10px;
    }
  </style>
@endpush

@push('scripts')
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#articlesTable').DataTable({
        language: {
          //   url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json', // Bahasa Indonesia
        },
        order: [
          [3, 'desc']
        ], // Urutkan berdasarkan kolom ke-4 (Views) secara descending
        columnDefs: [{
            orderable: false,
            targets: [4]
          }, // Nonaktifkan pengurutan untuk kolom Aksi
        ],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>', // Atur posisi elemen
      });
    });
  </script>
@endpush
