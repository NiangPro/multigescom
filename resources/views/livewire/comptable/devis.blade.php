<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
  <button wire:click.prevent="changeEtat('add')" class="btn btn-primary mb-2" > <i class="fa fa-plus" aria-hidden="true"></i> Ajout</button>
    @if ($etat ==="add" || $etat ==="info")
        @include('livewire.comptable.devis.addDevis')
    @else
        @include('livewire.comptable.devis.listDevis')
    @endif
</div>

@section('js')
    <script>

        window.addEventListener('addSuccessful', event =>{
            iziToast.success({
            title: 'Depense',
            message: 'Ajout avec succes',
            position: 'topRight'
            });
        });

        window.addEventListener('updateSuccessful', event =>{
            iziToast.success({
            title: 'Depense',
            message: 'Mis à jour avec succes',
            position: 'topRight'
            });
        });

        window.addEventListener('elementEmpty', event =>{
        iziToast.error({
        title: 'Devis',
        message: 'Veuillez d\'abord remplir la derniere ligne',
        position: 'topRight'
        });
    });

        
    </script>
@endsection