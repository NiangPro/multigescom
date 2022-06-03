<div class="card mt-2 card-primary">
    <div class="card-header">
        <h4>
            Formulaire @if ($status ==="editProduct")
                de modification @else
                d'ajout
            @endif  produit / service</h4>
        <div class="card-header-action">
          <div class="btn-group">
              <button wire:click.prevent="changeEtat('listProduct')" class="btn btn-primary"><i class="fa fa-list"></i> Liste</button>
          </div>
        </div>
    </div>
    <div class="card-body container col-8 mt-0">
        <form wire:submit.prevent="store">
            <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Nom<span class="text-danger">*</span></div>
                  </div>
                  <input type="text" class="form-control @error('form.nom') is-invalid
                    @enderror" placeholder="Nom" wire:model="form.nom">
                    @error('form.nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Description<span class="text-danger">*</span></div>
                  </div>
                  <input type="text" class="form-control @error('form.description') is-invalid
                  @enderror" wire:model="form.description" placeholder="Description">
                    @error('form.description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Tarif<span class="text-danger">*</span></div>
                  </div>
                  <input type="number" min="1" class="form-control @error('form.tarif') is-invalid
                  @enderror" wire:model="form.tarif" placeholder="Tarif">
                    @error('form.tarif')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Type</label>
                    <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                            <input type="radio" name="type" value="Produit" class="selectgroup-input @error('form.type') is-invalid
                            @enderror" wire:model="form.type" checked>
                            <span class="selectgroup-button">Produit</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="type" value="Commercial" class="selectgroup-input @error('form.type') is-invalid
                            @enderror" wire:model="form.type">
                            <span class="selectgroup-button">Service</span>
                        </label>
                        @error('form.type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label for="">Taxe</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Taxe</div>
                        </div>
                        <select class="form-control @error('form.taxe') is-invalid
                            @enderror" wire:model="form.taxe" id="exampleFormControlSelect1">
                            <option value="Homme">Selectionner une taxe</option>
                            @foreach ($tva as $item)
                                <option value="{{$item->valeur}}">{{$item->valeur}}</option>
                            @endforeach
                        </select>
                        @error('form.taxe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button type="reset" class="btn btn-warning">Annuler</button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">
                    @if ($status ==="editProduct")
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
