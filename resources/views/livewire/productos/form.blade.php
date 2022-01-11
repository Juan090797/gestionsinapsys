<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
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
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="precioventa">Precio Venta*</label>
                            <input id="precioventa" type="text" wire:model.defer="state.precio_venta" class="form-control" placeholder="ej: Precio venta">
                        </div>
                        @error('precio_venta') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="preciocompra">Precio Compra</label>
                            <input id="preciocompra" type="text" wire:model.defer="state.precio_compra" class="form-control" disabled>
                        </div>
                        @error('precio_compra') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input id="stock" type="text" wire:model.defer="state.stock" class="form-control" disabled>
                        </div>
                        @error('stock') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="modelo">Modelo*</label>
                            <input type="text" wire:model.defer="state.modelo" id="modelo" class="form-control" placeholder="ej: Modelo">
                        </div>
                        @error('modelo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="tipo">Tipo*</label>
                            <input type="text" wire:model.defer="state.tipo" id="tipo" class="form-control" placeholder="ej: Tipo de equipo">
                        </div>
                        @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="unidad_medida">U.Medida*</label>
                            <select id="unidad_medida" class="form-control" wire:model.defer="state.unidad_medidas_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{$unidad->id}}" >{{$unidad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('marca_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="clasificacion">Clasificacion*</label>
                            <select id="clasificacion" class="form-control" wire:model.defer="state.clasificacions_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($clasificaciones as $clasificacion)
                                    <option value="{{$clasificacion->id}}" >{{$clasificacion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('clasificacion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="estado">Estado*</label>
                            <select id="estado" class="form-control" wire:model.defer="state.estado">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre*</label>
                            <input type="text" wire:model.defer="state.nombre" id="nombre" class="form-control">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
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
