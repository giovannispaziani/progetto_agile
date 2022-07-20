@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Stato Avanzamento Lavori')])

@section('content')
<div class="content">

  <div class="container-fluid">

    @auth
    @if (Auth::user()->type == "Finanziatore")

    <!--Nome Progetto-->
    <div class="card card-nav-tabs">
        <h4 class="card-header card-header-info">Data stimata fine: {{ $data['data_fine'] }}</h4>
        <div class="card-body">
          <h3 class="card-title font-weight-bold">{{ $data['nome_progetto'] }}</h3>
          <br>
          <h4 class="card-text font-weight-bold">Descrizione:</h4>
          <h4 class="card-text">{{ $data['descrizione_progetto'] }}</h4>
          <h4 class="card-text font-weight-bold">Data inizio:</h4>
          <h4 class="card-text">{{ $data['data_inizio'] }}</h4>
          <a href="../sottoProgettiList/{{ $data['id_progetto'] }}"><button class="btn btn-success">Sottoprogetti</button></a>
        </div>
      </div>
    </div>

  @endif
  @endauth


  @endsection

  @push('js')
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
  @endpush
