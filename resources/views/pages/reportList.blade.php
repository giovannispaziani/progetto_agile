@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Report Progetto')])

@section('content')

<div class="content">

    <div class="container-fluid">
          <div class="row">

    @if (!empty($data['lista_report']))

    <div class="card card-nav-tabs" style="grid-column: 1/3 !important">
        <div class="card-header card-header-primary text-center" style="padding: 0.3em"> REPORT</div>

        <table class="table" style="width: 90%; margin: 0 auto">

          <thead>
              <tr>
                  <th>Titolo</th>
                  <th>Descrizione</th>
                  <th>Ricercatore</th>
                  <th>Data</th>
                  <th>Report</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data['lista_report'] as $rep)
              <tr>
                <td>{{ $rep['titolo'] }}</td>
                <td>{{ $rep['descrizione'] }}</td>
                <td>{{ $rep['ricercatore'] }}</td>
                <td>{{ $rep['data'] }}</td>
                <td><a href="{{route("pubblicazionefile.scarica", $rep['fileName'])}}"><i class="material-icons">file_download</i></a></td>
              </tr>
            @empty
            @endforelse
          </tbody>
        </table>

      </div>
      @else
      <div class="alert alert-primary" role="alert" style="width: 95%; margin-left: auto; margin-right: auto; text-align: center">
          NESSUN REPORT PER QUESTO PROGETTO
      </div>
      @endif
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
