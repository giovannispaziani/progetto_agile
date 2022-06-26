@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Profilo Ricercatore')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">

          <div class="card card-nav-tabs" style="display: grid !important; grid-template-columns: auto auto !important;">

            <div class="card-header card-header-primary text-center" style="grid-column: 1/3 !important"> INFORMAZIONI RICERCATORE </div>

                  <div class="card-body">
                    <h4 class="card-title">Id utente:</h4>
                    <p class="card-text" >{{ $data['id'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Nome:</h4>
                    <p class="card-text" >{{ $data['name'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Cognome:</h4>
                    <p class="card-text" >{{ $data['surname'] }}</p>
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">Email:</h4>
                    <p class="card-text" >{{ $data['email'] }}</p>
                  </div>
      </div>

<!--TABELLA PROGETTI-->
<div class="card card-nav-tabs" style="grid-column: 1/3 !important">
  <div class="card-header card-header-primary text-center" style="padding: 0.3em"> I MIEI CONTRIBUTI</div>

  <table class="table" style="width: 90%; margin: 0 auto">

    <thead>
        <tr>
            <th>Titolo</th>
            <th>Progetto</th>
            <th>Sorgente</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($data['pubblicazioni_progetti'] as $pubblicazionepr)
        <tr>
            <td>{{ $pubblicazionepr['progetto'] }}</td>
            <td>{{ $pubblicazionepr['titolopr'] }}</td>
            <td>{{ $pubblicazionepr['fontepr'] }}</td> <!--DA SOSTITUIRE CON IL BOTTONE-->
        </tr>
      @empty
        <tr>
            <td class="text-center"><a href="#"></a></td>
            <td>Nessun</td>
            <td>contributo</td>
        </tr>
      @endforelse
    </tbody>

</table>

    </div>
  </div>

</div>

<!--TABELLA PUBBLICAZIONI SCIENTIFICHE-->
<div class="card card-nav-tabs" style="grid-column: 1/3 !important">
    <div class="card-header card-header-primary text-center" style="padding: 0.3em"> PUBBLICAZIONI SCIENTIFICHE</div>

    <table class="table" style="width: 90%; margin: 0 auto">

      <thead>
          <tr>
              <th>Titolo</th>
              <th>Fonte</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data['pubblicazioni_scientifiche'] as $pubblicazionesc)
          <tr>
              <td>{{ $pubblicazionesc['titolosc'] }}</td>
              <td>{{ $pubblicazionesc['fontesc'] }}</td>
          </tr>
        @empty
          <tr>
              <td class="text-center"><a href="#"></a></td>
              <td>Nessuna</td>
              <td>pubblicazione</td>
          </tr>
        @endforelse
      </tbody>

  </table>

      </div>
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