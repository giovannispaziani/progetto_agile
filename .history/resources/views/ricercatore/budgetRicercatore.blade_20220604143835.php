@extends('layouts.ricercatore.appRicercatore', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Richieste budget</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Progetto
                  </th>
                  <th>
                    Motivo
                  </th>
                  <th>
                    Stato
                  </th>
                  <th>
                    Importo
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      Progetto #1
                    </td>
                    <td>
                      Tools
                    </td>
                    <td>
                      In attesa
                    </td>
                    <td class="text-primary">
                      €500
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      Progetto #1
                    </td>
                    <td>
                      Curaçao
                    </td>
                    <td>
                      Licenza
                    </td>
                    <td class="text-primary">
                      €350
                    </td>
                  </tr>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                        Progetto #1
                    </td>
                    <td>
                      Netherlands
                    </td>
                    <td>
                      Rifiutato
                    </td>
                    <td class="text-primary">
                      €1000
                    </td>
                  </tr>
                  <tr>
                </tbody>
              </table>
            </div>
          </div>
@endsection
