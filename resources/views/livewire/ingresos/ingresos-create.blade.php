<div>
    @section('cabezera-contenido')
        <a href="{{route('ingresos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Registro de Guia de Ingreso</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="createIngreso">
            <section class="invoice p-3 mb-3" wire:ignore.self>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="motivo_id">Motivo</label>
                            <select class="form-control" wire:model="state.motivo_id">
                                <option value="0">Elegir</option>
                                @foreach($motivos as $motivo)
                                    <option value="{{$motivo->id}}">{{$motivo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('motivo_id')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <select wire:model.defer="state.usuario_id" class="form-control">
                                @if ($lista->count() == 0)
                                    <option value="">Elegir</option>
                                @endif
                                @foreach($lista as $l)
                                    <option value="{{$l->name ?: $l->razon_social}}">{{$l->name ?: $l->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('usuario_id')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="numero_documento">Referencia</label>
                            <input id="numero_documento" type="text" class="form-control" wire:model.defer="state.numero_documento" placeholder="Ej: F001-123456789">
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="fecha_documento">Fecha Documento</label>
                            <input id="fecha_documento" class="form-control" type="date" wire:model.defer="state.fecha_documento">
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="">Centro de costo</label>
                            <select wire:model.defer="state.centro_costo_id" class="form-control">
                                <option value="0">Elegir</option>
                                @foreach($costos as $costo)
                                    <option value="{{$costo->id}}">{{$costo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('centro_costo_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Codigo</th>
                                    <th class="text-center">Stock Actual</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <select name="producto_id" wire:change="getServicePrice(event.target.value, {{$key}})" class="form-control">
                                            <option value="">Elegir</option>
                                            @foreach($productos as $producto)
                                                <option {{ ($producto->id == $rows[$key]['producto_id']) ? 'selected' : '' }} value="{{ $producto->id }}">{{$producto->nombre.'-'.$producto->marca->nombre.'-'.$producto->codigo}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control text-center" name="stock" size="5" value="{{ $rows[$key]['stock']}}"  disabled>
                                    </td>
                                    <td class="text-center">
                                        <input wire:change="cambioCantidad($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="cantidad" value="1" size="5">
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-danger" wire:click="deleteRow({{ $key }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">
                                    <button wire:click.prevent="addNewRow()" class="btn btn-primary" type="button"><i class="fa fa-plus-circle mr-1"></i> Agregar</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <p class="lead">Detalle</p>
                        <p class="lead"><b>Total Items: {{$cantidadTotal}}</b> </p>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-1"></i> Guardar</button>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('compra-registrada', msg =>{
                noty(msg)
            })
        });
    </script>
</div>
