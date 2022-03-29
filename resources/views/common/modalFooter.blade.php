<div class="modal-footer">
    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">Cerrar</button>
    @if($selected_id < 1)
        <button type="submit" wire:click.prevent="Store()" class="btn btn-dark close-modal">Crear</button>
    @else
        <button type="submit" wire:click.prevent="actualizar()" class="btn btn-dark close-modal">Actualizar</button>
    @endif
</div>
