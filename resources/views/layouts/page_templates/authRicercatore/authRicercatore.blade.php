<div class="wrapper ">
  @include('ricercatore.sidebarRicercatore')
  <div class="main-panel">
    @include('ricercatore.navRicercatore')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>