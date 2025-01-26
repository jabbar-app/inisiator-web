@extends('layouts.dashboard')

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="row align-items-center">
        <!-- Progress Bar -->
        <div class="col-lg-8 col-md-7 col-12">
          <div class="d-flex justify-content-between align-items-center">
            @php
              $rewards = [25, 50, 25, 50, 10, 15, 2500]; // Reward per hari
              $streak = Auth::user()->check_in_streak ?? 0; // Streak user saat ini
            @endphp

            @foreach ($rewards as $index => $reward)
              <div class="text-center" style="flex: 1;">
                <!-- Icon Check or Uncheck -->
                <div class="icon mb-2">
                  @if ($streak > $index)
                    <i class="ti ti-check text-success" style="font-size: 24px;"></i>
                  @else
                    <i class="ti ti-circle text-muted" style="font-size: 24px;"></i>
                  @endif
                </div>

                <!-- Day and Amount -->
                <p class="mb-0" style="font-size: 14px;">Hari {{ $index + 1 }}</p>
                <small>Rp{{ number_format($reward, 0, ',', '.') }}</small>
              </div>

              <!-- Separator Line -->
              @if ($index < count($rewards) - 1)
                <div class="progress-line"
                  style="width: 20px; height: 2px; background-color: {{ $streak > $index ? '#28a745' : '#dcdcdc' }};">
                </div>
              @endif
            @endforeach
          </div>
        </div>

        <!-- Check-In Button -->
        <div class="col-lg-4 col-md-5 col-12 text-end">
          <form action="{{ route('check-in') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
              Check-In Harian
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- View sales -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
              <div class="card-title mb-auto">
                <h5 class="mb-1 text-nowrap">{{ now()->locale('id')->translatedFormat('F Y') }}</h5>
                <small>Estimasi Penghasilan:</small>
              </div>
              <div class="chart-statistics mt-2">
                <h3 class="card-title mb-1">Rp{{ number_format($totalEarnings, 0, ',', '.') }},-</h3>
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
    <div class="col-md-8 mb-4">
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
                <th>Type</th>
                <th>Period</th>
                <th>Amount</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($earnings as $earning)
                @php
                  $details = is_string($earning->details) ? json_decode($earning->details, true) : $earning->details;
                @endphp
                <tr>
                  <td>{{ ucfirst($earning->type) }}</td>
                  <td>{{ $details['period'] ?? '-' }}</td>
                  <td>Rp{{ number_format($earning->total_amount, 0, ',', '.') }}</td>
                  <td>
                    @if ($earning->type === 'check_in')
                      Streak: {{ $details['streak'] ?? '-' }}, Reward:
                      Rp{{ number_format($details['reward'] ?? 0, 0, ',', '.') }}
                    @else
                      Views: {{ $details['views'] ?? '-' }}, Rank Rate: {{ $details['rank_rate'] ?? '-' }}
                    @endif
                  </td>
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
