@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
    <div class="row">
            
          <div class="card card-nav-tabs">

            <div class="card-header card-header-primary text-center">{{ $title }}</div>
        
              <div class="card-body">
                <h4 class="card-title text-center">{{ $description }}</h4>
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
