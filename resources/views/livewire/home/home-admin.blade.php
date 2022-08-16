<div>
    @if (date('Y-m-d',strtotime($today)) >= date('Y-m-d'))
      <div class="container col-md-10 ">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <h6><marquee>Votre abonnement prendra fin le {{date("d/m/Y", strtotime(Auth()->user()->entreprise->fermeture))}}, Veuillez renouveller votre abonnement.</marquee>
          <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></h6>
        </div>
      </div>
    @elseif (date('Y-m-d',strtotime(Auth::user()->entreprise->fermeture)) <= date('Y-m-d'))
      <div class="container col-md-10 ">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><marquee>Votre abonnement est terminé  le {{date("d/m/Y", strtotime(Auth()->user()->entreprise->fermeture))}}, Veuillez renouveller votre abonnement. D'ici {{$dayleft}} jour(s) votre espace sera fermé.</marquee>
            <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></h6>
          </div>
      </div>
    @endif
    <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-cart-arrow-down" style="font-size: 45px; color:aliceblue"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Vente</h4>
                    </div>
                    <div class="card-body">
                        {{$dataAdmin['nbreVente']}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                      <i class="fas fa-file-invoice" style="font-size: 45px; color:aliceblue" aria-hidden="true"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Devis</h4>
                    </div>
                    <div class="card-body">
                        {{$dataAdmin['nbreDevis']}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-info">
                    <i class="fas fa-users" style="font-size: 45px; color:aliceblue"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Clients</h4>
                    </div>
                    <div class="card-body">
                      {{$dataAdmin['nbreClient']}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="fab fa-product-hunt" style="font-size: 45px; color:aliceblue"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Produits</h4>
                    </div>
                    <div class="card-body">
                      {{$dataAdmin['nbreProduit']}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                              <h4>Rapport annuel des ventes et dépenses</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChartline" width="949" height="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="row">
                  <div class="col-sm py-2">
                      <div class="card">
                          <div class="card-header">
                              <h4>Dernières activitées</h4>
                          </div>
                        <div class="card-body">
                              <ul class="timeline">
                                  @foreach ($historiques as $item)
                                      <li>
                                          <a href="#">{{$item->description}}</a>
                                          <p>Le {{date("d/m/Y à H:i", strtotime($item->date))}}</p>
                                      </li>
                                  @endforeach
                              </ul>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        {{-- calendar --}}

            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <div class="card">
                  <div class="card-body">
                    <div id='calendar'></div>
                  </div>
              </div>
            </div>
        </div>
</div>
@section('js')
    <script>
      var ctv = document.getElementById('myChartline').getContext('2d');
    var myChart = new Chart(ctv, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [
            {
                label: 'Ventes',
                data: JSON.parse(`<?php echo $allVentes; ?>`),
                backgroundColor:'lightgreen',
                borderColor: 'green',
                borderWidth: 1,
            },{
                label: 'Depenses',
                data: JSON.parse(`<?php echo $allDepenses; ?>`),
                backgroundColor:'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
            }
        ]},
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });

    document.addEventListener('DOMContentLoaded', function () {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev next today',
                    center: 'title',
                    right: 'dayGridMonth timeGridWeek'
                },
                locale: 'fr',
            });
            calendar.render();
        });
    window.addEventListener('addSuccessful', event =>{
        iziToast.success({
        title: 'A faire',
        message: 'Ajout avec succes',
        position: 'topRight'
        });
    });

    window.addEventListener('updateSuccessful', event =>{
        iziToast.success({
        title: 'A faire',
        message: 'Mis à jour avec succes',
        position: 'topRight'
        });
    });
    </script>
@endsection
