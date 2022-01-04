<div>
    @section('cabezera-contenido')
        <a href="{{route('compras')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Registro de Compra</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="createCompra">
            <section class="invoice p-3 mb-3" wire:ignore.self>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="">Proveedor</label>
                            <select wire:model.defer="state.proveedor_id" class="form-control">
                                <option value="0">Elegir</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="tipo_documento">Documento</label>
                            <input id="tipo_documento" type="text" class="form-control" wire:model.defer="state.tipo_documento" placeholder="Ej: Factura">
                        </div>
                        @error('tipo_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="numero_documento">N° Documento</label>
                            <input id="numero_documento" type="text" class="form-control" wire:model.defer="state.numero_documento" placeholder="Ej: F001-123456789">
                        </div>
                        @error('numero_documento') <span class="text-danger er">{{ $message }}</span>@enderror
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
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="fecha_documento">Fecha Documento</label>
                            <input id="fecha_documento" class="form-control" type="date" wire:model.defer="state.fecha_documento">
                        </div>
                        @error('fecha_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label for="fecha_pago">Fecha Pago</label>
                            <input id="fecha_pago" class="form-control" type="date" wire:model.defer="state.fecha_pago">
                        </div>
                        @error('fecha_pago') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Total</th>
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
                                                <option {{ ($producto->id == $rows[$key]['producto_id']) ? 'selected' : '' }} value="{{ $producto->id }}">{{$producto->codigo}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input wire:change="calculateAmount($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="cantidad" size="5" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input wire:change="calculatePrice($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="precio" size="5" value="{{ $rows[$key]['formate_precio'] ?? 0 }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control text-center" name="monto" value="{{ $rows[$key]['formate_monto'] ?? 0 }}" size="5" disabled>
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
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>S/ {{number_format($subTotal,2)}}</td>
                                </tr>
                                <tr>
                                    <th>Impuesto(18%)</th>
                                    <td>S/ {{number_format($impuestoD,2)}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>S/ {{number_format($total,2)}}</td>
                                </tr>
                            </table>
                        </div>
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
