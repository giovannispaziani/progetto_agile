@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Budget Finanziatore')])

@section('content')

<div class="content">

    <div class="container-fluid">
          <div class="row">
            <a href="/dashboardFinanziatore" class="btn btn-primary btn-round" role="button" aria-disabled="true">Progetti finanziati</a>
            <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

  <!--TABELLA VOCI SPESE-->
  <div class="card card-nav-tabs" style="grid-column: 1/3 !important">
    <div class="card-header card-header-primary text-center" style="padding: 0.3em">RICHIESTE BUDGET PER IL PROGETTO</div>

    <table class="table" style="width: 90%; margin: 0 auto">

      <thead>
          <tr>
              <th>Scopo</th>
              <th>Importo</th>
              <th>Stato</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data['budget'] as $spesa)
          <tr>
              <td>{{ $spesa['scopo'] }}</td>
              <td>{{ $spesa['importo'] }}</td>
              <td>{{ $spesa['stato'] }}</td>
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