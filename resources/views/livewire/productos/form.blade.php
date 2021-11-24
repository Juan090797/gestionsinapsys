<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="codigo">Codigo*</label>
                            <input type="text" wire:model.defer="state.codigo" class="form-control" id="codigo" placeholder="ej: 00000145">
                        </div>
                        @error('codigo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="marca_id">Marca*</label>
                            <select wire:model.defer="state.marca_id" id="marca_id" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($marcas as $marca)
                                    <option value="{{$marca->id}}" >{{$marca->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('marca_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="familia_id">Equipo*</label>
                            <select wire:model.defer="state.familia_id" id="familia_id" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($familias as $familia)
                                    <option value="{{$familia->id}}" >{{$familia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('familia_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Precio*</label>
                            <input type="number" wire:model.defer="state.precio" class="form-control" placeholder="ej: Precio">
                        </div>
                        @error('precio') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="modelo">Modelo*</label>
                            <input type="text" wire:model.defer="state.modelo" id="modelo" class="form-control" placeholder="ej: Modelo">
                        </div>
                        @error('modelo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="tipo">Tipo*</label>
                            <input type="text" wire:model.defer="state.tipo" id="tipo" class="form-control" placeholder="ej: Tipo">
                        </div>
                        @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion*</label>
                            <textarea wire:model.defer="state.descripcion" rows="10" id="descripcion" class="form-control"></textarea>
                        </div>
                        @error('descripcion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
