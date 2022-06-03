<div class="card mt-2">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Produits</strong></div>
        <div class="table-responsive">
            <table class="table table-hover" id="table-2">
            <thead>
                <th>Nom</th>
                <th>Description</th>
                <th>Type</th>
                <th>Tarif</th>
                <th>Taxe</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr>
                        <td>{{$produit->nom}}</td>
                        <td>{{$produit->description}}</td>
                        <td>{{$produit->type}}</td>
                        <td>{{$produit->tarif}}</td>
                        <td>{{$produit->taxe}}</td>
                        <td>
                            <div class="d-flex">
                                <button  class="btn btn-icon btn-outline-success btn-sm" wire:click.prevent="getProduct({{$produit->id}})"><i class="far fa-edit"></i></button>
                                <button  class="btn ml-1 btn-icon btn-outline-danger btn-sm  trigger--fire-modal-1" data-confirm="Voulez-vous supprimer?" data-confirm-yes="delete()"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>

