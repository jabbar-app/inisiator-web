@extends('layouts.dashboard')

@section('content')
  <div class="card">
    <div class="card-body py-5">
      <center>
        <div class="d-none d-md-block">
          <img src="{{ asset('assets/img/under-construction.svg') }}" alt="Coming Soon" height="340">
        </div>
        <div class="d-md-none d-block">
          <img src="{{ asset('assets/img/under-construction.svg') }}" alt="Coming Soon" height="200">
        </div>
      </center>
      <div class="text-center">
        <h2 class="my-3 f-default">Segera Hadir!</h2>
        <div id="countdown">
          <h5 id="timer" class="fw-bold">launched in</h5>
        </div>
      </div>
    </div>
  </div>


  {{-- <div class="row">
    <div class="col-md-6 col-xl-4 col-xl-4 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between pb-2 mb-1">
          <div class="card-title mb-1">
            <h5 class="m-0 me-2">Sales by Countries</h5>
            <small class="text-muted">62 Deliveries in Progress</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="nav-align-top">
            <ul class="nav nav-tabs nav-fill" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">
                  New
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing"
                  aria-selected="false" tabindex="-1">
                  Preparing
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping"
                  aria-selected="false" tabindex="-1">
                  Shipping
                </button>
              </li>
            </ul>
            <div class="tab-content pb-0">
              <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
                <ul class="timeline timeline-advance timeline-advance mb-2 pb-1">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Myrtle Ullrich</h6>
                      <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Barry Schowalter</h6>
                      <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                    </div>
                  </li>
                </ul>
                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                <ul class="timeline timeline-advance mb-0">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Veronica Herman</h6>
                      <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Helen Jacobs</h6>
                      <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                    </div>
                  </li>
                </ul>
              </div>

              <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                <ul class="timeline timeline-advance mb-2 pb-1">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Barry Schowalter</h6>
                      <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Myrtle Ullrich</h6>
                      <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                    </div>
                  </li>
                </ul>
                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                <ul class="timeline timeline-advance mb-0">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Veronica Herman</h6>
                      <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Helen Jacobs</h6>
                      <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                <ul class="timeline timeline-advance mb-2 pb-1">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Veronica Herman</h6>
                      <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Barry Schowalter</h6>
                      <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                    </div>
                  </li>
                </ul>
                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                <ul class="timeline timeline-advance mb-0">
                  <li class="timeline-item ps-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-success">
                      <i class="ti ti-circle-check"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-success text-uppercase fw-medium">sender</small>
                      </div>
                      <h6 class="mb-0">Myrtle Ullrich</h6>
                      <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                    </div>
                  </li>
                  <li class="timeline-item ps-4 border-transparent">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-map-pin"></i>
                    </span>
                    <div class="timeline-event ps-0 pb-0">
                      <div class="timeline-header">
                        <small class="text-primary text-uppercase fw-medium">Receiver</small>
                      </div>
                      <h6 class="mb-0">Helen Jacobs</h6>
                      <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-xl-8 mb-4">
      <div class="card">
        <div class="card-body p-0">
          <div class="row row-bordered g-0">
            <div class="col-md-8 position-relative p-4">
              <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                <h5 class="m-0 card-title">Revenue Report</h5>
              </div>
              <div id="totalRevenueChart" class="mt-n1"></div>
            </div>
            <div class="col-md-4 p-4">
              <div class="text-center mt-4">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="budgetId"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="budgetId">
                    <a class="dropdown-item prev-year1" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 1);
                      </script>
                    </a>
                    <a class="dropdown-item prev-year2" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 2);
                      </script>
                    </a>
                    <a class="dropdown-item prev-year3" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 3);
                      </script>
                    </a>
                  </div>
                </div>
              </div>
              <h3 class="text-center pt-4 mb-0">$25,825</h3>
              <p class="mb-4 text-center"><span class="fw-medium">Budget: </span>56,800</p>
              <div class="px-3">
                <div id="budgetChart"></div>
              </div>
              <div class="text-center mt-4">
                <button type="button" class="btn btn-primary">Increase Budget</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@push('scripts')
  <script>
    // Set target date
    const targetDate = new Date('2025-01-23T09:00:00+07:00').getTime();

    // Update the countdown every second
    const countdown = setInterval(() => {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance < 0) {
        clearInterval(countdown);
        document.getElementById('timer').innerHTML = "The event has started!";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById('timer').innerHTML = `
            ${days}d ${hours}h ${minutes}m ${seconds}s
        `;
    }, 1000);
  </script>
@endpush
