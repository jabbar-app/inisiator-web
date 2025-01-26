<div id="modalAdblock" style="display: none;">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h6 class="fw-normal mb-2" style="font-size: 18px;">
            <img src="{{ asset('assets/img/company/inisiator-icon.svg') }}" alt="Inisiator" height="24">
            Inisiator Prime
          </h6>
          <h1 class="fw-bold mb-3">It looks like you’re using an ad-blocker!</h1>
          <p class="text-muted">
            This website is an advertising-supported platform, and we noticed you have ad-blocking enabled.
            Here are two ways you can keep enjoying our content:
          </p>
          <div class="d-flex justify-content-center align-items-center">
            <div class="p-4 text-center">
              <small class="text-muted">TURN OFF YOUR AD-BLOCKER</small>
              <a href="" class="btn btn-outline-primary rounded-pill btn-block mt-2">RELOAD</a>
            </div>
            <div class="p-4 text-center">
              <small class="text-muted">JOIN OUR MEMBERSHIP</small>
              <a href="" class="btn btn-primary rounded-pill btn-block px-4 mt-2">GET ACCESS NOW</a>
            </div>
          </div>

          <small class="row justify-content-between mx-1 mt-4">
            <a href="#">Learn more about Inisiator Prime</a>
            @guest
              <span>
                Already a member? <a href="{{ route('login') }}" class="text-primary">Login</a>
              </span>
            @endguest
          </small>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Create a dummy ad element
    const adBlockTester = document.createElement('div');
    adBlockTester.className = 'ad-banner'; // Class name commonly blocked by adblockers
    adBlockTester.style.display = 'none'; // Hide it visually
    document.body.appendChild(adBlockTester);

    // Check if adblock is active
    const isAdblockActive = window.getComputedStyle(adBlockTester).getPropertyValue('display') === 'none';

    if (isAdblockActive) {
      $('#modalAdblock').bPopup(); // Show the popup
    }

    // Clean up: remove the test element
    document.body.removeChild(adBlockTester);
  });
</script>
