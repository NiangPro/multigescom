<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
  <button wire:click.prevent="changeEtat('addProduct')" class="btn btn-primary mb-2" > <i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
    @if ($status ==="addProduct")
        @include('livewire.commercial.add')
    @elseif($status ==="listProduct")
        @include('livewire.commercial.listProduits')
    @elseif($status ==="editProduct")
        @include('livewire.commercial.add')
    @endif
</div>

@section('js')
    <script>

        window.addEventListener('addSuccessful', event =>{
            iziToast.success({
            title: 'Produit et Service',
            message: 'Ajout avec succes',
            position: 'topRight'
            });
        });

        window.addEventListener('updateSuccessful', event =>{
        iziToast.success({
        title: 'Produit et Service',
        message: 'Mis à jour avec succes',
        position: 'topRight'
        });
    });


        window.addEventListener('deleteSuccessful', event =>{
            iziToast.success({
            title: 'Produit et Service',
            message: 'Suppression avec succes',
            position: 'topRight'
            });

            $('#message').hide();
        });
    </script>
@endsection