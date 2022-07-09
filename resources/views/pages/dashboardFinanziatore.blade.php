@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Finanziatore')])

@section('content')
<div class="content">

<div class="container-fluid">
<h2> Progetti finanziati: </h2>
<br>
    <div class="card card-nav-tabs" style="width: 90%; margin: 0 auto">
        
        <table class="table">
          <thead>
              <tr class="card-header card-header-primary">
                  <th></th>
                  <th>Id progetto</th>
                  <th>Fondo (€)</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($data as $progetto)
              <tr>
                <td class="text-center"><a href="../budgetFinanziatore/{{ $progetto['id_progetto'] }}">&#10150;</a></td>
                  <td>{{ $progetto['id_progetto'] }}</td>
                  <td>{{ $progetto['fondo'] }}</td>
              </tr>
            @empty
              <tr>
                  <td class="text-center" colspan="6">Nessun progetto finanziato</td>
              </tr>
            @endforelse
          </tbody>
    
        </table>

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