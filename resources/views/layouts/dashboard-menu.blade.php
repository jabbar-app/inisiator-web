<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme f-mono">
  <div class="app-brand demo">
    <a href="{{ route('pages.home') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/img/company/inisiator-icon.svg') }}" alt="Inisiator" class="h-100">
      </span>
      <span class="app-brand-text demo menu-text fw-bold">Inisiator</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Manajemen Data">Manajemen Data</span>
    </li>
    <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <li class="menu-item {{ Route::is('earnings.*') ? 'active' : '' }}">
      <a href="{{ route('earnings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-coins"></i>
        <div data-i18n="Penghasilan">Penghasilan</div>
      </a>
    </li>
    <li class="menu-item {{ Route::is('articles.*') ? 'active' : '' }}">
      <a href="{{ route('articles.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-notebook"></i>
        <div data-i18n="Artikel">Artikel</div>
      </a>
    </li>
    <li class="menu-item {{ Route::is('missions.*') ? 'active' : '' }}">
      <a href="{{ route('missions.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-spiral"></i>
        <div data-i18n="Portal Misi">Portal Misi</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Manajemen Akun">Manajemen Akun</span>
    </li>
    <li class="menu-item {{ Route::is('profile.*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Profil">Profil</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('pages.author', Auth::user()->username) }}" class="menu-link" target="_blank">
            <div data-i18n="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('profile.edit') ? 'active' : '' }}">
          <a href="{{ route('profile.edit') }}" class="menu-link">
            <div data-i18n="Edit Profil">Edit Profil</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('profile.verification') ? 'active' : '' }}">
          <a href="{{ route('profile.verification') }}" class="menu-link">
            <div data-i18n="Verifikasi">Verifikasi</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('profile.rank') ? 'active' : '' }}">
          <a href="{{ route('profile.rank') }}" class="menu-link">
            <div data-i18n="Rank & XP">Rank & XP</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('profile.bank-account') ? 'active' : '' }}">
          <a href="{{ route('profile.bank-account') }}" class="menu-link">
            <div data-i18n="Rekening Bank">Rekening Bank</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="menu-link" href="{{ route('logout') }}"
          onclick="event.preventDefault(); this.closest('form').submit();">
          <i class="ti ti-logout me-2 ti-sm"></i>
          <span class="align-middle">Log Out</span>
        </a>
      </form>
    </li>
  </ul>
</aside>
