@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Ricercatore')])

@section('content')
<div class="content">

<div class="container-fluid">
<h2> I miei progetti: </h2>
<!--COLLAPSE-->
<div id="accordion" role="tablist">
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          PROGETTI IN CORSO
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">

        <table class="table">
          <thead>
              <tr class="card-header card-header-primary">
                  <th>Nome</th>
                  <th>Descrizione</th>
                  <th>Data inizio</th>
                  <th>Data fine</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data['progetti_attivi'] as $progettoattivo)
              <tr>
                  <td><a href="/project-dashboard/{{ $progettoattivo['id'] }}">{{ $progettoattivo['nome'] }}</a></td>
                  <td>{{ $progettoattivo['descrizione'] }}</td>
                  <td>{{ $progettoattivo['data_inizio'] }}</td>
                  <td>{{ $progettoattivo['data_fine'] }}</td>
              </tr>
            @empty
              <tr>
                  <td class="text-center" colspan="6">Nessun progetto in corso</td>
              </tr>
            @endforelse
          </tbody>

        </table>

      </div>
    </div>
  </div>
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          PROGETTI CONCLUSI
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <table class="table">
          <thead>
              <tr class="card-header card-header-primary">
                  <th>Nome</th>
                  <th>Descrizione</th>
                  <th>Data inizio</th>
                  <th>Data fine</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data['progetti_conclusi'] as $progettoconcluso)
              <tr>
                  <td><a href="/project-dashboard/{{ $progettoconcluso['id'] }}">{{ $progettoconcluso['nome'] }}</a></td>
                  <td>{{ $progettoconcluso['descrizione'] }}</td>
                  <td>{{ $progettoconcluso['data_inizio'] }}</td>
                  <td>{{ $progettoconcluso['data_fine'] }}</td>
              </tr>
            @empty
              <tr>
                  <td class="text-center" colspan="6">Nessun progetto concluso</td>
              </tr>
            @endforelse
          </tbody>

        </table>

      </div>
    </div>
  </div>
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          PROGETTI CANCELLATI
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">

        <table class="table">
          <thead>
              <tr class="card-header card-header-primary">
                  <th>Nome</th>
                  <th>Descrizione</th>
                  <th>Data inizio</th>
                  <th>Data fine</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data['progetti_eliminati'] as $progettoeliminato)
              <tr>
                  <td><a href="/project-dashboard/{{ $progettoeliminato['id'] }}">{{ $progettoeliminato['nome'] }}</a></td>
                  <td>{{ $progettoeliminato['descrizione'] }}</td>
                  <td>{{ $progettoeliminato['data_inizio'] }}</td>
                  <td>{{ $progettoeliminato['data_fine'] }}</td>
              </tr>
            @empty
              <tr>
                  <td class="text-center" colspan="6">Nessun progetto eliminato</td>
              </tr>
            @endforelse
          </tbody>

        </table>

      </div>
    </div>
  </div>
</div>
<!--FINE COLLAPSE-->
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
