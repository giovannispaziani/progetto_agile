@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">
            
          <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFO </div>
            
                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >{{ $data['nome'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Descrizione:</h4>
                    <p class="card-text">{{ $data['descrizione'] }}</p>
                  </div>
            
                  <div class="card-body" >
                    <h4 class="card-title">Responsabile:</h4>
                    <a href="../users/{{ $data['id_responsabile'] }}" class="card-text">{{ $data['responsabile'] }}</a>
                  </div>  

                  <div class="card-body" >
                    <h4 class="card-title">Stato:</h4>
                    <p class="card-text">{{ $data['stato'] }}</p>
                  </div>

                  <div class="card-body"  >
                    <h4 class="card-title">Data inizio:</h4>
                    <p class="card-text">{{ $data['data_inizio'] }}</p>
                  </div>
                  
                  <div class="card-body" >
                    <h4 class="card-title">Data fine:</h4>
                    <p class="card-text">{{ $data['data_fine'] }}</p>
                  </div>

          </div>
          <!--TABELLA FINANZIATORI-->
          <div class="card card-nav-tabs" style="width: 45%">
              <div class="card-header card-header-primary text-center"> FINANZIATORI </div>

              <table class="table" style="width: 90%">

                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Cognome</th>    
                    </tr>
                </thead>
                <tbody>
                  @forelse ($data['finanziatori'] as $finanziatore)
                    <tr>
                        <td class="text-center"><a href="../users/{{ $finanziatore['id'] }}">&#10150;</a></td>
                        <td>{{ $finanziatore['nome'] }}</td>
                        <td>{{ $finanziatore['cognome'] }}</td> 
                    </tr>
                  @empty
                    <tr>
                        <td class="text-center"><a href="#"></a></td>
                        <td>nessun</td>
                        <td>finanziatore</td> 
                    </tr>
                  @endforelse
                </tbody>

            </table>

          </div> 
           <!--FINE TABELLA FINANZIATORI-->

           <!--TABELLA RICERCATORI-->
          <div class="card card-nav-tabs" style="width: 45%; margin-left: 10%">
            <div class="card-header card-header-primary text-center"> RICERCATORI 
          </div>
            <table class="table" style="width: 90%">

              <thead>
                  <tr>
                      <th></th>
                      <th>Nome</th>
                      <th>Cognome</th>  
                      <th>aggiungi <a href="/lista-ricercatore/{{$data['id_progetto']}}">
                        <i class="material-icons">co_present</i>
                      </a> </th>  
                  </tr>
              </thead>
              <tbody>
                @forelse ($data['ricercatori'] as $ricercatore)
                  <tr>
                    <td class="text-center"><a href="../users/{{ $ricercatore['id'] }}">&#10150;</a></td>
                    <td>{{ $ricercatore['nome'] }}</td>
                    <td>{{ $ricercatore['cognome'] }}</td>
                    <td><a href="/project-dashboard/{{$data['id_progetto']}}/remove/{{$ricercatore['id']}}"><button>remove</button></a></td>
                  </tr>
                @empty
                  <tr>
                      <td class="text-center"><a href="#"></a></td>
                      <td>nessun</td>
                      <td>ricercatore</td> 
                  </tr>
                @endforelse
              </tbody>  

          </table>

        </div> 
         <!--FINE TABELLA RICERCATORI-->

         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 45%">
             <div class="card-header card-header-primary text-center"> BUDGET (€) </div>

             <table class="table" style="width: 90%">

              <thead>
                  <tr>
                      <th></th>
                      <th>scopo</th>
                      <th>ammontare</th>    
                  </tr>
              </thead>
              <tbody>
                @forelse ($data['budget'] as $budget)
                  <tr>
                      <td class="text-center"><a href="../budgets/{{ $budget['id'] }}">&#10150;</a></td>
                      <td>{{ $budget['scopo'] }}</td>
                      <td>{{ $budget['budget'] }}</td> 
                  </tr>
                @empty
                  <tr>
                      <td class="text-center"><a href="#"></a></td>
                      <td>nessun</td>
                      <td>budget</td> 
                  </tr>
                @endforelse
              </tbody>  

             </table>

          </div> 
       <!--FINE TABELLA BUDGET-->

       <!--TABELLA PUBBLICAZIONI-->
      <div class="card card-nav-tabs" style="width: 45%; margin-left: 10%">
        <div class="card-header card-header-primary text-center"> PUBBLICAZIONI </div>

        <table class="table" style="width: 90%">

          <thead>
              <tr>
                  <th></th>
                  <th>titolo</th>
                  <th>autore</th>    
              </tr>
          </thead>
          <tbody>
            @forelse ($data['pubblicazioni'] as $pubblicazione)
              <tr>
                  <td class="text-center"><a href="../pubblicazioni/{{ $pubblicazione['id'] }}">&#10150;</a></td>
                  <td>{{ $pubblicazione['titolo'] }}</td>
                  <td>{{ $pubblicazione['autore'] }}</td> 
              </tr>
            @empty
              <tr>
                  <td class="text-center"><a href="#"></a></td>
                  <td>nessuna</td>
                  <td>pubblicazione</td> 
              </tr>
            @endforelse
          </tbody>  

      </table>

    </div> 
     <!--FINE TABELLA PUBBLICAZIONI-->

     <!--TABELLA SOTTOPROGETTI-->
     <!--<div class="card card-nav-tabs" >
      <div class="card-header card-header-primary text-center"> SOTTOPROGETTI </div>

      <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Nome</th>
                <th>Cognome</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Andrew Mike</td>
                <td>Develop</td> 
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>John Doe</td>
                <td>Design</td>   
            </tr>   
        </tbody>

    </table>

  </div> -->
   <!--FINE TABELLA SOTTOPROGETTI-->

   <!--TABELLA ENTI-->
   <!--<div class="card card-nav-tabs" >
    <div class="card-header card-header-primary text-center"> ENTI </div>

    <table class="table">
      <thead>
          <tr>
              <th class="text-center">#</th>
              <th>Nome</th>
              <th>Cognome</th>    
          </tr>
      </thead>
      <tbody>
          <tr>
              <td class="text-center">1</td>
              <td>Andrew Mike</td>
              <td>Develop</td> 
          </tr>
          <tr>
              <td class="text-center">2</td>
              <td>John Doe</td>
              <td>Design</td>   
          </tr>   
      </tbody>

  </table>

</div> -->
 <!--FINE TABELLA ENTI-->
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
