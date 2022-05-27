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
                            <label>Tipo Gasto</label>
                            <select class="form-control" wire:model.defer="state.tipo">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ORIGEN">Origen</option>
                                <option value="DESTINO">Destino</option>
                                <option value="AGENCIAMIENTO">Agenciamiento</option>
                                <option value="DERECHOS">Derechos</option>
                            </select>
                        </div>
                        @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Concepto</label>
                            <select class="form-control" wire:model.defer="state.concepto">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="Flete">Flete</option>
                                <option value="Seguro">Seguro</option>
                                <option value="Pick-up">Pick-up</option>
                                <option value="Embalaje">Embalaje</option>
                                <option value="SHA">SHA</option>
                                <option value="OUR">OUR</option>
                                <option value="AWB">AWB</option>
                                <option value="CCA">CCA</option>
                                <option value="AWB">AS agreed</option>
                            </select>
                        </div>
                        @error('concepto') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" wire:model.defer="state.cantidad">
                        </div>
                        @error('cantidad') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Subtotal</label>
                            <input type="number" class="form-control" wire:model.defer="state.subtotal">
                        </div>
                        @error('subtotal') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Igv</label>
                            <input type="number" class="form-control" wire:model.defer="state.igv">
                        </div>
                        @error('igv') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" class="form-control" wire:model.defer="state.total">
                        </div>
                        @error('total') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Seleccionar costo</label>
                            <select class="form-control" wire:model.defer="state.costo_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                 @foreach($orden->costos as $costo)
                                    <option value="{{$costo->id}}">{{$costo->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('costo_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
