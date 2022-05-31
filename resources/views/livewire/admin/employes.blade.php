<div>
  <button  wire:click.prevent="changeEtat()"  class="btn btn-success mb-2" >@if($etat==="list")<i class="fa fa-plus" aria-hidden="true"></i> Ajout @else<i class="fa fa-list" aria-hidden="true"></i> Liste @endif</button>
    @if ($etat === "list")
      <div class="row mt-3">
        @foreach ($employes as $item)
          <div class="col-12 col-sm-12 col-lg-4">

              <div class="card author-box card-primary">
                <div class="card-body">
                  <div class="author-box-left">
                    <img alt="image" height="98" width="104" src="{{asset('storage/images/'.$item->profil)}}" class="rounded-circle author-box-picture">
                    <div class="clearfix mb-2"></div>
                    <button  wire:click.prevent="getEmploye({{$item->id}})" class="btn btn-outline-success btn-sm btn-rounded"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    <div class="d-inline" x-data="{ confirmDelete:false }">
                      <button x-show="!confirmDelete" x-on:click="confirmDelete=true" class="btn btn-outline-danger btn-sm btn-rounded">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    
                       <button x-show="confirmDelete" x-on:click="confirmDelete=false" wire:click.prevent="deleteEmploye({{$item->id}})"
                          class="btn btn-success btn-xs">Oui</button>
                                                              
                       <button x-show="confirmDelete" x-on:click="confirmDelete=false"
                        class="btn btn-danger btn-xs">Non</button>
                    </div>
                  </div>
                  <div class="author-box-details">
                    <div class="author-box-name">
                      <a href="#">{{$item->prenom}} {{$item->nom}}</a>
                  </div>
                  <div class="author-box-job">{{$item->fonction}}</div>
                  <div class="author-box-description">
                      <p>
                          <i class="fa fa-phone" aria-hidden="true"></i> {{$item->tel}} <br>
                      </p>
                    </div>
                    <div class="w-100 d-sm-none"></div>
                    <div class="float-right mt-sm-0 mt-3">
                    </div>
                  </div>
                </div>
              </div>
          </div>
        @endforeach
      </div>
    @elseif($etat === "add")
      @include('livewire.admin.employe.add')
    @elseif($etat === "info") 
      @include('livewire.admin.employe.info')
    @endif
</div>

@section('js')
<script>


    window.addEventListener('addSuccessful', event =>{
        iziToast.success({
        title: 'Employé',
        message: 'Ajout avec succes',
        position: 'topRight'
        });
    });

    window.addEventListener('updateSuccessful', event =>{
        iziToast.success({
        title: 'Employé',
        message: 'Mis à jour avec succes',
        position: 'topRight'
        });
    });

</script>

@endsection
