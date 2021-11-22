<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Codigo*</label>
                            <input type="text" wire:model.defer="codigo" class="form-control" placeholder="ej: 00000145">
                        </div>
                        @error('codigo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Marca*</label>
                            <select wire:model.defer="marcaid" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($marcas as $marca)
                                    <option value="{{$marca->id}}" >{{$marca->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('marcaid') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Equipo*</label>
                            <select wire:model.defer="familiaid" class="form-control">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($familias as $familia)
                                    <option value="{{$familia->id}}" >{{$familia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('familiaid') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Precio*</label>
                            <input type="number" wire:model.defer="precio" class="form-control" placeholder="ej: Precio">
                        </div>
                        @error('precio') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Modelo*</label>
                            <input type="text" wire:model.defer="modelo" class="form-control" placeholder="ej: Modelo">
                        </div>
                        @error('modelo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Tipo*</label>
                            <input type="text" wire:model.defer="tipo" class="form-control" placeholder="ej: Tipo">
                        </div>
                        @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Descripcion*</label>
                            <textarea cols="40" rows="10" type="text" wire:model.defer="descripcion" class="form-control" placeholder="ej: Descripcion..."></textarea>
                        </div>
                        @error('descripcion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
