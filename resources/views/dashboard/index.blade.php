@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <!-- View sales -->
    <div class="col-xl-4 mb-4 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
              <div class="card-title mb-auto">
                <h5 class="mb-1 text-nowrap">{{ now()->locale('id')->translatedFormat('F Y') }}</h5>
                <small>Estimasi Penghasilan:</small>
              </div>
              <div class="chart-statistics mt-2">
                <h3 class="card-title mb-1">Rp{{ number_format($userEarning, 0, ',', '.') }},-</h3>
                @if ($percentageChange > 0)
                  <small class="text-success text-nowrap fw-medium">
                    <i class="ti ti-chevron-up me-1"></i>
                    {{ number_format($percentageChange, 1, ',', '.') }}% <span class="text-black">bulan lalu</span>
                  </small>
                @elseif ($percentageChange < 0)
                  <small class="text-danger text-nowrap fw-medium">
                    <i class="ti ti-chevron-down me-1"></i>
                    {{ number_format(abs($percentageChange), 1, ',', '.') }}% <span class="text-black">bulan lalu</span>
                  </small>
                @else
                  <small class="text-muted text-nowrap fw-medium">
                    <i class="ti ti-minus me-1"></i>
                    0.0% <span class="text-black">bulan lalu</span>
                  </small>
                @endif
              </div>
            </div>

            <a href="{{ route('earnings.index') }}" class="btn btn-outline-primary my-auto"><i
                class="ti ti-transition-bottom"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- View sales -->

    <!-- Statistics -->
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">Statistik</h5>
            <small class="text-muted">Di-update hari ini</small>
          </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                  <i class="ti ti-chart-pie-2 ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">0</h5>
                  <small>Misi selesai</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-info me-3 p-2">
                  <i class="ti ti-users ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{ number_format(Auth::user()->xp) }}</h5>
                  <small>XP</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-warning me-3 p-2">
                  <i class="ti ti-notebook ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{ number_format(Auth::user()->articles->count()) }}</h5>
                  <small>Total Artikel</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-warning me-3 p-2">
                  <i class="ti ti-coins ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{ number_format($totalViews) }}</h5>
                  <small>Total Views</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics -->
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-datatable table-responsive">
          <table id="earningsTable" class="table table-striped">
            <thead>
              <tr>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($earnings as $earning)
                @php
                  // Pastikan 'details' adalah string sebelum menggunakan json_decode
                  $details = is_string($earning->details) ? json_decode($earning->details, true) : $earning->details;
                @endphp
                <tr>
                  <td>
                    @if ($details)
                      <ul class="list-unstyled mb-0">
                        @foreach ($details as $detail)
                          <li>
                            <strong>Periode:</strong> {{ $detail['period'] ?? '-' }} <br>
                            <strong>Views:</strong> {{ $detail['views'] ?? 0 }} <br>
                            <strong>Jumlah:</strong> Rp{{ number_format($detail['amount'] ?? 0, 2, ',', '.') }} <br>
                            <strong>Rank Rate:</strong> {{ $detail['rank_rate'] ?? '-' }}
                          </li>
                          @if (!$loop->last)
                            <hr>
                          @endif
                        @endforeach
                      </ul>
                    @else
                      Tidak ada detail
                    @endif
                  </td>
                  <td>{{ $earning->created_at->format('d M Y, H:i') }}</td>
                  <td>Rp{{ number_format($earning->total_amount, 2, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#earningsTable').DataTable();
    });
  </script>
@endpush
