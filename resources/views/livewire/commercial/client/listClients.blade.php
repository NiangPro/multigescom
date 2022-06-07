<div class="card mt-2 card-primary">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Clients</strong></div>
        <div class="table-responsive">
            <table class="table table-hover" id="table-2">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>tel</th>
                    <th>email</th>
                    <th>Pays</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->adresse}}</td>
                        <td>{{$client->tel}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->pays->nom_fr}}</td>
                        <td>
                            <div class="d-flex">
                                <button  class="btn btn-icon btn-outline-info btn-sm" wire:click.prevent="getClient({{$client->id}})"><i class="far fa-eye"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-danger btn-sm  
                                trigger--fire-modal-1" wire:click.prevent="deleteClient({{$client->id}})" data-confirm-yes="remove()"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>

