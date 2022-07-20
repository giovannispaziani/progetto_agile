@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Lista Sottoprogetti')])

@section('content')

<div class="content">

    <div class="container-fluid">
          <div class="row">
            <a href="/aggiungiSottoprogetto/{{ $data['id_progetto'] }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Aggiungi sottoprogetto</a>
            <a href="/project-dashboard/{{ $data['id_progetto'] }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Torna al progetto</a>
            <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

  <div class="card card-nav-tabs" style="grid-column: 1/3 !important">
    <div class="card-header card-header-primary text-center" style="padding: 0.3em"> SOTTOPROGETTI</div>

    <table class="table" style="width: 90%; margin: 0 auto">

      <thead>
          <tr>
              <th>Titolo</th>
              <th>Descrizione</th>
              <th>Termine</th>
              <th>Responsabile</th>
              <th>Milestone</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data['lista_sottoprogetti'] as $sottoprogetto)
          <tr>
            <td>{{ $sottoprogetto['titolo'] }}</td>
            <td>{{ $sottoprogetto['descrizione'] }}</td>
            <td>{{ $sottoprogetto['termine'] }}</td>
            <td><a href="../users/{{ $sottoprogetto['responsabile'] }}">{{ $sottoprogetto['nome_responsabile'] }}</a></td>
            <td><a href="/milestoneList/{{ $sottoprogetto['id'] }}" button class="btn btn-primary">Apri</a></td>
          </tr>
        @empty
          <tr>
              <td class="text-center"><a href="#"></a></td>
              <td>Nessun</td>
              <td>sottoprogetto</td>
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
