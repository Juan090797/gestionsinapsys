<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="fecha_emision">Fecha Emision</label>
                                <input id="fecha_emision" type="date"  class="form-control" wire:model="state.fecha_emision">
                            </div>
                            @error('fecha_emision') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="fecha_pago">Fecha Pago</label>
                                <input id="fecha_pago" type="date"  class="form-control" wire:model="state.fecha_pago">
                            </div>
                            @error('fecha_pago') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="tipo_documento_id">Tipo documento</label>
                                <select id="tipo_documento_id" class="form-control" wire:model="state.tipo_documento_id">
                                    <option value="ELEGIR" selected>Elegir</option>
                                    @foreach($documentos as $documento)
                                        <option value="{{ $documento->id }}">{{ $documento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tipo_documento_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="serie_documento">Serie documento</label>
                                <input type="text" class="form-control" placeholder="ej: F001" wire:model="state.serie_documento">
                            </div>
                            @error('serie_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="numero_documento">Numero documento</label>
                                <input type="text" class="form-control" placeholder="ej: 123746" wire:model="state.numero_documento">
                            </div>
                            @error('numero_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="text" class="form-control" placeholder="ej: 500" wire:model="state.subtotal">
                            </div>
                            @error('subtotal') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="igv">Igv</label>
                                <input type="text" class="form-control" placeholder="ej: 70.1" wire:model="state.igv">
                            </div>
                            @error('igv') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="otros_tributos">Otros tributos</label>
                                <input type="text" class="form-control" placeholder="ej: 3.49" wire:model="state.otros_tributos">
                            </div>
                            @error('otros_tributos') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" placeholder="ej: 500.50" wire:model="state.total">
                            </div>
                            @error('total') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="pedido_id">Pedido</label>
                                <select class="form-control" wire:model="state.pedido_id">
                                    <option value="ELEGIR" selected>Elegir</option>
                                    @foreach($pedidos as $pedido)
                                        <option value="{{ $pedido->id }}">{{ $pedido->codigo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('pedido_id') <span class="text-danger er">{{ $message }}</span>@enderror
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
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="tipo_cambio">Tipo cambio</label>
                                <input type="text" class="form-control" placeholder="ej: 3.78" wire:model="state.tipo_cambio">
                            </div>
                            @error('tipo_cambio') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="glosa">Glosa</label>
                                <textarea id="glosa" rows="3" class="form-control" wire:model.defer="state.glosa"></textarea>
                            </div>
                            @error('glosa') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                @include('common.modalFooter')
            </form>
        </div>
    </div>
</div>
