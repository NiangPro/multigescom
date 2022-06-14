<div>

    <section class="section">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa fa-user-secret" style="font-size: 45px; color:aliceblue"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Super Admin</h4>
                </div>
                <div class="card-body">
                  {{$dataSuperAdmin['nbreSuperAdmin']}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                  <i class="fa fa-building" style="font-size: 45px; color:aliceblue" aria-hidden="true"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Entreprises</h4>
                </div>
                <div class="card-body">
                  {{$dataSuperAdmin['nbreEntreprise']}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                <i class="fas fa-users-cog" style="font-size: 45px; color:aliceblue"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Admins</h4>
                </div>
                <div class="card-body">
                  {{$dataSuperAdmin['nbreAdmin']}}
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Statistics</h4>
                <div class="card-header-action">
                  <div class="btn-group">
                    <a href="#" class="btn btn-primary">Week</a>
                    <a href="#" class="btn">Month</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
          @include('livewire.superAdmin.users.todolist')
        </div>

      </section>
</div>
@section('js')
    <script>

    </script>
@endsection
