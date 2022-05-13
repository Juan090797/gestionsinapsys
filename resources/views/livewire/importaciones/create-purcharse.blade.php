<div>
    @section('cabezera-contenido')
        <a href="{{route('purchases')}}" class="btn btn-primary float-right">Atras</a>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="crearPurcharse">
            <div class="card p-3 mb-3" wire:ignore.self>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="proveedor_id">Proveedor</label>
                                <select id="proveedor_id" class="form-control" wire:model.defer="state.proveedor_id">
                                    <option value="">Seleccionar proveedor</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
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
                                <label for="date">Fecha*</label>
                                <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date" wire:model.defer="state.fecha">
                            </div>
                            @error('fecha') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-1 mt-5">
                            <div class="custom-control custom-switch">
                                <input wire:model.defer="state.foto" type="checkbox" class="custom-control-input" id="sidebarCollapse1">
                                <label class="custom-control-label" for="sidebarCollapse1">Firma</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="incoterm">Incoterm</label>
                                <select id="incoterm" class="form-control" wire:model.defer="state.incoterm">
                                    <option value="">Seleccionar Incoterm</option>
                                    <option value="EXW">EXW</option>
                                    <option value="FOB">FOB</option>
                                    <option value="CPT">CPT</option>
                                    <option value="CIP">CIP</option>
                                    <option value="DOOR TO DOOR">DOOR TO DOOR</option>
                                </select>
                            </div>
                            @error('incoterm') <span class="text-danger er">{{ $message }}</span>@enderror
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
                        <div class="col-6">
                            <p class="lead">Terminos:</p>
                            <textarea wire:model.defer="state.terminos" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4">
                            <p class="lead">Detalle</p>
                            <p class="lead"><b>Total Items: {{$cantidadTotal}}</b> </p>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td>$ {{number_format($subTotal,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax:</th>
                                        <td>$ {{number_format($impuestoD,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th>HANDLING & PACKAGING:</th>
                                        <td><input type="number" class="form-control" wire:model="handling"></td>
                                    </tr>
                                    <tr>
                                        <th>OTHER (FREIGHT & INSURANCE):</th>
                                        <td><input type="number" class="form-control" wire:model="otros"></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$ {{number_format($total,2)}}</td>
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
                            <a href="#">
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
