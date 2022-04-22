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
                            <label for="user_id">Tecnico*</label>
                            <select class="form-control" wire:model.defer="state.user_id">
                                <option value="ELEGIR" selected>Elegir</option>
                                @foreach($tecnicos as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="fecha_ejecucion">Fecha Ejecucion*</label>
                            <input type="datetime-local" class="form-control" wire:model.defer="state.fecha_ejecucion">
                        </div>
                        @error('fecha_ejecucion') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-9">
                        <label for="reporte">Reporte</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" accept="application/pdf" wire:model="reporte">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">{{$reporte}}</label>
                            </div>
                        </div>
                        <div wire:loading wire:target="reporte">Cargando.....</div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="estado">Estado*</label>
                            <select class="form-control" wire:model.defer="state.estado">
                                <option value="ELEGIR" selected>Elegir</option>
                                <option value="ASIGNADO">ASIGNADO</option>
                                <option value="EN PROCESO">EN PROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                            </select>
                        </div>
                        @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            @include('common.modalFooter')
        </div>
    </div>
</div>
