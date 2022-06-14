<div class="card mt-2 card-primary">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Réunions</strong></div>
        <div class="table-responsive">
            <table class="table table-hover" id="table-2">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reunions as $reunion)
                    <tr>
                        <td>{{$reunion->titre}}</td>
                        <td>{{date("d/m/Y à H:i", strtotime($reunion->date))}}</td>
                        <td>{{$reunion->description}}</td>
                        <td>
                            <div class="d-flex">
                                <button  class="btn btn-icon btn-outline-info btn-sm" wire:click.prevent="getReunion({{$reunion->id}})"><i class="far fa-eye"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-danger btn-sm
                                trigger--fire-modal-1" wire:click.prevent="delete({{$reunion->id}})" data-confirm-yes="remove()"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        {{-- calendar --}}
        <div class="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>


@section('js')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById("calendar")
    
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            // events:[
            //     reunions.map(function(element){
            //         return `{'
            //             'id'=>${element.id},
            //             'title'=>${element.titre},
            //             'start'=>${element.date},
            //         }`;
            //     })
            // ]
            events: [
                { id: '1', title: 'Event 1', start: '2022-06-14', resourceId: 'a' }
            ]
        })
        calendar.render()
      });

  </script>
@endsection