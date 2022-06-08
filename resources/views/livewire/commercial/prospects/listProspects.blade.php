<div class="card mt-2 card-primary">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Prospects</strong></div>
        <div class="table-responsive">
            <table class="table table-hover" id="table-2">
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Source</th>
                    <th>Assigné à</th>
                    <th>Pays</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($prospects as $pros)
                    <tr>
                        <td>{{$pros->sujet}}</td>
                        <td>{{$pros->source}}</td>
                        <td>{{$pros->tel}}</td>
                        <td>{{$pros->email}}</td>
                        <td>{{$pros->pays->nom_fr}}</td>
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

