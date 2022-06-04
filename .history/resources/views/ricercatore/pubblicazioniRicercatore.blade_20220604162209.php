@extends('layouts.ricercatore.appRicercatore', ['activePage' => 'profileRicercatore', 'titlePage' => __('User Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Aggiorna le tue informazioni') }}</h4>
                  <p class="card-category">{{ __('') }}</p>
                </div>
                <div class="card-body ">

              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" class="inputFileHidden">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Multiple Files" multiple>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-info">
                            <i class="material-icons">layers</i>
                        </button>
                    </span>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
