@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')

@switch(Auth::user()->type)
  @case("Manager")
    @include('pages.dashboardManager')
    @break
  @case("Finanziatore")
    @include('pages.dashboardRicercatore')
    @break
@endswitch

@endsection


@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush