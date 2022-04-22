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
                            <label for="user_id">Tecnico</label>
                            <select id="user_id" class="form-control" wire:model.defer="state.user_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($tecnicos as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <select id="cliente_id" class="form-control" wire:model.defer="state.cliente_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="producto_id">Productos</label>
                            <select id="producto_id" class="form-control" wire:model.defer="state.producto_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('producto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="pedido_id">Pedidos</label>
                            <select id="pedido_id" class="form-control" wire:model.defer="state.pedido_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($pedidos as $pedido)
                                    <option value="{{$pedido->id}}">{{$pedido->codigo}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('pedido_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="fecha_entrega">Fecha entrega</label>
                            <input type="date" id="fecha_entrega" class="form-control" wire:model.defer="state.fecha_entrega">
                        </div>
                        @error('fecha_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control" wire:model.defer="state.estado">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ACTIVO" >ACTIVO</option>
                                <option value="ASIGNADO" >ASIGNADO</option>
                                <option value="EN PROCESO" >EN PROCESO</option>
                                <option value="TERMINADO" >TERMINADO</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notas">notas</label>
                            <textarea type="text" id="notas" class="form-control" wire:model.defer="state.notas"></textarea>
                        </div>
                        @error('notas') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
