<div>
    @section('cabezera-contenido')
        <a href="{{route('proyecto.show', $proyecto)}}" class="btn btn-primary float-right">Atras</a>
        <h1>Cotizacion del proyecto # {{$proyecto->id}}</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="createCotizacion">
        <div class="card p-3 mb-3" wire:ignore.self>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <b>Cotizacion #{{$code}}</b>
                            <small class="float-right">Fecha: {{date("d-m-Y")}}</small>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <input type="cliente_id" class="form-control" value="{{ $proyecto->cliente->razon_social }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Atencion*</label>
                            <input type="text" class="form-control" wire:model.defer="state.atendido">
                        </div>
                        @error('atendido') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="date">Fecha inicio*</label>
                            <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date" wire:model.defer="state.fecha_inicio">
                        </div>
                        @error('fecha_inicio') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="due_date">Fecha expiracion*</label>
                            <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date" wire:model.defer="state.fecha_fin">
                        </div>
                        @error('fecha_fin') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="basic-url">Imagen(PNG*)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" accept="image/*" wire:model="imagen">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">{{$imagen}}</label>
                            </div>
                        </div>
                        <div wire:loading wire:target="imagen">Cargando.....</div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="plazo_entrega">P. entrega(días)*</label>
                            <input id="plazo_entrega" type="number" class="form-control" placeholder="# dias" wire:model.defer="state.plazo_entrega">
                        </div>
                        @error('plazo_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="txt_plazo">Texto plazo entrega*</label>
                            <input id="txt_plazo" type="text" class="form-control"  placeholder="a partir de la recepcion de la O/C" wire:model.defer="state.txt_plazo">
                        </div>
                        @error('txt_plazo') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="garantia">Garantia(meses)*</label>
                            <input id="garantia" type="number" class="form-control" placeholder="# meses" wire:model.defer="state.garantia">
                        </div>
                        @error('garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="txt_garantia">Texto Garantia*</label>
                            <input id="txt_garantia" type="text" class="form-control" placeholder="contra todo defecto de fabrica" wire:model.defer="state.txt_garantia">
                        </div>
                        @error('txt_garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-1 mt-5">
                        <div class="custom-control custom-switch">
                            <input wire:model.defer="state.foto" type="checkbox" class="custom-control-input" id="sidebarCollapse1">
                            <label class="custom-control-label" for="sidebarCollapse1">Firma</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="direccion_entrega">Direccion entrega*</label>
                            <input id="direccion_entrega" type="text" class="form-control" placeholder="Los olivos 123" wire:model.defer="state.direccion_entrega">
                        </div>
                        @error('direccion_entrega') <span class="text-danger er">{{ $message }}</span>@enderror
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
                                        <input class="form-control text-center" type="text" value="{{ $producto['nombre'] }}" disabled>
                                    </td>
                                    <td class="text-center">
                                        <textarea wire:change="cambiarDetalle($event.target.value, {{ $key }})" class="overflow-auto form-control" name="descripcion" cols="40" rows="4">{{ $producto['descripcion'] }}</textarea>
                                    </td>
                                    <td class="text-center">
                                        <input wire:change="calculateAmount($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="cantidad" size="5" value="{{number_format($producto['cantidad'],2)}}">
                                    </td>
                                    <td class="text-center">
                                        <input wire:change="calculatePrice($event.target.value, {{ $key }})" type="text" class="form-control text-center" name="precio_u" size="5" value="{{ number_format($producto['precio_u'],2) }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control text-center" name="precio_t" value="{{ number_format($lista[$key]['precio_t'],2) ?? 0 }}" size="5" disabled>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" wire:click="deleteRow({{ $key }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="lead">Terminos:</p>
                        <textarea wire:model.defer="state.terminos" class="form-control" rows="5"></textarea>
                    </div>
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
                                    <th>
                                        <select wire:model.defer="state.impuesto_id" class="form-control" wire:change="calculateTaxAmount(event.target.value)">
                                            <option value="0">Seleccionar impuesto</option>
                                            @foreach($impuestos as $impuesto)
                                                <option value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('impuesto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                                    </th>
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
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa fa-save mr-1"></i> Guardar
                        </button>
                        <a href="{{route('proyecto.show', $proyecto)}}">
                            <button type="button" class="btn btn-light border border-secondary float-right mr-1">
                                <i class="fa fa-times mr-1"></i> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function (){
                $('#sidebarCollapse1').on('change', function() {
                    $('body').toggleClass('sidebar-collapse1');
                })
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
