<div class="row">
    @foreach ($superAdmins as $sa)
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-primary">
          <div class="card-icon bg-primary">
            <img src="{{asset('storage/images/'.$sa->profil)}}"  alt="" class="avatar">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{$sa->prenom}}</h4>
            </div>
            <div class="card-body">
                <button  class="btn btn-icon btn-outline-success btn-sm" wire:click.prevent="info({{$sa->id}})"><i class="far fa-eye"></i></button>
                <button  class="btn btn-icon btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>

            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
