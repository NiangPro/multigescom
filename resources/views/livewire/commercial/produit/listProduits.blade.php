<div class="card mt-2 card-primary">
    <div class="card-body">
        <div class="section-title mt-0"><strong>Liste des Produits</strong></div>
            {{-- view product --}}
            <div class="row pt-3" id="ads">
                @foreach ($produits as $produit)
                <!-- Category Card -->
                    <div class="col-md-3">
                        <div class="card rounded">
                            <div class="card-image">
                                <span class="card-notify-badge 
                                    @if ($produit->type==='Produit')
                                        prod-prod
                                    @else
                                        prod-serv
                                    @endif">{{$produit->type}}</span>
                                    <a class="card-notify-year btn-group text-center" type="button" wire:click.prevent="deleteProduct({{$produit->id}})" data-confirm-yes="remove()">
                                        <i class="fa fa-trash card-notify-icon"></i>
                                    </a>
                                <img class="image-fluid" src="{{asset('storage/images/'.$produit->image_produit)}}" alt="Alternate Text" />
                            </div>
                            <div class="card-body text-center">
                                <div class="ad-title m-auto">
                                    <h5>
                                        {{Str::substr($produit->nom, 0, 11) }} @if (strlen($produit->nom)> 8)
                                        ...
                                        @endif
                                    </h5>
                                </div>
                                <a class="ad-btn" type="button" wire:click.prevent="getProduct({{$produit->id}})">Voir</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container">
                    {{ $produits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

