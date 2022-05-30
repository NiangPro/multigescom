    <div class="card card-primary mt-3">
        <div class="card-header">
            <h4>Formulaire d'ajout employé</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Prenom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('form.prenom') is-invalid @enderror" wire:model="form.prenom">
                            @error('form.prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('form.nom') is-invalid @enderror" wire:model="form.nom">
                            @error('form.nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control @error('form.email') is-invalid @enderror" wire:model="form.email">
                            @error('form.email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">N° Telephone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('form.tel') is-invalid @enderror" wire:model="form.tel">
                            @error('form.tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sexe <span class="text-danger">*</span></label>
                            <select class="form-control @error('form.sexe') is-invalid @enderror" wire:model="form.sexe" id="exampleFormControlSelect1">
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                            @error('form.sexe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Adresse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('form.adresse') is-invalid @enderror" wire:model="form.adresse">
                            @error('form.adresse') <span class="error text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Fonction <span class="text-danger">*</span></label>
                            <select class="form-control @error('form.fonction') is-invalid @enderror" wire:model="form.fonction" id="exampleFormControlSelect1">
                                @foreach ($staticData as $f)
                                    <option value="{{$f->id}}">{{$f->valeur}}</option>
                                @endforeach
                            </select>
                            @error('form.fonction') <span class="error text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pays <span class="text-danger">*</span></label>
                            <select class="form-control @error('form.pays') is-invalid @enderror" wire:model="form.pays" id="exampleFormControlSelect1">
                                @foreach ($country as $c)
                                    <option value="{{$c->id}}">{{$c->nom_fr}}</option>
                                @endforeach
                            </select>
                            @error('form.pays') <span class="error text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="align-items-end">
                            <button type="reset" class="btn btn-danger">Anuler</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
