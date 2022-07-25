<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  @auth
    @switch(Auth::user()->type)
      @case("Ricercatore")
      <div class="logo">
        <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
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
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="../users/{{ auth()->user()->id }}">
            <i class="material-icons">face</i>
              <p>{{ __('Profilo pubblico')}}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="/project-list-responsabile">
              <i class="material-icons">work</i>
                <p>{{ __('Progetti in gestione') }}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('budgetRicercatore') }}">
              <i class="material-icons">monetization_on</i>
                <p>{{ __('Richieste Budget') }}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('aggiungiPubblicazione') }}">
              <i class="material-icons">library_books</i>
                <p>{{ __('Pubblicazioni') }}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('pubblicazioniScientifiche') }}">
              <i class="material-icons">library_books</i>
                <p>{{ __('Pubblicazioni scientifiche') }}</p>
            </a>
          </li>
        </ul>
      </div>
      @break
  @case("Manager")
  <div class="logo">
    <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="../users/{{ auth()->user()->id }}">
        <i class="material-icons">face</i>
          <p>{{ __('Profilo pubblico')}}</p>
        </a>
      </li>
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
          <p>{{ __('Creazione progetto')}}</p>
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
  @case("Finanziatore")
  <div class="logo">
    <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
      {{ __('Stark Industries') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
              <p>{{ __('Dashboard')}}</p>
            </a>
          </li>
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="../users/{{ auth()->user()->id }}">
            <i class="material-icons">face</i>
              <p>{{ __('Profilo pubblico')}}</p>
        </a>
      </li>
    </ul>
  </div>
  @break
  @default
  <div class="logo">
    <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
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
@endauth

@guest
<div class="logo">
  <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
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
      <a class="nav-link" href="{{ route('users-list') }}">
      <i class="material-icons">face</i>
        <p>{{ __('Lista utenti')}}</p>
      </a>
    </li>
  </ul>
</div>
@endguest

</div>
