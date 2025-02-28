<template>
  <div class="landing">
    <div class="landing-decoration"></div>

    <div class="landing-info">
      <div class="logo">
        <img :src="getAsset('assets/img/company/inisiator-icon.svg')" alt="logo" style="width: 24px;">
      </div>

      <h2 class="landing-info-pretitle">Welcome to</h2>
      <h1 class="landing-info-title">Vikinger</h1>
      <p class="landing-info-text">
        The next generation social network &amp; community! Connect with your friends and
        play with our quests and badges gamification system!
      </p>

      <div class="tab-switch">
        <p class="tab-switch-button" :class="{ active: isLogin }" @click="toggleTab('login')">Login</p>
        <p class="tab-switch-button" :class="{ active: !isLogin }" @click="toggleTab('register')">Register</p>
      </div>
    </div>

    <div class="landing-form">
      <div class="form-box login-register-form-element">
        <img class="form-box-decoration overflowing" :src="getAsset('theme/img/rocket.webp')" alt="rocket">
        <h2 class="form-box-title">{{ isLogin ? 'Account Login' : 'Create your Account!' }}</h2>

        <form :action="formAction" method="POST">
          <!-- CSRF Token -->
          <input type="hidden" name="_token" :value="csrfToken">

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label :for="isLogin ? 'login-username' : 'register-email'">{{ isLogin ? 'Username or Email' : 'Your Email' }}</label>
                <input type="text" :id="isLogin ? 'login-username' : 'register-email'" name="email" required>
              </div>
            </div>
          </div>

          <div v-if="!isLogin" class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="username" required>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
              </div>
            </div>
          </div>

          <div v-if="!isLogin" class="form-row">
            <div class="form-item">
              <div class="form-input">
                <label for="register-password-repeat">Repeat Password</label>
                <input type="password" id="register-password-repeat" name="password_confirmation" required>
              </div>
            </div>
          </div>

          <div class="form-row space-between" v-if="isLogin">
            <div class="form-item">
              <div class="checkbox-wrap">
                <input type="checkbox" id="login-remember" name="remember">
                <label for="login-remember">Remember Me</label>
              </div>
            </div>
            <div class="form-item">
              <a class="form-link" href="#">Forgot Password?</a>
            </div>
          </div>

          <div class="form-row">
            <div class="form-item">
              <button class="button medium" :class="isLogin ? 'secondary' : 'primary'">
                {{ isLogin ? 'Login to your Account!' : 'Register Now!' }}
              </button>
            </div>
          </div>
        </form>

        <p v-if="isLogin" class="lined-text">Login with your Social Account</p>
        <div v-if="isLogin" class="social-links">
          <a class="social-link facebook" href="#"><svg class="icon-facebook">
              <use xlink:href="#svg-facebook"></use>
            </svg></a>
          <a class="social-link twitter" href="#"><svg class="icon-twitter">
              <use xlink:href="#svg-twitter"></use>
            </svg></a>
          <a class="social-link twitch" href="#"><svg class="icon-twitch">
              <use xlink:href="#svg-twitch"></use>
            </svg></a>
          <a class="social-link youtube" href="#"><svg class="icon-youtube">
              <use xlink:href="#svg-youtube"></use>
            </svg></a>
        </div>
      </div>
    </div>
  </div>@auth

  @endauth
</template>

<script>
export default {
  data() {
    return {
      isLogin: true,
      csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    };
  },
  computed: {
    formAction() {
      return this.isLogin ? "{{ route('login') }}" : "{{ route('register') }}";
    }
  },
  methods: {
    toggleTab(type) {
      this.isLogin = type === 'login';
    },
    getAsset(path) {
      return `/${path}`; // Sesuaikan jika path asset berbeda
    }
  }
};
</script>

<style scoped>
/* Tambahkan styling jika diperlukan */
</style>
