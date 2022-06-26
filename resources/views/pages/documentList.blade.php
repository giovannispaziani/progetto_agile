@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">

    <div class="card card-nav-tabs" >
    <div class="card-header card-header-primary text-center"> Pubblicazioni {{ $project }} </div>

    <table class="table">
      <thead>
          <tr>
              <th>Titolo</th>
              <th>Autore</th>
              <th>Data inizio</th>
              <th><button type="button" class="btn btn-primary">Aggiungi +</button></th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data as $documento)
          <tr>
              <td>{{ $documento['titolo'] }}</td>
              <td>{{ $documento['autore'] }}</td> 
              <td>{{ $documento['date'] }}</td> 
              <td><button type="button" class="btn btn-danger">Elimina</button></td>
          </tr>
        @empty
          <tr>
              <td class="text-center" colspan="6">Nessuna pubblicazione trovata</td>
          </tr>
        @endforelse
      </tbody>

    </table>


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
