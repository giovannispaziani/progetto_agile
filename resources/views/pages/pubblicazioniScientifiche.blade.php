@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Pubblicazioni Scientifiche')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('pubblicazioniScientifiche-post') }}" autocomplete="off" class="form-horizontal">
            @csrf
            <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Aggiungi pubblicazione scientifica') }}</h4>
                  <p class="card-category">{{ __('Inserisci una nuova pubblicazione scientifica al tuo profilo') }}</p>
                </div>
                <div class="card-body ">

                      <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" class="form-control" name="titolo" placeholder="Inserisci titolo pubblicazione" required>
                      </div>

                      <div class="form-group">
                        <label for="descrizione">Descrizione</label>
                        <input type="text" class="form-control" name="descrizione" placeholder="Inserisci descrizione pubblicazione" required>
                      </div>

                      <div class="form-group">
                        <label for="testo">Testo</label>
                        <input type="text" class="form-control" name="testo" placeholder="Inserisci testo pubblicazione" required>
                      </div>

                      <div class="form-group">
                        <label for="fonte">Fonte</label>
                        <input type="text" class="form-control" name="fonte" placeholder="Inserisci link pubblicazione" required>
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
