@if(Auth::user()->type=="Manager")
  @extends('layouts.manager.appManager', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@elseif(Auth::user()->type=="Finanziatore")
  @extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@else(Auth::user()->type=="Ricercatore")
  @extends('layouts.ricercatore.appRicercatore', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@endif

@section('content')
  Benvenuto <b>{{Auth::user()->nome}}
@endsection


@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush