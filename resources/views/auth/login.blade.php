<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
  <link rel="icon" href="{{ asset('assets/img/company/inisiator-icon.svg') }}">

  <title>
    @yield('title' . ' | ') Inisiator
  </title>
</head>

<body>

  <div class="landing">
    <div class="landing-decoration"></div>

    <div class="landing-info">
      <div class="logo">
        <svg class="icon-logo-vikinger">
          <use xlink:href="#svg-logo-vikinger"></use>
        </svg>
      </div>

      <h2 class="landing-info-pretitle f-rajdhani">Welcome to</h2>

      <h1 class="landing-info-title mt-2">INISIATOR</h1>

      <p class="landing-info-text f-rajdhani">The next generation social network &amp; community! Connect with your friends and
        play with our quests and badges gamification system!</p>

      <div class="tab-switch">
        <p class="tab-switch-button login-register-form-trigger f-rajdhani">Login</p>

        <p class="tab-switch-button login-register-form-trigger f-rajdhani">Register</p>
      </div>
    </div>

    <div class="landing-form f-rajdhani">
      <div class="form-box login-register-form-element">
        <img class="form-box-decoration overflowing" src="{{ asset('assets/img/illustrations/rocket.webp') }}"
          alt="rocket">

        <h2 class="form-box-title f-rajdhani">Login</h2>

        <form action="{{ route('login') }}" method="POST" class="form">
          @csrf
          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="login-username" class="f-rajdhani">Username or Email</label>
                <input type="text" id="login-username" name="email" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="login-password" class="f-rajdhani">Password</label>
                <input type="password" id="login-password" name="password" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row space-between">
            <div class="form-item">
              <div class="checkbox-wrap">
                <input type="checkbox" id="login-remember" name="login_remember" checked>
                <div class="checkbox-box">
                  <svg class="icon-cross">
                    <use xlink:href="#svg-cross"></use>
                  </svg>
                </div>
                <label for="login-remember">Remember Me</label>
              </div>
            </div>

            <div class="form-item">
              <a class="form-link" href="#">Forgot Password?</a>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <button type="submit" class="button medium secondary f-rajdhani">LOGIN</button>
            </div>
          </div>
        </form>

        <p class="lined-text">Or login with</p>

        <div class="social-links">
          <a class="social-link facebook" href="#">
            <svg class="icon-facebook">
              <use xlink:href="#svg-facebook"></use>
            </svg>
          </a>

          <a class="social-link twitter" href="#">
            <svg class="icon-twitter">
              <use xlink:href="#svg-twitter"></use>
            </svg>
          </a>

          <a class="social-link twitch" href="#">
            <svg class="icon-twitch">
              <use xlink:href="#svg-twitch"></use>
            </svg>
          </a>

          <a class="social-link youtube" href="#">
            <svg class="icon-youtube">
              <use xlink:href="#svg-youtube"></use>
            </svg>
          </a>
        </div>
      </div>

      <div class="form-box login-register-form-element">
        <img class="form-box-decoration" src="{{ asset('assets/img/illustrations/rocket.webp') }}" alt="rocket">
        <h2 class="form-box-title">Create Account</h2>

        <form action="{{ route('register') }}" method="POST" class="form">
          @csrf
          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-name" class="f-rajdhani">Full Name</label>
                <input type="text" id="register-name" name="name" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-phone" class="f-rajdhani">WhatsApp</label>
                <input type="text" id="register-phone" name="phone" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-username" class="f-rajdhani">Username</label>
                <input type="text" id="register-username" name="username" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-email" class="f-rajdhani">Your Email</label>
                <input type="text" id="register-email" name="register_email" class="f-rajdhani">
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-password" class="f-rajdhani">Password</label>
                <input type="password" id="register-password" name="password" class="f-rajdhani">
                <span class="toggle-icon" onclick="togglePasswordVisibility()">👁️</span>
              </div>
            </div>
          </div>

          <script>
            function togglePasswordVisibility() {
              const passwordInput = document.getElementById("register-password");
              const toggleIcon = document.querySelector(".toggle-icon");

              if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.textContent = "🙈"; // Ikon mata tertutup
              } else {
                passwordInput.type = "password";
                toggleIcon.textContent = "👁️"; // Ikon mata terbuka
              }
            }
          </script>

          <div class="form-row mt-4">
            <div class="form-item">
              <div class="checkbox-wrap">
                <input type="checkbox" id="register-newsletter" name="register_newsletter" checked>
                <div class="checkbox-box">
                  <svg class="icon-cross">
                    <use xlink:href="#svg-cross"></use>
                  </svg>
                </div>
                <label for="register-newsletter" class="f-rajdhani">I agree with Inisiator Terms and
                  Conditions.</label>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <button class="button medium primary f-rajdhani">REGISTER</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('theme/js/app.bundle.min.js') }}"></script>
</body>

</html>
