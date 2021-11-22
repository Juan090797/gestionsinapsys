<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" wire:model="state.nombre" class="form-control" placeholder="ej: Impuesto A%">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" wire:model="state.valor" class="form-control" placeholder="ej: Valor A">
                        </div>
                        @error('valor') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Estado</label>
                            <select wire:model="state.estado" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ACTIVO" >Activo</option>
                                <option value="INACTIVO" >Bloqueado</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR</button>
                @if($selected_id < 1)
                    <button type="submit" wire:click.prevent="Store()" class="btn btn-dark close-modal">GUARDAR</button>
                @else
                    <button type="submit" wire:click.prevent="Update()" class="btn btn-dark close-modal">ACTUALIZAR</button>
                @endif
            </div>
        </div>
    </div>
</div>
