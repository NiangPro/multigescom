    <div class="card card-primary">
        <div class="card-header">
            Formulaire d'ajout
        </div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Prenom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('employeForm.prenom') is-invalid @enderror" wire:model="employeForm.prenom">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control @error('employeForm.email') is-invalid @enderror" wire:model="employeForm.email">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Fonction <span class="text-danger">*</span></label>
                            <select class="form-control @error('employeForm.fonction') is-invalid @enderror" wire:model="employeForm.fonction" id="exampleFormControlSelect1">
                                @foreach ($staticData as $f)
                                    <option value="{{$f->id}}">{{$f->valeur}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sexe <span class="text-danger">*</span></label>
                            <select class="form-control @error('employeForm.sexe') is-invalid @enderror" wire:model="employeForm.sexe" id="exampleFormControlSelect1">
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('employeForm.nom') is-invalid @enderror" wire:model="employeForm.nom">
                        </div>
                        <div class="form-group">
                            <label for="">N° Telephone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('employeForm.tel') is-invalid @enderror" wire:model="employeForm.tel">
                        </div>
                        <div class="form-group">
                            <label for="">Adresse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('employeForm.adresse') is-invalid @enderror" wire:model="employeForm.adresse">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pays <span class="text-danger">*</span></label>
                            <select class="form-control @error('employeForm.pays') is-invalid @enderror" wire:model="employeForm.pays" id="exampleFormControlSelect1">
                                @foreach ($country as $c)
                                    <option value="{{$c->id}}">{{$c->nom_fr}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="reset" class="btn btn-danger">Anuler</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
