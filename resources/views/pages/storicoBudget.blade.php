@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
  <div class="row">
         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 90%">
             <div class="card-header card-header-primary text-center">STORICO BUDGET</div>

             <table class="table" style="width: 100%">

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
                    <td>{{ $budget['ricercatore'] }}</td> 
                    @if($budget['stato'])
                    <td><label>Accettata</label></td>
                    @else
                    <td><label>Rifiutata</label></td>
                    @endif
                    <td></td>
                  </tr>
                @empty
                  <tr>
                  <td class="text-center"><a href="/project-list-responsabile">nessuna voce  trovata</a></td>
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
