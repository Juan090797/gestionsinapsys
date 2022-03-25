<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="tipo">Tipo Movimiento*</label>
                                <select id="tipo" wire:model.defer="state.tipo" class="form-control">
                                    <option value="" selected>Elegir</option>
                                    <option value="INGRESO" >Ingreso</option>
                                    <option value="EGRESO" >Egreso</option>
                                </select>
                            </div>
                            @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="user_id">Usuario*</label>
                                <select id="user_id" wire:model.defer="state.user_id" class="form-control">
                                    <option value="" selected>Elegir</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="fecha">Fecha*</label>
                                <input id="fecha" type="date" wire:model.defer="state.fecha" class="form-control">
                            </div>
                            @error('fecha') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="referencia">Referencia</label>
                                <input id="referencia" type="text" wire:model.defer="state.referencia" class="form-control" placeholder="OC-12345">
                            </div>
                            @error('referencia') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <select id="cliente_id" wire:model.defer="state.cliente_id" class="form-control">
                                    <option value="" selected>Elegir</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}" >{{$cliente->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="concepto">Concepto*</label>
                                <select id="concepto" wire:model.defer="state.concepto" class="form-control">
                                    <option value="" selected>Elegir</option>
                                    <option value="Movilidad" >Movilidad</option>
                                    <option value="Caja chica" >Caja chica</option>
                                </select>
                            </div>
                            @error('concepto') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="motivo">Motivo*</label>
                                <input id="motivo" type="text" wire:model.defer="state.motivo" class="form-control" placeholder="Mantenimiento de equipos">
                            </div>
                            @error('motivo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label for="importe">Importe*</label>
                                <input id="importe" type="text" wire:model.defer="state.importe" class="form-control" placeholder="145.50">
                            </div>
                            @error('importe') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea id="detalle" rows="5" class="form-control" wire:model.defer="state.detalle"></textarea>
                            </div>
                            @error('detalle') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </form>
            @include('common.modalFooter')
        </div>
    </div>
</div>
