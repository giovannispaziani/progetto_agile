@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Budget Ricercatore')])

@section('content')

<div class="content">

    <div class="container-fluid">
          <div class="row">

            <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

  <!--TABELLA VOCI SPESE-->
  <div class="card card-nav-tabs" style="grid-column: 1/3 !important">
    <div class="card-header card-header-primary text-center" style="padding: 0.3em"> VOCI SPESA</div>

    <table class="table" style="width: 90%; margin: 0 auto">

      <thead>
          <tr>
              <th>Progetto</th>
              <th>Scopo</th>
              <th>Importo</th>
              <th>Stato</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data['budget_ricercatore'] as $spesaricercatore)
          <tr>
              <td>{{ $spesaricercatore['progetto'] }}</td>
              <td>{{ $spesaricercatore['scopo'] }}</td>
              <td>{{ $spesaricercatore['importo'] }}</td>
              <td>{{ $spesaricercatore['stato'] }}</td>
              <!--DA SOSTITUIRE CON IL BOTTONE-->
          </tr>
        @empty
          <tr>
              <td class="text-center"><a href="#"></a></td>
              <td>Nessuna</td>
              <td>voce spesa</td>
          </tr>
        @endforelse
      </tbody>

  </table>

      </div>
    </div>
    </div>
        </div>
      </div>

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
