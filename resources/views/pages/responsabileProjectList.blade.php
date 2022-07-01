@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Progetti in cui sei responsabile')])

@section('content')
<div class="content">

  <div class="container-fluid">

    <div class="card card-nav-tabs" >
    <div class="card-header card-header-primary text-center"> PROGETTI </div>

    <table class="table">
      <thead>
          <tr>
            <th></th>
              <th>Nome</th>
              <th>Data inizio</th>
              <th>Data fine</th>
              <th>Dashboard budget</th>
              <th>Storico voci spesa</th>
              <th></th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data as $progetto)
          <tr>
              <td class="text-center"><a href="../project-dashboard/{{ $progetto['id'] }}">&#10150;</a></td>
              <td>{{ $progetto['nome'] }}</td>
              <td>{{ $progetto['data_inizio'] }}</td> 
              <td>{{ $progetto['data_fine'] }}</td>
              <td><a href="/dashboard-budget/{{ $progetto['id']}}"><button type="button" class="btn btn-primary">Budget</button></a></td>
              <td><a href="/storico-budget/{{$progetto['id']}}"> <button type="button" class="btn btn-primary">Storico</button></td> 
              <td></td>
          </tr>
        @empty
          <tr>
              <td class="text-center" colspan="6">Nessun progetto trovato</td>
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
