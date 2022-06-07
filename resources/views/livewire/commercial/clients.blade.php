<div>
    <button wire:click.prevent="changeEtat('addClient')" class="btn btn-primary mb-2" > <i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
    @if ($status ==="addClient")
        @include('livewire.commercial.client.add')
    @elseif($status ==="listClients")
        @include('livewire.commercial.client.listClients')
    @endif
</div>

@section('js')
<script>


    window.addEventListener('addSuccessful', event =>{
        iziToast.success({
        title: 'Client',
        message: 'Ajout avec succes',
        position: 'topRight'
        });
    });

    window.addEventListener('updateSuccessful', event =>{
        iziToast.success({
        title: 'Client',
        message: 'Mis à jour avec succes',
        position: 'topRight'
        });
    });

</script>

@endsection
