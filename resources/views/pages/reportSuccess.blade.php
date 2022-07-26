@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Nuovo report')])

@section('content')
  <div class="content">
    <div class="container-fluid">

      <a href="../users/{{ auth()->user()->id }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Vai al profilo</a>

    <form class="form" method="POST" action="{{ route('aggiungiReport-post') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">



          <div class="card-header card-header-primary text-center">
            <h3 class="card-title"><strong>Nuovo report</strong></h3>
            <div class="social-line">
            </div>
          </div>


          <div class="card-body ">

            <h4 style="text-align: center">{{ $message }}</h4>

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
