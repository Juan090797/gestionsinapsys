<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="proveedor_id">Proveedor</label>
                                <select id="proveedor_id" class="form-control" wire:model.defer="state.proveedor_id">
                                    <option value="">Elegir</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo_documento_id">Tipo documento</label>
                                <select id="tipo_documento_id" class="form-control" wire:model.defer="state.tipo_documento_id">
                                    <option value="">Elegir</option>
                                    @foreach($documentos as $documento)
                                        <option value="{{$documento->id}}">{{$documento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tipo_documento_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="serie_documento">Serie° Documento</label>
                                <input id="serie_documento" type="text" class="form-control" wire:model.defer="state.serie_documento" placeholder="Ej: F001">
                            </div>
                            @error('serie_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="numero_documento">N° Documento</label>
                                <input id="numero_documento" type="text" class="form-control" wire:model.defer="state.numero_documento" placeholder="Ej: 123456789">
                            </div>
                            @error('numero_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="centro_costo_id">Centro de costo</label>
                                <select id="centro_costo_id" class="form-control" wire:model.defer="state.centro_costo_id">
                                    <option value="">Elegir</option>
                                    @foreach($costos as $costo)
                                        <option value="{{$costo->id}}">{{$costo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('centro_costo_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="fecha_documento">Fecha Documento</label>
                                <input id="fecha_documento" class="form-control" type="date" wire:model.defer="state.fecha_documento">
                            </div>
                            @error('fecha_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="fecha_pago">Fecha Pago</label>
                                <input id="fecha_pago" class="form-control" type="date" wire:model.defer="state.fecha_pago">
                            </div>
                            @error('fecha_pago') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="moneda">Moneda</label>
                                <select id="moneda" class="form-control" wire:model.defer="state.moneda">
                                    <option value="">Elegir</option>
                                    <option value="Soles" selected>Soles</option>
                                    <option value="Dolares">Dolares</option>
                                </select>
                            </div>
                            @error('moneda') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo_cambio">Tipo cambio</label>
                                <input id="tipo_cambio" class="form-control" type="text" wire:model.defer="state.tipo_cambio" placeholder="Ej: 3.80">
                            </div>
                            @error('tipo_cambio') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="subtotal">SubTotal</label>
                                <input id="subtotal" class="form-control" type="text" wire:model.defer="state.subtotal" placeholder="Ej: 3.80">
                            </div>
                            @error('subtotal') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="impuesto">IGV</label>
                                <input id="impuesto" class="form-control" type="text" wire:model.defer="state.impuesto" placeholder="Ej: 3.80">
                            </div>
                            @error('impuesto') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="no_gravadas">No gravadas</label>
                                <input id="no_gravadas" class="form-control" type="text" wire:model.defer="state.no_gravadas" placeholder="Ej: 3.80">
                            </div>
                            @error('no_gravadas') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="icbper">ICBPER</label>
                                <input id="icbper" class="form-control" type="text" wire:model.defer="state.icbper" placeholder="Ej: 3.80">
                            </div>
                            @error('icbper') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="otros_gastos">Otros Gastos</label>
                                <input id="otros_gastos" class="form-control" type="text" wire:model.defer="state.otros_gastos" placeholder="Ej: 3.80">
                            </div>
                            @error('otros_gastos') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input id="total" class="form-control" type="text" wire:model.defer="state.total" placeholder="Ej: 3.80">
                            </div>
                            @error('total') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea id="detalle" rows="3" class="form-control" wire:model.defer="state.detalle"></textarea>
                            </div>
                            @error('detalle') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                @include('common.modalFooter')
            </form>
        </div>
    </div>
</div>
