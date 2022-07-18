@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Aggiungi sottoprogetto')])

@section('content')
  <div class="content">
    <div class="container-fluid">


    <form class="form" method="POST" action="{{ route('aggiungiSottoprogetto-post') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">

          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>Aggiungi sottoprogetto</strong></h4>
            <div class="social-line">
            </div>
          </div>


          <div class="card-body ">

                    <!--CHOICE BOX PROGETTO-->
                    <label for="progetto"></label>
                        <input type = "hidden" name="id_progetto" id="id_progetto" value="{{ $data['id_progetto'] }}">
                    <!--FINE CHOICE BOX PROGETTO-->

            <label for="responsabile">Responsabile sottoprogetto</label>
            <select class="form-control" name="responsabile" id="responsabile">
              @foreach ($data['users'] as $user)
              <option value={{ $user->id }}>{{ $user->name." ".$user->surname }}</option>
              @endforeach
            </select>

            <div class="bmd-form-group{{ $errors->has('titolo') ? ' has-danger' : '' }}">
                <div class="form-group">
                  <label for="titolo">Titolo</label>
                  <input type="text" name="titolo" class="form-control" placeholder="{{ __('Titolo sottoprogetto...') }}" value="{{ old('titolo') }}" required>
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
                <textarea name="descrizione" class="form-control" placeholder="{{ __('Descrizione del sottoprogetto...') }}" value="{{ old('descrizione') }}" required rows="5"></textarea>
              </div>
              @if ($errors->has('descrizione'))
                <div id="descrizione-error" class="error text-danger pl-3" for="descrizione" style="display: block;">
                  <strong>{{ $errors->first('descrizione') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('fine') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="fine">Scadenza</label>
                <input type="date" name="fine" class="form-control" placeholder="{{ __('Scadenza sottoprogetto...') }}" value="{{ old('fine') }}" required>
              </div>
              @if ($errors->has('fine'))
                <div id="fine-error" class="error text-danger pl-3" for="fine" style="display: block;">
                  <strong>{{ $errors->first('fine') }}</strong>
                </div>
              @endif
            </div>

          </div>


          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">Crea sottoprogetto</button>
          </div>

        </div>
      </form>


    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
