@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Lista utenti')])

@section('content')
<div class="content">

  <div class="container-fluid">

    <div class="card card-nav-tabs" >
    <div class="card-header card-header-primary text-center"> UTENTI </div>

    <table class="table">
      <thead>
          <tr>
              <th></th>
              <th>Nome</th>
              <th>Email</th>
              <th>Ruolo</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($data as $user)
          <tr>
              <td></td>
              <td><a href="../users/{{ $user['id'] }}">{{ $user['nome'] }}</a></td>
              <td>{{ $user['email'] }}</td> 
              <td>{{ $user['ruolo'] }}</td> 
          </tr>
        @empty
          <tr>
              <td class="text-center" colspan="6">Nessun progetto trovato</td>
          </tr>
        @endforelse
      </tbody>

    </table>


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
