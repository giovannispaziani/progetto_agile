@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Lista Milestone')])

@section('content')

<div class="content">

    <div class="container-fluid">
          <div class="row">
            @if(auth()->user()->type == 'Manager')
            <a href="/aggiungiMilestone/{{ $data['id_sottoprogetto'] }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Aggiungi milestone</a>
            @endif
            <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

                <div class="card card-nav-tabs" style="grid-column: 1/3 !important">
                    <div class="card-header card-header-primary text-center" style="padding: 0.3em"> MILESTONE</div>

                    <table class="table" style="width: 90%; margin: 0 auto">

                      <thead>
                          <tr>
                              <th>Titolo</th>
                              <th>Descrizione</th>
                              <th>Data</th>
                          </tr>
                      </thead>
                      <tbody>
                        @forelse ($data['lista_milestone'] as $evento)
                          <tr>
                            <td>{{ $evento['titolo'] }}</td>
                            <td>{{ $evento['descrizione'] }}</td>
                            <td>{{ $evento['data'] }}</td>
                          </tr>
                        @empty
                          <tr>
                              <td class="text-center"><a href="#"></a></td>
                              <td>Nessuna</td>
                              <td>milestone..</td>
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
