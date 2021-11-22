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
                            <label>Nombre Comercial*</label>
                            <input type="text" wire:model.defer="nombre" class="form-control" placeholder="ej: Sinapsys Medica">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>     <!--nombre -->
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Industria*</label>
                            <select wire:model.defer="industriaid" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($industrias as $industria)
                                    <option value="{{$industria->id}}" >{{$industria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('industriaid') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--industria_id-->
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Categoria*</label>
                            <select wire:model.defer="categoriaid" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}" >{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('categoriaid') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--categoria_id-->
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Correo*</label>
                            <input type="email" wire:model.defer="correo" class="form-control" placeholder="ej: correo@correo.com">
                        </div>
                        @error('correo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--correo-->
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Telefono*</label>
                            <input type="text" wire:model.defer="telefono" class="form-control" placeholder="ej: 5750399">
                        </div>
                        @error('telefono') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--telefono-->
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Estado*</label>
                            <select wire:model.defer="estado" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ACTIVO" >Activo</option>
                                <option value="INACTIVO" >Inactivo</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--estado-->
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Pagina Web</label>
                            <input type="text" wire:model.defer="pagina_web" class="form-control" placeholder="ej: www.paginaweb.com">
                        </div>
                        @error('pagina_web') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--pagina_web-->
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Direccion*</label>
                            <input type="text" wire:model.defer="direccion" class="form-control" placeholder="ej: Av.direccion 111">
                        </div>
                        @error('direccion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>    <!--direccion-->
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea type="text" wire:model.defer="descripcion" class="form-control" placeholder="ej: Descripcion..."></textarea>
                        </div>
                        @error('descripcion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>   <!--descripcion-->
                    <div class="col-sm-12 col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dt.Bancos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Direcciones</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Razon Social*</label>
                                            <input type="text" wire:model.defer="razon_social" class="form-control" placeholder="ej: Sinapsys Medica S.A.C">
                                        </div>
                                        @error('razon_social') <span class="text-danger er">{{ $message }}</span>@enderror
                                    </div> <!--razon_social-->
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Ruc*</label>
                                            <input type="number" wire:model.defer="ruc" class="form-control" placeholder="ej: 12345678912">
                                        </div>
                                        @error('ruc') <span class="text-danger er">{{ $message }}</span>@enderror
                                    </div> <!--ruc-->
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Detalles Bancarios*</label>
                                            <textarea type="text" wire:model.defer="detalle_banco" class="form-control" placeholder="ej: Cuenta 1..."></textarea>
                                        </div>
                                        @error('detalle_banco') <span class="text-danger er">{{ $message }}</span>@enderror
                                    </div> <!--detalle_banco-->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Pais(Entrega)</label>
                                                    <input type="text" wire:model.defer="pais_entrega" class="form-control" placeholder="ej: Peru">
                                                </div>
                                                @error('pais_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--pais_entrega-->
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Ciudad(Entrega)</label>
                                                    <input type="text" wire:model.defer="ciudad_entrega" class="form-control" placeholder="ej: Lima">
                                                </div>
                                                @error('ciudad_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--ciudad_entrega-->
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Direccion(Entrega)</label>
                                                    <textarea type="text" wire:model.defer="direccion_entrega" class="form-control" placeholder="ej: Av.direccion 8888"></textarea>
                                                </div>
                                                @error('direccion_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--direccion_entrega-->
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Pais(Recojo)</label>
                                                    <input type="text" wire:model.defer="pais_recojo" class="form-control" placeholder="ej: Peru">
                                                </div>
                                                @error('pais_recojo') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--pais_recojo-->
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Ciudad(Recojo)</label>
                                                    <input type="text" wire:model.defer="ciudad_recojo" class="form-control" placeholder="ej: Lima">
                                                </div>
                                                @error('ciudad_recojo') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--ciudad_recojo-->
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Direccion(Recojo)</label>
                                                    <textarea type="text" wire:model.defer="direccion_recojo" class="form-control" placeholder="ej: Av.direccion 8888"></textarea>
                                                </div>
                                                @error('direccion_recojo') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div> <!--direccion_recojo-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
