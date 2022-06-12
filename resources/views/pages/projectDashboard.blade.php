@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">
            
          <div class="card card-nav-tabs">

            <div class="card-header card-header-primary text-center"> INFO </div>
            
                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >With supporting text below as a natural lead-in to additional content.</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Descrizione:</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  </div>
            
                  <div class="card-body" >
                    <h4 class="card-title">Responsabile:</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  </div>  

                  <div class="card-body" >
                    <h4 class="card-title">Stato:</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  </div>

                  <div class="card-body"  >
                    <h4 class="card-title">Data inizio:</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  </div>
                  
                  <div class="card-body" >
                    <h4 class="card-title">Data fine:</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  </div>

          </div>
          <!--TABELLA FINANZIATORI-->
          <div class="card card-nav-tabs" style="width: 45%">
              <div class="card-header card-header-primary text-center"> FINANZIATORI </div>

              <table class="table" style="width: 90%">

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

          </div> 
           <!--FINE TABELLA FINANZIATORI-->

           <!--TABELLA RICERCATORI-->
          <div class="card card-nav-tabs" style="width: 45%; margin-left: 10%">
            <div class="card-header card-header-primary text-center"> RICERCATORI </div>

            <table class="table" style="width: 90%">

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

        </div> 
         <!--FINE TABELLA RICERCATORI-->

         <!--TABELLA BUDGET-->
         <div class="card card-nav-tabs" style="width: 45%">
             <div class="card-header card-header-primary text-center"> BUDGET (€) </div>

             <table class="table" style="width: 90%">

             <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Budget</th>   
                </tr>
             </thead>
             <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Andrew Mike</td>
                </tr>  
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

    </div> 
     <!--FINE TABELLA PUBBLICAZIONI-->

     <!--TABELLA SOTTOPROGETTI-->
     <div class="card card-nav-tabs" >
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

  </div> 
   <!--FINE TABELLA SOTTOPROGETTI-->

   <!--TABELLA ENTI-->
   <div class="card card-nav-tabs" >
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

</div> 
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
