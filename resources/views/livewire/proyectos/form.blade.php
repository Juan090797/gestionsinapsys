<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre*</label>
                            <input type="text" wire:model.defer="state.nombre" class="form-control" placeholder="ej: Proyecto A">
                        </div>
                        @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Prioridad*</label>
                            <select wire:model.defer="state.prioridad" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ALTA" >Alta</option>
                                <option value="MEDIA" >Media</option>
                                <option value="BAJA" >Baja</option>
                            </select>
                        </div>
                        @error('prioridad') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Cliente*</label>
                            <select wire:model.defer="state.cliente_id" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}" >{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Lider Proyecto*</label>
                            <select wire:model.defer="state.user_id" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" >{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div wire:ignore class="form-group">
                            <label>Equipo</label>
                            <select class="select2"  multiple="multiple" wire:model.defer="state.team" id="team" data-placeholder="Selecciona tu equipo" style="width: 100%;">
                                @foreach($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Gasto Estimado*</label>
                            <input type="number" wire:model.defer="state.gasto_estimado" class="form-control" placeholder="ej: 100000.00">
                        </div>
                        @error('gasto_estimado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Ingreso Estimado*</label>
                            <input type="number" wire:model.defer="state.ingreso_estimado" class="form-control" placeholder="ej: 900000.00">
                        </div>
                        @error('ingreso_estimado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Fecha Inicio*</label>
                            <input type="date" wire:model.defer="state.fecha_inicio" class="form-control">
                        </div>
                        @error('fecha_inicio') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Fecha Fin*</label>
                            <input type="date" wire:model.defer="state.fecha_fin" class="form-control">
                        </div>
                        @error('fecha_fin') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">Cerrar</button>
                    @if($selected_id < 1)
                        <button type="submit" wire:click.prevent="Store()" class="btn btn-dark close-modal">Crear</button>
                    @else
                        <button type="submit" wire:click.prevent="actualizar()" class="btn btn-dark close-modal">Actualizar</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

