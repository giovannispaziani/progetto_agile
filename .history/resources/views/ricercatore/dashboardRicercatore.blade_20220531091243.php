@extends('layouts.ricercatore.appRicercatore', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Ricercatore')])

@section('content')
  <div class="content">

    <div class="container-fluid">

        

    <h2> I miei progetti: </h2>
    <div id="accordion" role="tablist">
  <!--Progetto attivi-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Progetti attivi
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Progetto #1
      </div>
    </div>
  </div>
  <!--Progetto conclusi-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Progetti conclusi
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Progetto #2
      </div>
    </div>
  </div>
  <!--Progetto eliminati-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Progetti eliminati
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Progetto #3
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
