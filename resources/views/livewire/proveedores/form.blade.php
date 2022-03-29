<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="ruc">Ruc</label>
                            <input type="text" wire:model.defer="state.ruc" id="ruc" class="form-control" placeholder="ej: 20111457895">
                        </div>
                        @error('ruc') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="razon_social">Razon Social</label>
                            <input type="text" wire:model.defer="state.razon_social" id="razon_social" class="form-control" placeholder="ej: Razon Social S.A.C.">
                        </div>
                        @error('razon_social') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select wire:model.defer="state.estado" id="estado" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="nombre_comercial">Nombre Comercial</label>
                            <input type="text" wire:model.defer="state.nombre_comercial" id="nombre_comercial" class="form-control" placeholder="ej: Nombre Comercial">
                        </div>
                        @error('nombre_comercial') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" wire:model.defer="state.direccion" id="direccion" class="form-control" placeholder="ej: Av. direccion 12345">
                        </div>
                        @error('direccion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" wire:model.defer="state.telefono" id="telefono" class="form-control" placeholder="ej: 575-1111">
                        </div>
                        @error('telefono') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" wire:model.defer="state.celular" id="celular" class="form-control" placeholder="ej: 999999999">
                        </div>
                        @error('celular') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" wire:model.defer="state.correo" id="correo" class="form-control" placeholder="ej: correo@correo.com">
                        </div>
                        @error('correo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="pagina_web">Pagina web</label>
                            <input type="text" wire:model.defer="state.pagina_web" id="pagina_web" class="form-control" placeholder="ej: www.paginaweb.com">
                        </div>
                        @error('pagina_web') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="tipo_proveedors_id">Tipo Proveedor</label>
                            <select wire:model.defer="state.tipo_proveedors_id" id="tipo_proveedors_id" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tipo_proveedors_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="tipo_documento_id">Tipo Documento</label>
                            <select id="tipo_documento_id" class="form-control" wire:model.defer="state.tipo_documento_id">
                                <option value="" selected>Elegir</option>
                                @foreach($documentos as $documento)
                                    <option value="{{ $documento->id }}">{{ $documento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tipo_documento_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
