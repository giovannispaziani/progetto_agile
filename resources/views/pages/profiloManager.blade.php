@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Profilo Manager')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">

          <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFORMAZIONI MANAGER </div>

                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >{{ $data['name'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Cognome:</h4>
                    <p class="card-text" >{{ $data['surname'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Titolo di Studio:</h4>
                    <p class="card-text" >{{ $data['studi'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Occupazione:</h4>
                    <p class="card-text" >{{ $data['occupazione'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Email:</h4>
                    <p class="card-text" >{{ $data['email'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">LinkedIn:</h4>
                  <a href="{{ $data['linkedin'] }}" class='fa fa-linkedin' role="button" aria-disabled="true"></a>
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
