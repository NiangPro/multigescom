<div class="card mt-2 card-primary">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Tâches</strong></div>
        <div class="table-responsive">
            <table class="table table-hover" id="table-2">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Assignation</th>
                    <th>Date début</th>
                    <th>Date Fin</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($taches as $tache)
                    <tr>
                        <td>{{$tache->titre}}</td>
                        <td>{{$tache->assignation}}</td>
                        <td>{{$tache->dateDebut}}</td>
                        <td>{{$tache->dateFin}}</td>
                        <td>{{$tache->priorite}}</td>
                        <td>{{$tache->statut}}</td>
                        <td>
                            <div class="d-flex">
                                <button  class="btn btn-icon btn-outline-info btn-sm" wire:click.prevent="getReunion({{$tache->id}})"><i class="far fa-eye"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-danger btn-sm  
                                trigger--fire-modal-1" wire:click.prevent="delete({{$tache->id}})" data-confirm-yes="remove()"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
            </table>
        </div>
    </div>
</div>

