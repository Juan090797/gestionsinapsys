<div>
    @section('cabezera-contenido')
        <a href="{{route('compras')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Registro de Compra</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="createCompra">
            <div class="card" wire:ignore.self>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="proveedor_id">Proveedor</label>
                                <select id="proveedor_id" class="form-control" wire:model.defer="state.proveedor_id">
                                    <option value="0">Elegir</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo_documento_id">Tipo documento</label>
                                <select id="tipo_documento_id" class="form-control" wire:model.defer="state.tipo_documento_id">
                                    <option value="0">Elegir</option>
                                    @foreach($documentos as $documento)
                                        <option value="{{$documento->id}}">{{$documento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tipo_documento_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="serie_documento">Serie° Documento</label>
                                <input id="serie_documento" type="text" class="form-control" wire:model.defer="state.serie_documento" placeholder="Ej: F001">
                            </div>
                            @error('serie_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="numero_documento">N° Documento</label>
                                <input id="numero_documento" type="text" class="form-control" wire:model.defer="state.numero_documento" placeholder="Ej: 123456789">
                            </div>
                            @error('numero_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="centro_costo_id">Centro de costo</label>
                                <select id="centro_costo_id" class="form-control" wire:model.defer="state.centro_costo_id">
                                    <option value="0">Elegir</option>
                                    @foreach($costos as $costo)
                                        <option value="{{$costo->id}}">{{$costo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('centro_costo_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fecha_documento">Fecha Emision</label>
                                <input id="fecha_documento" class="form-control" type="date" wire:model.defer="state.fecha_documento">
                            </div>
                            @error('fecha_documento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fecha_pago">Fecha Pago</label>
                                <input id="fecha_pago" class="form-control" type="date" wire:model.defer="state.fecha_pago">
                            </div>
                            @error('fecha_pago') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="moneda">Moneda</label>
                                <select id="moneda" wire:model.defer="state.moneda" class="form-control">
                                    <option value="0">Elegir</option>
                                    <option value="Soles" selected>Soles</option>
                                    <option value="Dolares">Dolares</option>
                                </select>
                            </div>
                            @error('moneda') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo_cambio">Tipo cambio</label>
                                <input id="tipo_cambio" class="form-control" type="text" wire:model.defer="state.tipo_cambio" placeholder="Ej: 3.80">
                            </div>
                            @error('tipo_cambio') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea id="detalle" rows="3" class="form-control" wire:model.defer="state.detalle"></textarea>
                            </div>
                            @error('detalle') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" wire:ignore>
                                <label for="nuevo">Productos</label>
                                <select id="nuevo" class="sele form-control" wire:model="nuevo">
                                    <option value="">Seleccionar producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lista as $key => $producto)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <input class="form-control text-center" type="text" value="{{$producto['nombre']}}" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input wire:change="calcularCantidad($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="cantidad" size="5" value="{{number_format($producto['cantidad'],2)}}">
                                        </td>
                                        <td class="text-center">
                                            <input wire:change="calcularPrecio($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="precio" size="5" value="{{ number_format($producto['precio_u'],2)}}">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" class="form-control text-center" name="monto" value="{{ number_format($lista[$key]['precio_t'],2) ?? 0 }}" size="5" disabled>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-danger" wire:click="deleteRow({{ $key }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col-4"></div>
                        <div class="col-3">
                            <p class="lead">Detalle</p>
                            <p class="lead"><b>Total Items: {{$cantidadTotal}}</b> </p>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th>No agravadas:</th>
                                        <td><input type="text" class="form-control" wire:model.defer="state.no_gravadas"></td>
                                    </tr>
                                    <tr>
                                        <th>Otros Gastos:</th>
                                        <td><input type="text" class="form-control" wire:model.defer="state.otros_gastos"></td>
                                    </tr>
                                    <tr>
                                        <th>ICBPER:</th>
                                        <td><input type="text" class="form-control" wire:model.defer="state.icbper"></td>
                                    </tr>
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td><input type="text" class="form-control" wire:model.defer="state.subtotal"></td>
                                    </tr>
                                    <tr>
                                        <th>Impuesto(18%):</th>
                                        <td><input type="text" class="form-control" wire:model.defer="state.impuesto"></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>
                                            <input type="text" class="form-control" wire:model.defer="state.total">
                                            @error('total') <span class="text-danger er">{{ $message }}</span>@enderror
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-1"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            $('.sele').select2({
                theme: "classic",
            });
            $('.sele').on('change', function () {
                let data = $(this).val();
                @this.set('nuevo', $(this).val())
            });
        });
    </script>
</div>
