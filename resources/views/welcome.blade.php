@extends('layouts.app_auth', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Stark Industries')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Benvenuto su Stark Industries') }}</h1>
          <h3 class="text-white text-center">{{ __('Trasforma la tua idea in realtà') }}</h3>
      </div>
  </div>
</div>
@endsection
