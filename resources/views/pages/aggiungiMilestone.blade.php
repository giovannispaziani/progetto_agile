@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Aggiungi Milestone')])

@section('content')
  <div class="content">
    <div class="container-fluid">


    <form class="form" method="POST" action="{{ route('aggiungiMilestone-post') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">

          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>Aggiungi milestone</strong></h4>
            <div class="social-line">
            </div>
          </div>


          <div class="card-body ">

                    <!--CHOICE BOX SOTTOPROGETTO-->
                    <label for="progetto"></label>
                        <input type = "hidden" name="id_sottoprogetto" id="id_sottoprogetto" value="{{ $data['id_sottoprogetto'] }}">
                    <!--FINE CHOICE BOX SOTTOPROGETTO-->

            <div class="bmd-form-group{{ $errors->has('titolo') ? ' has-danger' : '' }}">
                <div class="form-group">
                  <label for="titolo">Titolo</label>
                  <input type="text" name="titolo" class="form-control" placeholder="{{ __('Titolo milestone...') }}" value="{{ old('titolo') }}" required>
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
                <textarea name="descrizione" class="form-control" placeholder="{{ __('Descrizione milestone...') }}" value="{{ old('descrizione') }}" required rows="5"></textarea>
              </div>
              @if ($errors->has('descrizione'))
                <div id="descrizione-error" class="error text-danger pl-3" for="descrizione" style="display: block;">
                  <strong>{{ $errors->first('descrizione') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('data') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="data">Data</label>
                <input type="date" name="data" class="form-control" placeholder="{{ __('Data evento...') }}" value="{{ old('data') }}" required>
              </div>
              @if ($errors->has('data'))
                <div id="fine-error" class="error text-danger pl-3" for="data" style="display: block;">
                  <strong>{{ $errors->first('data') }}</strong>
                </div>
              @endif
            </div>

          </div>


          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">Pubblica</button>
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
