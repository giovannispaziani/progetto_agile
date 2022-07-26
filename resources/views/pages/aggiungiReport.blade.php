@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Aggiungi Report')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" name="aggiungirep" action="{{ route('aggiungiReport-post') }}" class="form-horizontal" enctype="multipart/form-data" >
            @csrf
            <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Aggiungi report') }}</h4>
                  <p class="card-category">{{ __('Pubblica un report per il progetto selezionato') }}</p>
                </div>
                <div class="card-body ">

                    <!--CHOICE BOX PROGETTO-->
                    <label for="titolo">Seleziona progetto</label>
                    <select class="form-control" name="id_progetto" id="choices-button" placeholder="Departure" value="progetto">
                        @forelse ($data['progetti_attivi'] as $progettoattivo)
                        <option value="{{ $progettoattivo['id'] }}">{{ $progettoattivo['nome'] }}</option>
                        @empty
                        <td class="text-center" colspan="6">Nessun progetto</td>
                        @endforelse
                    </select>
                    <!--FINE CHOICE BOX PROGETTO-->
                    <br>

                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" class="form-control" name="titolo" placeholder="Inserisci titolo report" required>
                      </div>

                      <div class="form-group">
                        <label for="descrizione">Descrizione</label>
                        <input type="text" class="form-control" name="descrizione" placeholder="Inserisci descrizione report" required>
                      </div>

                      <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" name="data" placeholder="Inserisci data report" required>
                      </div>

                      <div class="row">
                     <div class="col-md-6">
                        <input type="file" name="file" class="form-control"/ required>
                     </div>
                </form>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Aggiungi') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
