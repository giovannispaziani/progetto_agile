<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('dashboardRicercatore') }}">{{ $title }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
    </li>
    <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
      <a href="{{ route('login') }}" class="nav-link">
        <i class="material-icons">fingerprint</i> {{ __('Accedi') }}
      </a>
    </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Registrati') }}
          </a>
        <li class="nav-item">
            <a href="{{ route('dashboardManager') }}" class="nav-link">
              <i class="material-icons">dashboard</i> {{ __('Dashboard Manager') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboardRicercatore') }}" class="nav-link">
              <i class="material-icons">dashboard</i> {{ __('Dashboard Ricercatore') }}
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
