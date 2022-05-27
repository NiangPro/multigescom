
<div class="row">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Vouliez-vous supprimer ?
            </div>
            <div class="modal-footer">
                <button   class="btn btn-success" wire:click="delete">Oui</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
            </div>
        </div>
        </div>
    </div>
    @foreach ($companies as $company)
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-primary">
          <div class="card-icon ">
            <img src="{{asset('storage/images/'.$company->profil)}}" alt="" height="80" width="80">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{Str::substr($company->nom, 0, 11) }} @if (strlen($company->nom)> 8)
                  ...
              @endif</h4>
            </div>
            <div class="card-body pt-2">
                <button  class="btn btn-icon btn-outline-success btn-sm" title="Info"  wire:click.prevent="info({{$company->id}})"><i class="far fa-eye"></i></button>
                @if ($company->statut === 1)
                    <button  class="btn btn-icon btn-outline-success btn-sm" title="Fermer"  wire:click.prevent="closeOrOpen({{$company->id}})"><i class="fa fa-lock-open"></i></button>
                @else
                    <button  class="btn btn-icon btn-outline-warning btn-sm" title="Ouvrir"   wire:click.prevent="closeOrOpen({{$company->id}})"><i class="fa fa-lock"></i></button>
                @endif
                <button  class="btn btn-icon btn-outline-danger btn-sm" wire:click.prevent="delete({{$company->id}})"  title="Supprimer"><i class="fa fa-trash"></i></button>

            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
