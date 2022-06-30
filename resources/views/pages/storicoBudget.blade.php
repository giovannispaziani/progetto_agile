@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
  <div class="row">
         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 45%">
             <div class="card-header card-header-primary text-center"> BUDGET</div>

             <table class="table" style="width: 90%">

              <thead>
                  <tr>
                      <th></th>
                      <th>Scopo</th>
                      <th>Importo</th>   
                      <th>Ricercatore</th> 
                      <th>Stato</th>
                      <th> </th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($data as $budget)
                  <tr>
                    <td></td>
                    <td>{{ $budget['scopo'] }}</td>
                    <td>{{ $budget['budget'] }}</td> 
                    <td>{{ $budget['stato']}}</td>
                    <td></td>
                  </tr>
                @empty
                  <tr>
                      <td class="text-center"><a href="/storico-budget/{{$id_progetto}}"></a></td>
                      <td>nessun</td>
                      <td>budget</td> 
                  </tr>
                @endforelse
              </tbody>  

             </table>
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
