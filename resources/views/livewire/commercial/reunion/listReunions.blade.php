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
                {{-- @foreach ($reunions as $reunion)
                    <tr>
                        <td>{{$reunion->titre}}</td>
                        <td>{{$reunion->date}}</td>
                        <td>{{$reunion->description}}</td>
                        <td>
                            <div class="d-flex">
                                <button  class="btn btn-icon btn-outline-info btn-sm" wire:click.prevent="getClient({{$client->id}})"><i class="far fa-eye"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-danger btn-sm  
                                trigger--fire-modal-1" wire:click.prevent="deleteClient({{$client->id}})" data-confirm-yes="remove()"><i class="fa fa-trash"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-success btn-sm  
                                trigger--fire-modal-1" >Approuver</button>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
            </table>
        </div>
    </div>
</div>

