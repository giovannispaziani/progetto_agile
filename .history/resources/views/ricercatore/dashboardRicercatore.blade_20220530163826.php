@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Ricercatore')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <h2>I miei progetti</h2>
      <p>Progetto #1</p>
=======



>>>>>>> 48dffd0df0b5821531ef18d7f3cc792c64c749a2
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
