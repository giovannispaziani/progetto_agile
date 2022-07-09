@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')

@switch(Auth::user()->type)
  @case("Manager")
    @include('pages.projectList')
    @break
  @case("Finanziatore")
    @include('pages.dashboardFinanziatore')
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