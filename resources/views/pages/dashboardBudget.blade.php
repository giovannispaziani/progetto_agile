@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
  <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">store</i>
            </div>
            <p class="card-category">Budget</p>
              <h3 class="card-title">{{$data['budget']}} $</h3>
            </div>
            <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Last 24 Hours
            </div>
          </div>
        </div>
      </div>
</div>
    <div class="row">

         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 90%">
             <div class="card-header card-header-primary text-center"> VOCI SPESA </div>

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
                @forelse ($data['spese'] as $spesa)
                  <tr>
                    <td></td>
                    <td>{{ $spesa['scopo'] }}</td>
                    <td>{{ $spesa['budget'] }}</td> 
                    <td><button type="submit" name="budget" form="accept" value="{{$spesa['id']}}" class="btn btn-success" >accetta</button></td>
                    <td><button type="submit" name="budget" form="refuses" value="{{$spesa['id']}}" class="btn btn-danger" > rifiuta</button></td>
                    <td></td>
                  </tr>
                @empty
                  <tr>
                      <td class="text-center"><a href="#"></a></td>
                      <td>nessun</td>
                      <td>spesa</td> 
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
         

          <div class="card card-nav-tabs" style="width: 90%">
             <div class="card-header card-header-primary text-center">AGGIUNGI BUDGET (€) </div>

             <table class="table" style="width: 90%">

              <thead>
                  <tr>
                      <th></th>
                      <th>Importo</th>
                      <th>Finanziatore</th>
                      <th>Azione</th>
                  </tr>
              </thead>
              <tbody>
                <form action="{{route('aggiungi-budget')}}" method="post">
                  @csrf
                  <tr><input type="hidden" name="id_progetto" value="{{$data['id_progetto']}}">
                    <td></td>
                    <td><input type="number" name="importo" min="1000"max="100000"step="1000">€</td>
                    <td><select class="form-control" name="id_finanziatore" >
                    @foreach($data['finanziatori'] as $finanziatore)
                    <option value="{{$finanziatore['id']}}" name="id_finanziatore">{{$finanziatore['nome']}} {{$finanziatore['cognome']}}</option>
                    @endforeach
                  </select></td>
                    <td><button type="submit">Aggiungi</button></td>
                  </tr>
                  </tbody>  
                </table>
        
        </form>
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
