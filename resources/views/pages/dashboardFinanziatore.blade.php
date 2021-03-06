@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Finanziatore')])

@section('content')
<div class="content">

<div class="container-fluid">
<h2> I miei finanziamenti: </h2>
<br>
@if (!empty($data))
    <div class="card card-nav-tabs" style="width: 90%; margin: 0 auto">

        <table class="table">
          <thead>
              <tr class="card-header card-header-primary">
                  <th></th>
                  <th>Id progetto</th>
                  <th>Fondo (€)</th>
                  <th>Stato Avanzamento Lavori</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data as $progetto)
              <tr>
                  <td class="text-center"><a href="../budgetFinanziatore/{{ $progetto['id_progetto'] }}">&#10150;</a></td>
                  <td>{{ $progetto['id_progetto'] }}</td>
                  <td>{{ $progetto['fondo'] }}</td>
                  <td><a href="../statoAvanzamentoLavori/{{ $progetto['id_progetto'] }}"><button class="btn btn-primary">SAL</button></a></td>
              </tr>
            @empty
            @endforelse
          </tbody>

        </table>
    </div>
  @else
        <div class="alert alert-primary" role="alert" style="width: 95%; margin-left: auto; margin-right: auto; text-align: center">
            NESSUN PROGETTO FINANZIATO
        </div>
  @endif

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
