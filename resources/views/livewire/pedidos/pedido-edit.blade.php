<div>
    @section('cabezera-contenido')
        <a href="{{route('pedidos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Editar Pedido #{{ $pedido->codigo }}</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="actualizarPedido">
            <div class="card" wire:ignore.self>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <select id="cliente_id" class="form-control" wire:model.defer="state.cliente_id">
                                    <option value="0">Elegir</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="atendido">Atendido</label>
                                <input id="atendido" class="form-control" type="text" wire:model.defer="state.atendido">
                            </div>
                            @error('atendido') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fecha_pedido">Fecha Pedido</label>
                                <input id="fecha_pedido" class="form-control" type="date" wire:model.defer="state.fecha_pedido">
                            </div>
                            @error('fecha_pedido') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="plazo_entrega">Plazo entrega*(días)</label>
                                <input id="plazo_entrega" class="form-control" type="number" wire:model.defer="state.plazo_entrega">
                            </div>
                            @error('plazo_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="txt_plazo">Texto plazo</label>
                                <input id="txt_plazo" class="form-control" type="text" wire:model.defer="state.txt_plazo">
                            </div>
                            @error('txt_plazo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="garantia">Garantia*(meses)</label>
                                <input id="garantia" class="form-control" type="number" wire:model.defer="state.garantia">
                            </div>
                            @error('garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="txt_garantia">Texto garantia</label>
                                <input id="txt_garantia" class="form-control" type="text" wire:model.defer="state.txt_garantia">
                            </div>
                            @error('txt_garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="num_mantenimiento"># Mantenimientos</label>
                                <input id="num_mantenimiento" type="number" class="form-control" placeholder="#" wire:model.defer="state.num_mantenimiento">
                            </div>
                            @error('num_mantenimiento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="txt_mantenimiento">Texto Mantenimientos</label>
                                <input id="txt_mantenimiento" type="text" class="form-control"  placeholder="Una vez al año, durante el periodo de garantía" wire:model.defer="state.txt_mantenimiento">
                            </div>
                            @error('txt_mantenimiento') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="direccion_entrega">Direccion entrega</label>
                                <input id="direccion_entrega" class="form-control" type="text" wire:model.defer="state.direccion_entrega" placeholder="Los olivos 15464">
                            </div>
                            @error('direccion_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" wire:ignore>
                                <label for="nuevo">Productos</label>
                                <select class="sele form-control" wire:model="nuevo">
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
                                    <th class="text-center">Descripcion</th>
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
                                            <textarea wire:change="cambiarDetalle($event.target.value, {{ $key }})" class="overflow-auto form-control" name="descripcion" cols="40" rows="4">{{ $producto['descripcion'] }}</textarea>
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
                        <div class="col-4"></div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <p class="lead">Detalle</p>
                            <p class="lead"><b>Total Items: {{$cantidadTotal}}</b> </p>
                            <div class="table-responsive">
                                <table class="table table-sm">
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
            @this.set('nuevo', $(this).val());
            });
        });
    </script>
</div>
