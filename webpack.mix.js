const mix = require('laravel-mix');

mix.setPublicPath('public');

// CSS Combine
mix.styles([
    'public/theme/css/bootstrap.min.css', // Path yang benar
    'public/theme/css/styles.min.css',
    'public/theme/css/vendor/simplebar.css',
    'public/theme/css/vendor/tiny-slider.css',
    'public/theme/css/custom.css'
], 'public/theme/css/app.css');

// JS Combine
mix.scripts([
    'public/theme/js/app.bundle.min.js', // Path yang benar
    'node_modules/jquery/dist/jquery.min.js'
], 'public/theme/js/app.js');

// Versioning (Cache Busting)
if (mix.inProduction()) {
    mix.version();
}
