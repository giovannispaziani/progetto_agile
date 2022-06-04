@extends('layouts.ricercatore.appRicercatore', ['activePage' => 'profileRicercatore', 'titlePage' => __('User Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
