@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Creazione progetto')])

@section('content')
  <div class="content">
    <div class="container-fluid">
    
    
    <form class="form" method="POST" action="{{ route('project-create-post') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">



          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>Creazione progetto</strong></h4>
            <div class="social-line">
            </div>
          </div>


          <div class="card-body ">

            <h1>{{ $message }}</h1>

          </div>


          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">Crea progetto</button>
          </div>



        </div>
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