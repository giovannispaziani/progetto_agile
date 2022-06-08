@extends('layouts.ricercatore.appRicercatore', ['activePage' => 'pubblicazioniRicercatore', 'titlePage' => __('Pubblicazioni Scientifiche')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('pubblicazioneRicercatore-post') }}" autocomplete="off" class="form-horizontal">
            @csrf
            <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Aggiungi pubblicazione') }}</h4>
                  <p class="card-category">{{ __('Inserisci una nuova pubblicazione scientifica al tuo profilo') }}</p>
                </div>
                <div class="card-body ">

                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" class="form-control" name="titolo" placeholder="Inserisci titolo pubblicazione">
                      </div>
                      <div class="form-group">
                        <label for="fonte">Fonte</label>
                        <input type="text" class="form-control" name="fonte" placeholder="Inserisci link pubblicazione">
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
