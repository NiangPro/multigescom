<div class="card mt-2 card-primary">
    <div class="card-header">
        <h4>
            Formulaire 
            @if ($etat ==="info")
                de modification depense
             @else
                d'ajout depense
            @endif</h4>
        <div class="card-header-action">
          <div class="btn-group">
              <button wire:click.prevent="changeEtat('list')" class="btn btn-primary"><i class="fa fa-list"></i> Liste</button>
          </div>
        </div>
    </div>
    <div class="card-body container col-md-10 mt-0">
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Categorie</div>
                            </div>
                            <select class="form-control @error('form.categorie') is-invalid @enderror"  wire:model="form.categorie">
                                <option value="">Selectionner un catégorie</option>
                                @foreach ($categories as $f)
                                    <option value="{{$f->valeur}}">{{$f->valeur}}</option>
                                @endforeach
                            </select>
                            @error('form.entreprise_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Mode de paiement</div>
                            </div>
                            <select class="form-control @error('form.mode_paiement') is-invalid @enderror"  wire:model="form.mode_paiement">
                                <option value="">Selectionner un mode de paiement</option>
                                @foreach ($paiements as $f)
                                    <option value="{{$f->valeur}}">{{$f->valeur}}</option>
                                @endforeach
                            </select>
                            @error('form.entreprise_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Date<span class="text-danger">*</span></div>
                          </div>
                          <input type="date" class="form-control @error('form.date') is-invalid
                            @enderror" wire:model="form.date">
                            @error('form.date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Montant<span class="text-danger">*</span></div>
                          </div>
                          <input type="text" class="form-control @error('form.montant') is-invalid
                            @enderror" placeholder="Montant" wire:model="form.montant">
                            @error('form.montant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Description</div>
                            </div>
                            <textarea placeholder="Description" class="form-control @error('form.description') is-invalid
                            @enderror" wire:model="form.description"></textarea>
                            {{-- @error('form.description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button type="reset" class="btn btn-warning">Annuler</button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">
                    @if ($etat ==="info")
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
