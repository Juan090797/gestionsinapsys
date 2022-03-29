<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" class="form-control" placeholder="ej: Ruc" wire:model.defer="state.nombre">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" id="codigo" class="form-control" placeholder="ej: Ruc" wire:model.defer="state.codigo">
                        </div>
                        @error('codigo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select id="tipo" class="form-control" wire:model.defer="state.tipo">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="Pago" >Pago</option>
                                <option value="Identidad" >Identidad</option>
                            </select>
                        </div>
                        @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
