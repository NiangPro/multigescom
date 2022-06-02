<div class="card card-primary mt-3">
    <div class="card-header">
        <h4>
            @if ($etat === "info")
                Document(s) personnel(s)
            @endif
        </h4>
    </div>
    <div class="card-body mt-2 mb-2">
        <div class="row">
            <div class="col-md-3">
                <div class="card-file">
                    <button type="button" class="btn float-right f-delete btn-outline-danger btn-sm btn-rounded">
                        <i class="fa fa-trash" aria-hidden="true"></i></button>
                    <div class="align-self-center halfway-fab text-center i-file">
                        <a type="button" class="profile-image">
                            <img src="storage/imageS/file.png" alt="" width="120" height="150">
                            <div class="text-center mb-4">
                                <span class="text-blcak text-uppercase">Cni</span>
                            </div> 
                        </a>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

@section('css')
    <style>
        .card-file:hover {
            transform: scale(1.1)!important;
        }

        .card-file{
            height:200px;
            width:200px;
            border:1px solid black;
            transition:.3s;
            margin: 3rem;
        }
    </style>
@endsection