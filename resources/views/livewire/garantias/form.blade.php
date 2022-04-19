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
                            <label for="producto_id">Producto</label>
                            <select id="producto_id" class="form-control" wire:model.defer="state.producto_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('producto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="tiempo_garantia">Tiempo garantia(Meses)</label>
                            <input id="tiempo_garantia" class="form-control" type="text" wire:model.defer="state.tiempo_garantia">
                        </div>
                        @error('tiempo_garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control" wire:model.defer="state.estado">
                                <option value="ELEGIR">Elegir</option>
                                <option value="CG">CG</option>
                                <option value="FG">FG</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="prioridad">Prioridad</label>
                            <select id="prioridad" class="form-control" wire:model.defer="state.prioridad">
                                <option value="ELEGIR">Elegir</option>
                                <option value="REGULAR">REGULAR</option>
                                <option value="MEDIA">MEDIA</option>
                                <option value="ALTA">ALTA</option>
                            </select>
                        </div>
                        @error('prioridad') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="fin_garantia">Fin garantia</label>
                            <input id="fin_garantia" class="form-control" type="date" wire:model.defer="state.fin_garantia">
                        </div>
                        @error('fin_garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="orden_compra">#Orden compra</label>
                            <input id="orden_compra" class="form-control" type="text" wire:model.defer="state.orden_compra">
                        </div>
                        @error('orden_compra') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="mant_total"># total mantenimientos</label>
                            <input id="mant_total" class="form-control" type="text" wire:model.defer="state.mant_total">
                        </div>
                        @error('mant_total') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
