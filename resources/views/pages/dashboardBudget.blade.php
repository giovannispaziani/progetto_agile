@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
  <div class="row">
         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 45%">
             <div class="card-header card-header-primary text-center"> BUDGET (€) </div>

             <table class="table" style="width: 90%">

              <thead>
                  <tr>
                      <th></th>
                      <th>scopo</th>
                      <th>ammontare</th>   
                      <th>Accetta</th> 
                      <th>Rifiuta</th>
                      <th> </th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($data as $budget)
                  <tr>
                    <td></td>
                    <td>{{ $budget['scopo'] }}</td>
                    <td>{{ $budget['budget'] }}</td> 
                    <td><button type="submit" name="budget" form="accept" value="{{$budget['id']}}" class="btn btn-success" >accetta</button></td>
                    <td><button type="submit" name="budget" form="refuses" value="{{$budget['id']}}" class="btn btn-danger" > rifiuta</button></td>
                    <td></td>
                  </tr>
                @empty
                  <tr>
                      <td class="text-center"><a href="#"></a></td>
                      <td>nessun</td>
                      <td>budget</td> 
                  </tr>
                @endforelse
                <form action="{{route('accept-budget')}}" class="form" method="post" id="accept">
                  @csrf
                  <input type="hidden" name="progetto" value="{{$id_progetto}}">
                </form>    
                <form action="{{route('refuse-budget')}}" class="form" method="post" id="refuses">
                  @csrf
                  <input type="hidden" name="progetto" value="{{$id_progetto}}">
                </form>
              </tbody>  

             </table>
          </div>
        </div>
          </div> 
       <!--FINE TABELLA BUDGET-->
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
