<div class="content-grid p-0 my-4 full">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="widget-box">
          <h5 class="mb-0">Monthly Views & Reads</h5>
          <small class="text-muted">
            {{ now()->startOfMonth()->format('F 1, Y') }} - {{ now()->format('F d, Y') }} (UTC)
          </small>
          <!-- Tambahkan wrapper untuk canvas -->
          <div class="chart-container" style="position: relative; height: 400px;">
            <canvas id="viewsReadsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('viewsReadsChart').getContext('2d');

      // Data dari backend
      const labels = @json($dates); // Array of dates (e.g., ["Jan 1", "Jan 2", ...])
      const viewsData = @json($viewsData); // Array of view counts for each date
      const readsData = @json($readsData); // Array of read counts for each date

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
              label: 'Views',
              data: viewsData,
              borderColor: '#4CAF50',
              backgroundColor: 'rgba(76, 175, 80, 0.2)',
              borderWidth: 2,
              tension: 0.3, // Smooth lines
              fill: true,
            },
            {
              label: 'Reads',
              data: readsData,
              borderColor: '#2196F3',
              backgroundColor: 'rgba(33, 150, 243, 0.2)',
              borderWidth: 2,
              tension: 0.3, // Smooth lines
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, // Nonaktifkan maintainAspectRatio
          interaction: {
            mode: 'nearest',
            intersect: false,
          },
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  const value = context.raw;
                  return `${context.dataset.label}: ${value.toLocaleString()}`;
                },
              },
            },
            legend: {
              display: true,
              position: 'top',
            },
          },
          scales: {
            x: {
              title: {
                display: true,
                text: 'Date',
                font: {
                  size: 14,
                },
              },
              ticks: {
                maxRotation: 45,
                minRotation: 0,
              },
            },
            y: {
              title: {
                display: true,
                text: 'Counts',
                font: {
                  size: 14,
                },
              },
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return value.toLocaleString();
                },
              },
            },
          },
        },
      });
    });
  </script>
@endpush
