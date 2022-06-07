<div>
    <button wire:click.prevent="changeEtat('addClient')" class="btn btn-primary mb-2" > <i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
    @if ($status ==="addClient")
        @include('livewire.commercial.client.add')
    @elseif($status ==="listClients")
        @include('livewire.commercial.client.listClients')
    @endif
</div>
