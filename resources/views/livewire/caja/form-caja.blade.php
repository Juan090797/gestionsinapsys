<div  id="theModal" wire:ignore.self class="modal fade"  tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                @include('common.modalHead')
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre*</label>
                                <input id="nombre" type="text" wire:model.defer="state.nombre" class="form-control" placeholder="Caja Post Venta">
                            </div>
                            @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="user_id">Usuario*</label>
                                <select id="user_id" wire:model.defer="state.user_id" class="form-control">
                                    <option value="" selected>Elegir</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="saldo">Saldo*</label>
                                <input id="saldo" type="text" wire:model.defer="state.saldo" class="form-control" disabled>
                            </div>
                            @error('saldo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </form>
            @include('common.modalFooter')
        </div>
    </div>
</div>
