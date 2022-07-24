@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Profilo')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">

          <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFORMAZIONI </div>

                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >{{ $data['name'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Cognome:</h4>
                    <p class="card-text" >{{ $data['surname'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Titolo di Studio:</h4>
                    <p class="card-text" >{{ $data['studi'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Occupazione:</h4>
                    <p class="card-text" >{{ $data['occupazione'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Email:</h4>
                    <p class="card-text" >{{ $data['email'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">LinkedIn:</h4>
                  <a href="{{ $data['linkedin'] }}" class='fa fa-linkedin' role="button" aria-disabled="true"></a>
                </div>

      </div>

<!--TABELLA PROGETTI-->

@if (!empty($data['pubblicazioni_progetti']))

<div class="card card-nav-tabs" style="grid-column: 1/3 !important">
  <div class="card-header card-header-primary text-center" style="padding: 0.3em"> I MIEI CONTRIBUTI</div>

  <table class="table" style="width: 90%; margin: 0 auto">

    <thead>
        <tr>
            <th>Titolo</th>
            <th>Progetto</th>
            <th>Descrizione</th>
            <th>Testo</th>
            <th>Allegato</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      @forelse ($data['pubblicazioni_progetti'] as $pubblicazionepr)
        <tr>
          <td>{{ $pubblicazionepr['titolopr'] }}</td>
          <td><a href="/project-dashboard/{{ $pubblicazionepr['id_progettopr'] }}">{{ $pubblicazionepr['progettopr'] }}</a></td>
          <td>{{ $pubblicazionepr['descrizionepr'] }}</td>
          <td>{{ $pubblicazionepr['testopr'] }}</td>
          <td><a href="{{route("pubblicazionefile.scarica", $pubblicazionepr['fileName'])}}"><i class="material-icons">file_download</i></a></td>
          @auth
            @if(Auth::user()->id == $data['id'])
              <td><a href="/eliminaPubblicazione/{{$pubblicazionepr['idpr']}}"><button class="btn btn-danger">Elimina</button></a></td>
              <td><button type="button" class="btn btn-default"  data-toggle="modal" data-target="#editPRDialog"
                onclick='prefillPRDialog({{$pubblicazionepr['idpr']}},"{{ $pubblicazionepr['titolopr'] }}","{{ $pubblicazionepr['descrizionepr'] }}","{{ $pubblicazionepr['testopr'] }}","{{ $pubblicazionepr['id_progettopr'] }}")'>Modifica</button></td>
            @endif
          @endauth
        </tr>
      @empty
      @endforelse
    </tbody>
  </table>

</div>
@else
<div class="alert alert-primary" role="alert" style="width: 95%; margin-left: auto; margin-right: auto; text-align: center">
    NESSUN CONTRIBUTO A PROGETTI DELLA PIATTAFORMA
</div>
@endif


<!--TABELLA PUBBLICAZIONI SCIENTIFICHE-->

@if (!empty($data['pubblicazioni_scientifiche']))
<div class="card card-nav-tabs" style="grid-column: 1/3 !important">
    <div class="card-header card-header-primary text-center" style="padding: 0.3em"> PUBBLICAZIONI SCIENTIFICHE</div>

    <table class="table" style="width: 90%; margin: 0 auto">

      <thead>
          <tr>
              <th>Titolo</th>
              <th>Descrizione</th>
              <th>Testo</th>
              <th>Fonte</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data['pubblicazioni_scientifiche'] as $pubblicazionesc)
          <tr>
              <td>{{ $pubblicazionesc['titolosc'] }}</td>
              <td>{{ $pubblicazionesc['descrizionesc'] }}</td>
              <td>{{ $pubblicazionesc['testosc'] }}</td>
              <td><a href="{{ $pubblicazionesc['fontesc'] }}"><i class="material-icons">link</i></a></td>
              @auth
                @if(Auth::user()->id == $data['id'])
                  <td><a href="/eliminaPubblicazioneScientifica/{{$pubblicazionesc['idsc']}}"><button class="btn btn-danger">Elimina</button></a></td>
                  <td><button type="button" class="btn btn-default"  data-toggle="modal" data-target="#editPSDialog"
                    onclick='prefillPSDialog({{$pubblicazionesc['idsc']}},"{{ $pubblicazionesc['titolosc'] }}","{{ $pubblicazionesc['descrizionesc'] }}","{{ $pubblicazionesc['testosc'] }}","{{ $pubblicazionesc['fontesc'] }}")'>Modifica</button></td>
                @endif
              @endauth
          </tr>
        @empty
        @endforelse
      </tbody>

  </table>

      </div>
      @else
    <div class="alert alert-primary" role="alert" style="width: 95%; margin-left: auto; margin-right: auto; text-align: center">
        NESSUNA PUBBLICAZIONE ESTERNA
    </div>
    @endif
    </div>
    </div>
  </div>


  @auth
    @if(Auth::user()->id == $data['id'])

      <!-- Modal edit publication -->
      <div class="modal fade bd-example-modal-lg" id="editPRDialog" tabindex="-1" role="dialog"
        aria-labelledby="editPRDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h5 id="prtitle" class="modal-title" id="editPRDialogLabel">Modifica </h5><!--####-->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="form" method="POST" id="editPub" action="{{ route('modificaPubblicazione') }}" enctype="multipart/form-data">
                @csrf
                <input id="prid" type="hidden" name="id" value=""><!--####-->

                <div class="bmd-form-group{{ $errors->has('titolo') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input id="prtitolo" type="text" name="titolo" class="form-control" placeholder="{{ __('Titolo pubblicazione scientifica...') }}"
                      value="" required><!--####-->
                  </div>
                  @if ($errors->has('titolo'))
                  <div id="titolo-error" class="error text-danger pl-3" for="titolo" style="display: block;">
                    <strong>{{ $errors->first('titolo') }}</strong>
                  </div>
                  @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('descrizione') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea id="prdescrizione" name="descrizione" class="form-control" placeholder="{{ __('Descrizione della pubblicazione...') }}"
                      required rows="5"></textarea><!--####-->
                  </div>
                  @if ($errors->has('descrizione'))
                  <div id="descrizione-error" class="error text-danger pl-3" for="descrizione" style="display: block;">
                    <strong>{{ $errors->first('descrizione') }}</strong>
                  </div>
                  @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('testo') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="testo">Testo</label>
                    <input id="prtesto" name="testo" class="form-control" placeholder="{{ __('Testo della pubblicazione...') }}"
                      required value=""><!--####-->
                  </div>
                  @if ($errors->has('testo'))
                  <div id="testo-error" class="error text-danger pl-3" for="testo" style="display: block;">
                    <strong>{{ $errors->first('testo') }}</strong>
                  </div>
                  @endif
                </div>

                <!--CHOICE BOX PROGETTO-->
                <label for="titolo">Progetto di riferimento</label>
                <select class="form-control" name="pr_progetto" id="pr_progetto" placeholder="Progetto" value="progetto">
                    @forelse ($data['progetti_attivi'] as $progettoattivo)
                    <option value="{{ $progettoattivo['id'] }}">{{ $progettoattivo['nome'] }}</option>
                    @empty
                    <td class="text-center" colspan="6">Nessun progetto</td>
                    @endforelse
                </select>
                <!--FINE CHOICE BOX PROGETTO-->

                <br>
                <label for="file">File associato (omettere per mantenre invariato)</label>
                <input id="file" type="file" name="file" class="form-control"/>

              </form>
            </div>

            <div class="modal-footer d-flex justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
              <button type="submit" form="editPub" class="btn btn-primary">Modifica</button>
            </div>

          </div>
        </div>
      </div>

      <!-- Modal edit iscientific publication -->
      <div class="modal fade bd-example-modal-lg" id="editPSDialog" tabindex="-1" role="dialog"
        aria-labelledby="editPSDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h5 id="pstitle" class="modal-title" id="editPSDialogLabel">Modifica </h5><!--####-->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="form" method="POST" id="editSciPub" action="{{ route('modificaPubblicazioneScientifica') }}">
                @csrf
                <input id="psid" type="hidden" name="id" value=""><!--####-->

                <div class="bmd-form-group{{ $errors->has('titolo') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input id="pstitolo" type="text" name="titolo" class="form-control" placeholder="{{ __('Titolo pubblicazione scientifica...') }}"
                      value="" required><!--####-->
                  </div>
                  @if ($errors->has('titolo'))
                  <div id="titolo-error" class="error text-danger pl-3" for="titolo" style="display: block;">
                    <strong>{{ $errors->first('titolo') }}</strong>
                  </div>
                  @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('descrizione') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea id="psdescrizione" name="descrizione" class="form-control" placeholder="{{ __('Descrizione della pubblicazione...') }}"
                      required rows="5"></textarea><!--####-->
                  </div>
                  @if ($errors->has('descrizione'))
                  <div id="descrizione-error" class="error text-danger pl-3" for="descrizione" style="display: block;">
                    <strong>{{ $errors->first('descrizione') }}</strong>
                  </div>
                  @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('testo') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="testo">Testo</label>
                    <input id="pstesto" name="testo" class="form-control" placeholder="{{ __('Testo della pubblicazione...') }}"
                      required value=""><!--####-->
                  </div>
                  @if ($errors->has('testo'))
                  <div id="testo-error" class="error text-danger pl-3" for="testo" style="display: block;">
                    <strong>{{ $errors->first('testo') }}</strong>
                  </div>
                  @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('fonte') ? ' has-danger' : '' }}">
                  <div class="form-group">
                    <label for="fonte">Fonte</label>
                    <input id="psfonte" name="fonte" class="form-control" placeholder="{{ __('Fonte della pubblicazione...') }}"
                      required value=""><!--####-->
                  </div>
                  @if ($errors->has('fonte'))
                  <div id="fonte-error" class="error text-danger pl-3" for="fonte" style="display: block;">
                    <strong>{{ $errors->first('fonte') }}</strong>
                  </div>
                  @endif
                </div>

              </form>
            </div>

            <div class="modal-footer d-flex justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
              <button type="submit" form="editSciPub" class="btn btn-primary">Modifica</button>
            </div>

          </div>
        </div>
      </div>

    @endif
  @endauth


  @endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });

    function prefillPSDialog(id,titolo,descrizione,testo,fonte) {
      document.getElementById('pstitle').innerText = "Modifica di "+titolo;
      document.getElementById('psid').value = id;
      document.getElementById('pstitolo').value = titolo;
      document.getElementById('psdescrizione').value = descrizione;
      document.getElementById('pstesto').value = testo;
      document.getElementById('psfonte').value = fonte;
    }

    function prefillPRDialog(id,titolo,descrizione,testo,project) {
      document.getElementById('prtitle').innerText = "Modifica di "+titolo;
      document.getElementById('prid').value = id;
      document.getElementById('prtitolo').value = titolo;
      document.getElementById('prdescrizione').value = descrizione;
      document.getElementById('prtesto').value = testo;
      document.getElementById('pr_progetto').value = project
      document.getElementById('file').value = '';
      
    }
  </script>
@endpush
