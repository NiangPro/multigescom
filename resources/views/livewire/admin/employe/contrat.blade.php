<div class="card card-primary mt-3">
    <div class="card-header">
        <h4>
            @if ($etat === "info")
                Document(s) personnel(s)
            @endif
        </h4>
        <div class="card-header-action">
            <div class="btn-group">
                <button wire:click.prevent="changeStatut('info')" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button>
                <button wire:click.prevent="changeStatut('add')" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
            </div>
        </div>
<<<<<<< HEAD
=======
=======
        <span class="btn-add">
            <button wire:click.prevent="changeStatut('info')" class="btn back-info btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button>
                &nbsp;
            <button wire:click.prevent="changeStatut('add')" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
        </span>
>>>>>>> 3c5c504ded4878bef48dcb79cd6266e45b907cb4
>>>>>>> d742475f1d574de4c4170d54eef3f386f1c4c1cd
    </div>
    @if ($showDoc)
            <div id="message" class="container col-sm-8 text-center alert alert-info alert-dismissible fade show" role="alert">
                <strong>Voulez-vous vraiment supprimer ce document</strong>
                <span class="float-right mt-n1">
                    <button wire:click.prevent="removeDocument" class="btn btn-danger btn-sm"  data-dismiss="alert" aria-label="Close">Oui</button>&nbsp;&nbsp;
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">Non</button>
                </span>
            </div>
        @endif
    <div class="card-body mt-2 mb-2">
        <div class="row">
            @foreach ($this->current_employe->contrats as $contrat)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 card-primary">
                      <div class="card-icon ">
                        <img src="storage/images/file.png" alt="" height="80" width="80">
                      </div>
                      <div class="card-wrap">
                        <div class="card-header">
                            <span style="display: flex; flex-direction: column; left:3px;">
                                <a target="_blank" href="storage/contrats/{{$contrat->fichier}}" class="btn mb-1 btn-icon btn-outline-success btn-sm" title="Ouvrir"><i class="fa fa-eye left-eye"></i></a>
                                <button wire:click.prevent="deleteDocument({{$contrat->id}})"
                                 class="btn btn-icon btn-outline-danger btn-sm" title="Supprimer"><i class="fa fa-trash left-i"></i></button>
                            </span>
                        </div>
                        <hr>
                        <div class="card-body pt-2">
                            <h6 class="text-center mt-n3 mb-2">{{Str::substr($contrat->titre, 0, 11) }} @if (strlen($contrat->titre)> 8)
                                ...
                            @endif</h6>
                        </div>
                      </div>
                    </div>
                </div>

            @endforeach
            @if (count($this->current_employe->contrats) <= 0)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <span class="text-center text-danger">Aucune données </span>
                </div>
            @endif
            
        </div>
    </div>
</div>
