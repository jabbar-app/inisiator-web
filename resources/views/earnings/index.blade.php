@extends('layouts.dashboard')

@section('content')
  <h1 class="h4 mb-4">Statistik Penghasilan</h1>

  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="card-title">Rp{{ number_format($totalEarnings, 0, ',', '.') }},-</h2>
          <p class="mb-0">Total Artikel: <strong>{{ number_format($totalArticles) }}</strong></p>
        </div>
        <div class="d-flex gap-2">
          <form method="post" action="{{ route('earnings.calculate') }}" class="my-auto">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="ti ti-reload"></i></button>
          </form>
          <button onclick="withdraw()" id="withdrawButton" class="btn btn-outline-primary my-auto"
            data-amount="{{ $totalEarnings }}" data-threshold="{{ $threshold }}">
            <i class="ti ti-transition-bottom me-2"></i> Withdraw
          </button>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="progress mt-3" style="height: 20px;">
        <div class="progress-bar" role="progressbar" style="width: {{ min(($totalEarnings / $threshold) * 100, 100) }}%;"
          aria-valuenow="{{ $totalEarnings }}" aria-valuemin="0" aria-valuemax="{{ $threshold }}">
          {{ min(($totalEarnings / $threshold) * 100, 100) }}%
        </div>
      </div>
      <small class="text-muted">Minimal saldo untuk penarikan: Rp{{ number_format($threshold, 0, ',', '.') }},-</small>
    </div>
  </div>

  <h2 class="h5 mb-3">Details</h2>
  <div class="table-responsive">
    <table class="table table-striped">
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
@endsection

@push('scripts')
  <script>
    function withdraw() {
      console.log('Withdraw button clicked');

      const button = document.getElementById('withdrawButton');
      const amount = parseFloat(button.getAttribute('data-amount'));
      const threshold = parseFloat(button.getAttribute('data-threshold'));
      console.log('Amount:', amount);
      console.log('Threshold:', threshold);

      if (amount < threshold) {
        console.log(`Saldo kurang dari Rp${threshold.toLocaleString('id-ID')},-`);
        Swal.fire({
          title: 'Info!',
          text: `Mohon maaf, saldo kamu belum mencukupi minimal penarikan yaitu sebesar Rp${threshold.toLocaleString('id-ID')},-`,
          icon: 'info',
          customClass: {
            confirmButton: 'btn btn-primary waves-effect waves-light'
          },
          buttonsStyling: false
        });
      } else {
        console.log('Saldo mencukupi. Redirecting...');
        window.location.href = "{{ route('earnings.withdraw') }}";
      }
    }
  </script>
@endpush
