<div>
  <button  wire:click.prevent="changeEtat"  class="btn btn-success mb-2" >@if($etat==="list")<i class="fa fa-plus" aria-hidden="true"></i> Ajout @else<i class="fa fa-list" aria-hidden="true"></i> Liste @endif</button>
    @if ($etat === "list")
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-lg-4">
            <div class="card author-box card-primary">
              <div class="card-body">
                <div class="author-box-left">
                  <img alt="image" src="{{asset('storage/images/user-male.png')}}" class="rounded-circle author-box-picture">
                  <div class="clearfix mb-2"></div>
                  <button class="btn btn-outline-success btn-sm btn-rounded"><i class="fa fa-eye" aria-hidden="true"></i></button>
                  <button class="btn btn-outline-danger btn-sm btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
                <div class="author-box-details">
                  <div class="author-box-name">
                    <a href="#">Hasan Basri</a>
                </div>
                <div class="author-box-job">Web Developer</div>
                <div class="author-box-description">
                    <p>
                        <i class="fa fa-phone" aria-hidden="true"></i> 77 777 77 77 <br>
                    </p>
                  </div>
                  <div class="w-100 d-sm-none"></div>
                  <div class="float-right mt-sm-0 mt-3">

                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    @elseif($etat === "add")
            @include('livewire.admin.employe.add')
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
        title: 'Utilisateur',
        message: 'Mis à jour avec succes',
        position: 'topRight'
        });
    });

</script>

@endsection
