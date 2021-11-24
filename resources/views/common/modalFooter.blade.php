<div class="modal-footer">
    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR</button>
    @if($selected_id < 1)
        <button id="submit" type="submit" wire:click.prevent="Store()" class="btn btn-dark close-modal">GUARDAR</button>
    @else
        <button id="submit" type="submit" wire:click.prevent="Update()" class="btn btn-dark close-modal">ACTUALIZAR</button>
    @endif
</div>
