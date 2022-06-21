@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Profilo Ricercatore')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">
            
          <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFORMAZIONI RICERCATORE </div>
            
                  <div class="card-body">
                    <h4 class="card-title">Id utente:</h4>
                    <p class="card-text" >{{ $data['id'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >{{ $data['name'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Cognome:</h4>
                    <p class="card-text" >{{ $data['surname'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Email:</h4>
                    <p class="card-text" >{{ $data['email'] }}</p>
                  </div>

      </div>

      <!--I miei contributi-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          I miei contributi
          <i class="material-icons" style="margin-left: 85%">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-body">
            <h4 class="card-title">Nome progetto:</h4>
            <p class="card-text" >{{ $data['nome_progetto'] }}</p>
            </div>

            <div class="card-body">
            <h4 class="card-title">Descrizione progetto:</h4>
            <p class="card-text" >{{ $data['descrizione_progetto'] }}</p>
            </div>


      </div>
    </div>
  </div>
  <!--Pubblicazioni esterne-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Pubblicazioni esterne
          <i class="material-icons" style="margin-left: 81%">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body" style="display: grid !important; grid-template-columns: auto auto !important;">
        
        <div class="card-body">
            <h4 class="card-title">Titolo pubblicazione:</h4>
            <p class="card-text" >{{ $data['titolo_pubblicazione'] }}</p>
        </div>

        <div class="card-body">
            <h4 class="card-title">Fonte pubblicazione:</h4>
            <p class="card-text" >{{ $data['fonte_pubblicazione'] }}</p>
        </div>
 
      </div>
    </div>
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