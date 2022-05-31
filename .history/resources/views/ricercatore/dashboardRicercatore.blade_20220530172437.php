@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Ricercatore')])

@section('content')
  <div class="content">
    <div class="container-fluid">

      <h2>I miei progetti</h2>
      <p>Progetto #1</p>

    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
