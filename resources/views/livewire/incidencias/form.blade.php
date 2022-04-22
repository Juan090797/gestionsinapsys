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
                            <label for="cliente_id">Cliente*</label>
                            <select id="cliente_id" class="form-control" wire:model="state.cliente_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="contacto_id">Contacto*</label>
                            <select id="contacto_id" class="form-control" wire:model.defer="state.contacto_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($contactos as $contacto)
                                    <option value="{{$contacto->id}}">{{$contacto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('contacto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="canal_comunicacion">Canal comunicacion*</label>
                            <select id="canal_comunicacion" class="form-control" wire:model.defer="state.canal_comunicacion">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="LLAMADA TELEFONICA">LLAMADA TELEFONICA</option>
                                <option value="WHATSAPP">WHATSAPP</option>
                                <option value="PERSONALMENTE">PERSONALMENTE</option>
                                <option value="CORREO ELECTRONICO">CORREO ELECTRONICO</option>
                            </select>
                        </div>
                        @error('canal_comunicacion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="producto_id">Productos*</label>
                            <select id="producto_id" class="form-control" wire:model.defer="state.producto_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('producto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label for="txt_incidencia">Indicencia*</label>
                            <input id="txt_incidencia" type="text" class="form-control" placeholder="descripcion de la incidencia" wire:model.defer="state.txt_incidencia">
                        </div>
                        @error('txt_incidencia') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="prioridad">Prioridad*</label>
                            <select id="prioridad" class="form-control" wire:model.defer="state.prioridad">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ALTO">ALTO</option>
                                <option value="MEDIA">MEDIA</option>
                                <option value="BAJA">BAJA</option>
                            </select>
                        </div>
                        @error('prioridad') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-1 mt-5">
                        <div class="custom-control custom-switch">
                            <input wire:model.defer="state.if_visita" type="checkbox" class="custom-control-input" id="sidebarCollapse1">
                            <label class="custom-control-label" for="sidebarCollapse1">Visita*</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="fecha_aviso">Fecha aviso*</label>
                            <input id="fecha_aviso" type="date" class="form-control" wire:model.defer="state.fecha_aviso">
                        </div>
                        @error('fecha_aviso') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="user_id">Tecnicos*</label>
                            <select id="user_id" class="form-control" wire:model.defer="state.user_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($tecnicos as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="fecha_ejecucion">Fecha ejecucion*</label>
                            <input id="fecha_ejecucion" type="datetime-local" class="form-control" wire:model.defer="state.fecha_ejecucion">
                        </div>
                        @error('fecha_ejecucion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="estado">Estado*</label>
                            <select id="estado" class="form-control" wire:model.defer="state.estado">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ASIGNADO" >ASIGNADO</option>
                                <option value="EN PROCESO" >EN PROCESO</option>
                                <option value="SOLUCIONADO" >SOLUCIONADO</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="fecha_cierre">Fecha cierre</label>
                            <input id="fecha_cierre" type="date" class="form-control" wire:model.defer="state.fecha_cierre">
                        </div>
                        @error('fecha_cierre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-7">
                        <label for="basic-url">Reporte(PDF*)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" accept="application/pdf" wire:model="reporte">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">{{$reporte}}</label>
                            </div>
                        </div>
                        <div wire:loading wire:target="reporte">Cargando.....</div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notas">Notas</label>
                            <textarea id="notas" type="text" class="form-control" wire:model.defer="state.notas"></textarea>
                        </div>
                        @error('notas') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
