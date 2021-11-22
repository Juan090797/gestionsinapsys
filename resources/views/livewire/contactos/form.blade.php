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
                            <label>Nombre</label>
                            <input type="text" wire:model.defer="nombre" class="form-control" placeholder="ej: Nombre contacto">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" wire:model.defer="celular_cont" class="form-control" placeholder="ej: Celular contacto">
                        </div>
                        @error('celular_cont') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" wire:model.defer="correo_cont" class="form-control" placeholder="ej: Correo contacto">
                        </div>
                        @error('correo_cont') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" wire:model.defer="area_cont" class="form-control" placeholder="ej: area conctacto">
                        </div>
                        @error('area_cont') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input type="text" wire:model.defer="cargo_cont" class="form-control" placeholder="ej: Cargo Contacto">
                        </div>
                        @error('cargo_cont') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Estado</label>
                            <select wire:model.defer="estado_cont" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Bloqueado</option>
                            </select>
                        </div>
                        @error('estado_cont') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
