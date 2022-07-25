@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">store</i>
            </div>
            <p class="card-category">Budget</p>
              <h3 class="card-title">{{$data['budget']}} $</h3>
            </div>
            <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Last 24 Hours
            </div>
          </div>
        </div>
      </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">content_copy</i>
          </div>
          <p class="card-category">Pubblicazioni</p>
          <h3 class="card-title">{{$data['numeroPub']}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
          </div>
        </div>
      </div>
    </div>
  </div>


    @auth
    @if (Auth::user()->type == "Manager")

    <div class="d-flex justify-content-between">
      <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal"
        data-target="#deleteDialog">Elimina progetto</button>
      <button type="button" class="btn btn-default btn-round btn-sm" data-toggle="modal"
        data-target="#editDialog">Modifica</button>
        <a href="../sottoProgettiList/{{ $data['id_progetto'] }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Lista sottoprogetti</a>
        <a href="../aggiungiSottoprogetto/{{ $data['id_progetto'] }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Aggiungi sottoprogetto</a>
        <a href="../dashboard-budget/{{$data['id_progetto']}}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Modifica Budget</a>
    </div>

    @endif
    @endauth

    <div class="row">

      <!--TABELLA INFO-->
      <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">
        <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFO </div>

        <div class="card-body">
          <h4 class="card-title">Nome:</h4>
          <p class="card-text">{{ $data['nome'] }}</p>
        </div>

        <div class="card-body">
          <h4 class="card-title">Descrizione:</h4>
          <p class="card-text">{{ $data['descrizione'] }}</p>
        </div>

        <div class="card-body">
          <h4 class="card-title">Responsabile:</h4>
          <a href="../users/{{ $data['id_responsabile'] }}" class="card-text">{{ $data['responsabile'] }}</a>
        </div>

        <div class="card-body">
          <h4 class="card-title">Stato:</h4>
          <p class="card-text">{{ $data['stato'] }}</p>
        </div>

        <div class="card-body">
          <h4 class="card-title">Data inizio:</h4>
          <p class="card-text">{{ $data['data_inizio'] }}</p>
        </div>

        <div class="card-body">
          <h4 class="card-title">Data fine:</h4>
          <p class="card-text">{{ $data['data_fine'] }}</p>
          @auth
          @if (Auth::user()->id == $data['id_responsabile'])
          <!-- se aperta dal responsabile -->
          <button type="button" class="btn btn-default btn-round btn-sm" data-toggle="modal"
            data-target="#editEndingDate">Modifica</button>
          @endif
          @endauth
        </div>

      </div>
      <!--FINE TABELLA INFO-->

      <!--TABELLA FINANZIATORI-->
      <div class="card card-nav-tabs" style="width: 45%">
        <div class="card-header card-header-primary text-center"> FINANZIATORI </div>

        <table class="table" style="width: 90%">

          <thead>
            <tr>
              <th></th>
              <th>Nome</th>
              <th>Cognome</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data['finanziatori'] as $finanziatore)
            <tr>
              <td class="text-center"><a href="../users/{{ $finanziatore['id'] }}">&#10150;</a></td>
              <td>{{ $finanziatore['nome'] }}</td>
              <td>{{ $finanziatore['cognome'] }}</td>
            </tr>
            @empty
            <tr>
              <td class="text-center"><a href="#"></a></td>
              <td>nessun</td>
              <td>finanziatore</td>
            </tr>
            @endforelse
          </tbody>

        </table>

      </div>
      <!--FINE TABELLA FINANZIATORI-->

      <!--TABELLA RICERCATORI-->
      <div class="card card-nav-tabs" style="width: 45%; margin-left: 10%">
        <div class="card-header card-header-primary text-center"> RICERCATORI
        </div>
        <table class="table" style="width: 90%">

          <thead>
            <tr>
              <th></th>
              <th>Nome</th>
              <th>Cognome</th>
              @auth
                @if(Auth::user()->id == $data['id_responsabile'])
                  <th>aggiungi <a href="/lista-ricercatore/{{$data['id_progetto']}}">
                      <i class="material-icons">co_present</i>
                    </a>
                  </th>
                @endif
              @endauth
            </tr>
          </thead>
          <tbody>
            @forelse ($data['ricercatori'] as $ricercatore)
              <tr>
                <td class="text-center"><a href="../users/{{ $ricercatore['id'] }}">&#10150;</a></td>
                <td>{{ $ricercatore['nome'] }}</td>
                <td>{{ $ricercatore['cognome'] }}</td>
                @auth
                  @if(Auth::user()->id == $data['id_responsabile'])
                    <td><a href="/project-dashboard/{{$data['id_progetto']}}/remove/{{$ricercatore['id']}}"><button
                          class="btn btn-danger">Elimina</button></a></td>
                  @endif
                @endauth
              </tr>
            @empty
            <tr>
              <td class="text-center"><a href="#"></a></td>
              <td>nessun</td>
              <td>ricercatore</td>
            </tr>
            @endforelse
          </tbody>

        </table>

      </div>
      <!--FINE TABELLA RICERCATORI-->

      <!--TABELLA BUDGET-->
      <div class="card card-nav-tabs" style="width: 45%">
        <div class="card-header card-header-primary text-center"> BUDGET </div>

        <table class="table" style="width: 90%">

          <thead>
            <tr>
              <th></th>
              <th>scopo</th>
              <th>ammontare</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data['spese'] as $spesa)
            <tr>
              <td class="text-center"><a href="../budgets/{{ $spesa['id'] }}">&#10150;</a></td>
              <td> {{ $spesa['scopo'] }}</td>
              <td> {{ $spesa['budget'] }}</td>
              <td></td>
            </tr>
            @empty
            <tr>
              <td class="text-center"></td>
              <td>nessun</td>
              <td>budget</td>
            </tr>
            @endforelse
          </tbody>

        </table>

      </div>
      <!--FINE TABELLA BUDGET-->

      <!--TABELLA PUBBLICAZIONI-->
      <div class="card card-nav-tabs" style="width: 45%; margin-left: 10%">
        <div class="card-header card-header-primary text-center"> PUBBLICAZIONI </div>
        <table class="table" style="width: 90%">
          <thead>
            <tr>
              <th></th>
              <th>titolo</th>
              <th>autore</th>
              @auth
                @if(Auth::user()->id == $data['id_responsabile'])
                  <th></th>
                @endif
              @endauth
            </tr>
          </thead>
          <tbody>
            @forelse ($data['pubblicazioni'] as $pubblicazione)
              <tr>
                <td class="text-center"><a href="../pubblicazioni/{{ $pubblicazione['id'] }}">&#10150;</a></td>
                <td>{{ $pubblicazione['titolo'] }}</td>
                <td>{{ $pubblicazione['autore'] }}</td>
                @auth
                  @if(Auth::user()->id == $data['id_responsabile'])
                    <td>
                      <form class="form" method="POST" id="changeDate" action="{{ route('elimina-pubblicazione-da-progetto') }}">
                        @csrf
                        <input type="hidden" name="id_pubblicazione" value="{{ $pubblicazione['id'] }}">
                        <input type="hidden" name="id_progetto" value="{{ $data['id_progetto'] }}">
                        <button type="submit" class="btn btn-danger del-pubblicazione">Elimina</button>
                      </form>
                    </td>
                  @endif
                @endauth
              </tr>
            @empty
              <tr>
                <td class="text-center"><a href="#"></a></td>
                <td>nessuna</td>
                <td>pubblicazione</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!--FINE TABELLA PUBBLICAZIONI-->

      <!--TABELLA SOTTOPROGETTI-->
      <!--<div class="card card-nav-tabs" >
        <div class="card-header card-header-primary text-center"> SOTTOPROGETTI </div>
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Nome</th>
              <th>Cognome</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">1</td>
              <td>Andrew Mike</td>
              <td>Develop</td>
            </tr>
            <tr>
              <td class="text-center">2</td>
              <td>John Doe</td>
              <td>Design</td>
            </tr>
          </tbody>
        </table>
      </div> -->
      <!--FINE TABELLA SOTTOPROGETTI-->

      <!--TABELLA ENTI-->
      <!--<div class="card card-nav-tabs" >
        <div class="card-header card-header-primary text-center"> ENTI </div>
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Nome</th>
              <th>Cognome</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">1</td>
              <td>Andrew Mike</td>
              <td>Develop</td>
            </tr>
            <tr>
              <td class="text-center">2</td>
              <td>John Doe</td>
              <td>Design</td>
            </tr>
          </tbody>
        </table>
      </div> -->
      <!--FINE TABELLA ENTI-->

    </div>
  </div>


  <!-- Modal edit ending date -->
  @auth
  @if (Auth::user()->id == $data['id_responsabile'])
  <!-- se aperta dal responsabile -->
  <div class="modal fade" id="editEndingDate" tabindex="-1" role="dialog" aria-labelledby="editEndingDateLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifica data di fine</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form" method="POST" id="changeDate" action="{{ route('update-project-date') }}">
            @csrf

            <div class="bmd-form-group{{ $errors->has('fine') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="fine">Fine stimata</label>
                <input type="date" name="fine" class="form-control"
                  placeholder="{{ __('Data stimata di fine progetto...') }}" value="{{ $data['data_fine'] }}" required>
              </div>
              @if ($errors->has('fine'))
              <div id="fine-error" class="error text-danger pl-3" for="fine" style="display: block;">
                <strong>{{ $errors->first('fine') }}</strong>
              </div>
              @endif
            </div>

            <input type="hidden" name="id_progetto" value="{{ $data['id_progetto'] }}">

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <button type="submit" form="changeDate" class="btn btn-primary">Modifica data</button>
        </div>

      </div>
    </div>
  </div>
  @endif

  @if (Auth::user()->type == "Manager")

  <!-- Modal delete project -->
  <div class="modal fade bd-example-modal-sm" id="deleteDialog" tabindex="-1" role="dialog"
    aria-labelledby="deleteDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="deleteDialogLabel">Eliminare il progetto?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULLA</button>
          <button type="submit" form="deleteProject" class="btn btn-danger">ELIMINA</button>
        </div>

        <form class="form" method="POST" id="deleteProject" action="{{ route('elimina-progetto') }}">
          @csrf
          <input type="hidden" name="id_progetto" value="{{ $data['id_progetto'] }}">
        </form>

      </div>
    </div>
  </div>


  <!-- Modal edit info project -->
  <div class="modal fade bd-example-modal-lg" id="editDialog" tabindex="-1" role="dialog"
    aria-labelledby="editDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editDialogLabel">Modifica progetto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form class="form" method="POST" id="editProject" action="{{ route('modifica-progetto') }}">
            @csrf
            <input type="hidden" name="id_progetto" value="{{ $data['id_progetto'] }}">

            <div class="bmd-form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="{{ __('Nome progetto...') }}"
                  value="{{ $data['nome'] }}" required>
              </div>
              @if ($errors->has('nome'))
              <div id="nome-error" class="error text-danger pl-3" for="nome" style="display: block;">
                <strong>{{ $errors->first('nome') }}</strong>
              </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('descrizione') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="descrizione">Descrizione</label>
                <textarea name="descrizione" class="form-control" placeholder="{{ __('Descrizione del progetto...') }}"
                  required rows="5">{{ $data['descrizione'] }}</textarea>
              </div>
              @if ($errors->has('descrizione'))
              <div id="descrizione-error" class="error text-danger pl-3" for="descrizione" style="display: block;">
                <strong>{{ $errors->first('descrizione') }}</strong>
              </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('inizio') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="inizio">Inizio</label>
                <input type="date" name="inizio" class="form-control" placeholder="{{ __('Data inizio progetto...') }}"
                  value="{{ $data['data_inizio'] }}" required>
              </div>
              @if ($errors->has('inizio'))
              <div id="inizio-error" class="error text-danger pl-3" for="inizio" style="display: block;">
                <strong>{{ $errors->first('inizio') }}</strong>
              </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('fine') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="fine">Fine stimata</label>
                <input type="date" name="fine" class="form-control"
                  placeholder="{{ __('Data stimata di fine progetto...') }}" value="{{ $data['data_fine'] }}" required>
              </div>
              @if ($errors->has('fine'))
              <div id="fine-error" class="error text-danger pl-3" for="fine" style="display: block;">
                <strong>{{ $errors->first('fine') }}</strong>
              </div>
              @endif
            </div>

            <label for="stato">Stato</label>
            <select class="form-control" name="stato" id="stato">
              <option value="in corso" {{ ($data['stato']=="in corso" )? "default" : "" }}>in corso</option>
              <option value="concluso" {{ ($data['stato']=="concluso" )? "default" : "" }}>concluso</option>
              <option value="cancellato" {{ ($data['stato']=="cancellato" )? "default" : "" }}>cancellato</option>
            </select>

            <label for="responsabile">Responsabile</label>
            <select class="form-control" name="responsabile" id="responsabile">
              @foreach ($data['users'] as $user)
              @if($data['id_responsabile'] == $user->id)
              <option value={{ $user->id }} default>{{ $user->name." ".$user->surname }}</option>
              @else
              <option value={{ $user->id }}>{{ $user->name." ".$user->surname }}</option>
              @endif
              @endforeach
            </select>

          </form>
        </div>

        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulle</button>
          <button type="submit" form="editProject" class="btn btn-primary">Modifica</button>
        </div>

      </div>
    </div>
  </div>

  @endif
  @endauth


  @endsection

  @push('js')
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
  @endpush
