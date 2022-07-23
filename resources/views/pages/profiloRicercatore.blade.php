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
                <td><button class="btn btn-default">Modifica</button></td>
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
                  <td><button class="btn btn-default">Modifica</button></td>
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
  @endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
