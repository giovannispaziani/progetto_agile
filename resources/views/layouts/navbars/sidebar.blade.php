<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
@switch(Auth::user()->type)
  @case("Ricercatore")
  <div class="logo">
    <a href="http://127.0.0.1:8000/ricercatore" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'profileRicercatore' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Pubblicazioni esterne') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">monetization_on</i>
            <p>{{ __('Richieste Budget') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('progect-list-responsabile') }}">
          <i class="material-icons">monetization_on</i>
            <p>{{ __('Dashboard budget') }}</p>
        </a>
      </li>
    </ul>
  </div>
  @break
  @case("Manager")
  <div class="logo">
    <a href="http://127.0.0.1:8000/ricercatore" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">    
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('project-list') }}">
        <i class="material-icons">work</i>
          <p>{{ __('Lista progetti')}}</p>
        </a>
      </li>
    <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('registerFin') }}">
        <i class="material-icons">face</i>
          <p>{{ __('Registrazione Finanziatore') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('project-create') }}">
        <i class="material-icons">work</i>
          <p>{{ __('Creazione progetto ')}}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('progect-list-responsabile') }}">
          <i class="material-icons">monetization_on</i>
            <p>{{ __('Dashboard budget') }}</p>
        </a>
      </li>
    </ul>
  </div>
  @break
  @default
  <div class="logo">
    <a href="http://127.0.0.1:8000/ricercatore" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
    </ul>
  </div>
  @break
@endswitch

</div>