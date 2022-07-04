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
                <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>
          @include('livewire.superAdmin.users.todolist')
        </div>

      </section>
</div>
@section('js')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    </script>
@endsection
