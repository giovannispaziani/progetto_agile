@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Creazione progetto')])

@section('content')
  <div class="content">
    <div class="container-fluid">


    <form class="form" method="POST" action="{{ route('project-create-post') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">



          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>Creazione progetto</strong></h4>
            <div class="social-line">
            </div>
          </div>


          <div class="card-body ">

            <div class="bmd-form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="{{ __('Nome progetto...') }}" value="{{ old('nome') }}" required>
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
                <textarea name="descrizione" class="form-control" placeholder="{{ __('Descrizione del progetto...') }}" value="{{ old('descrizione') }}" required rows="5"></textarea>
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
                <input type="date" name="inizio" class="form-control" placeholder="{{ __('Data inizio progetto...') }}" value="{{ old('inizio') }}" required>
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
                <input type="date" name="fine" class="form-control" placeholder="{{ __('Data stimata di fine progetto...') }}" value="{{ old('fine') }}" required>
              </div>
              @if ($errors->has('fine'))
                <div id="fine-error" class="error text-danger pl-3" for="fine" style="display: block;">
                  <strong>{{ $errors->first('fine') }}</strong>
                </div>
              @endif
            </div>

          </div>


          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">Crea progetto</button>
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
