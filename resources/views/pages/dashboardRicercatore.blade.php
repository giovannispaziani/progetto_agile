
  <div class="content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">account_balance</i>
                  </div>
                  <p class="card-category">Budget allocabile</p>
                  <h3 class="card-title">€2500</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Scadenza milestone: 15 giugno
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">science</i>
                  </div>
                  <p class="card-category">Ricercatori</p>
                  <h3 class="card-title">6</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Aggiornato ora
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">article</i>
                  </div>
                  <p class="card-category">Tue pubblicazioni</p>
                  <h3 class="card-title">4</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">analytics</i> 1 pubblicazione restante
                  </div>
                </div>
              </div>
            </div>
          </div>

    <h2> I miei progetti: </h2>
    <div id="accordion" role="tablist">
  <!--Progetto attivi-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Progetti attivi
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Progetto #1
      </div>
    </div>
  </div>
  <!--Progetto conclusi-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Progetti conclusi
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Progetto #2
      </div>
    </div>
  </div>
  <!--Progetto eliminati-->
  <div class="card card-collapse">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Progetti eliminati
          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Progetto #3
      </div>
    </div>
  </div>

</div>


    </div>
  </div>


@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
