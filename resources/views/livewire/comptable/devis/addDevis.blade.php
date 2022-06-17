<div class="card mt-2 card-primary">
    <div class="card-header">
        <h4>
            Formulaire 
            @if ($etat ==="info")
                de modification dévis
             @else
                d'ajout dévis
            @endif</h4>
        <div class="card-header-action">
          <div class="btn-group">
              <button wire:click.prevent="changeEtat('list')" class="btn btn-primary"><i class="fa fa-list"></i> Liste</button>
          </div>
        </div>
    </div>
    <div class="card-body container mt-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="wizard-steps text-center">
                    <a class="wizard-step {{ $currentStep != 1 ? 'step1' : 'wizard-step-active' }}">
                        <div class="wizard-step-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="wizard-step-label">
                            Information du devis
                        </div>
                    </a>
                    <a class="wizard-step {{ $currentStep != 2 ? 'step2' : 'wizard-step-active' }}">
                        <div class="wizard-step-icon">
                          <i class="fas fa-file"></i>
                        </div>
                        <div class="wizard-step-label">
                          Bon de commande
                        </div>
                    </a>      
                </div>
            </div>
        </div>
          <form class="wizard-content mt-2">
            @if ($currentStep === 1)   
                <div class="wizard-pane">
                <div class="form-group row align-items-center">
                    <label class="col-md-4 text-md-right text-left">Name</label>
                    <div class="col-lg-4 col-md-6">
                    <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-md-4 text-md-right text-left">Email</label>
                    <div class="col-lg-4 col-md-6">
                    <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4"></div>
                    <div class="col-lg-4 col-md-6 text-right">
                        <button type="button" class="btn btn-icon icon-right btn-primary" wire:click="firstStepSubmit">Suivant <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endif
            @if ($currentStep === 2)   
                <div class="wizard-pane">
                    <div class="form-group row align-items-center">
                        <label class="col-md-4 text-md-right text-left">Prenom</label>
                        <div class="col-lg-4 col-md-6">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-md-4 text-md-right text-left">Nom</label>
                        <div class="col-lg-4 col-md-6">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-lg-4 col-md-6 text-right">
                            <button class="btn btn-icon icon-right btn-warning ml-2" type="button" wire:click="back(1)"><i class="fas fa-arrow-left"></i> Retour</button>
                            <button  class="btn btn-icon icon-right btn-success">Ajouter <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            @endif
          </form>

    </div>
</div>
