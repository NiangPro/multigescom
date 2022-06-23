<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
  <button wire:click.prevent="changeEtat('add')" class="btn btn-primary mb-2" > <i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
    @if ($etat ==="add")
        @include('livewire.comptable.vente.addVente')
    @elseif ($etat === "list")
        @include('livewire.comptable.vente.listVente')
    @else
        @include('livewire.comptable.vente.infosVente')
    @endif
</div>

@section('js')
    <script>

        window.addEventListener('addSuccessful', event =>{
            iziToast.success({
            title: 'Vente',
            message: 'Ajout avec succes',
            position: 'topRight'
            });
        });

        window.addEventListener('updateSuccessful', event =>{
            iziToast.success({
            title: 'Vente',
            message: 'Mis à jour avec succes',
            position: 'topRight'
            });
        });

        window.addEventListener('elementEmpty', event =>{
        iziToast.error({
        title: 'Vente',
        message: 'Veuillez d\'abord remplir la derniere ligne',
        position: 'topRight'
        });
    });

        
    </script>
@endsection