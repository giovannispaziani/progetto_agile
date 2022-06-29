@extends('layouts.app', ['activePage' => 'aggiungiVoce', 'titlePage' => __('Aggiungi Voce')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" name="aggiungivoce" action="{{ route('aggiungiVoce-post') }}" autocomplete="off" class="form-horizontal">
            @csrf
            <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Richiesta budget') }}</h4>
                  <p class="card-category">{{ __('Apri nuova voce spesa per allocare budget') }}</p>
                </div>
                <div class="card-body ">

<!--CHOICE BOX PROGETTO-->
<label for="titolo">Seleziona progetto</label>
<select class="form-control" name="choices-button" id="choices-button" placeholder="Departure" value="progetto">
    @forelse ($data['progetti_attivi'] as $progettoattivo)
    <option value="{{ $progettoattivo['id'] }}">{{ $progettoattivo['nome'] }}</option>
    @empty
    <td class="text-center" colspan="6">Nessun progetto</td>
    @endforelse
</select>
<!--FINE CHOICE BOX PROGETTO-->
<br>
                    <div class="form-group">
                        <label for="scopo">Scopo</label>
                        <input type="text" class="form-control" name="scopo" placeholder="Inserisci scopo">
                      </div>
                      <div class="form-group">
                        <label for="budget">Budget</label>
                        <input type="text" class="form-control" name="budget" placeholder="Inserisci importo">
                      </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Richiedi') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
