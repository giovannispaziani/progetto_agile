<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="http://127.0.0.1:8000/ricercatore" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboardRicercatore') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'profileRicercatore' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pubblicazioniRicercatore') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Pubblicazioni scientifiche') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'budgetRicercatore' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('budgetRicercatore') }}">
          <i class="material-icons">monetization_on</i>
            <p>{{ __('Richieste Budget') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
