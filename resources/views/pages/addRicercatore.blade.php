@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard progetto')])

@section('content')
<div class="content">

  <div class="container-fluid">

        <div class="row">

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
                  </tr>
              </thead>
              <tbody>
                @forelse ($ricercatori as $ricercatore)
                  <tr>
                    <td class="text-center">">&#10150;</a></td>
                    <td>{{ $ricercatore['nome'] }}</td>
                    <td>{{ $ricercatore['cognome'] }}</td>
                    <td><a href="/project-dashboard/{{$id_progetto}}/add-ricercatore/{{$ricercatore['id']}}"><button>aggiungi</button></a></td>
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
      </div>
    </div>  
</div>
@endsection