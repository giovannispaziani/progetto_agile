<div class="wrapper ">
  @include('manager.sidebarManager')
  <div class="main-panel">
    @include('manager.navManager')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>