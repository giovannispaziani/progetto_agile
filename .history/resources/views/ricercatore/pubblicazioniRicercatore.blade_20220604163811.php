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
                  <h4 class="card-title">{{ __('Aggiungi pubblicazione') }}</h4>
                  <p class="card-category">{{ __('Inserisci una nuova pubblicazione scientifica al tuo profilo') }}</p>
                </div>
                <div class="card-body ">

                    <div class="form-group">
                        <label for="titoloPubblicazione">Titolo</label>
                        <input type="t" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>

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
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Aggiungi') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
