<div>
    @section('cabezera-contenido')
        <a href="{{route('proyecto.show', $proyecto)}}" class="btn btn-primary float-right">Atras</a>
        <h1>Cotizacion del proyecto # {{$proyecto->id}}</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="createInvoice">
        <section class="invoice p-3 mb-3" wire:ignore.self>
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <b>Cotizacion #{{$code}}</b>
                        <small class="float-right">Fecha: {{date("d-m-Y")}}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                        <label for="">Cliente:</label>
                        <input type="text" class="form-control" value="{{ $cliente[0]->razon_social ?? ''}}" disabled>
                    </div>
                </div>
                <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                        <label for="">Atencion:</label>
                        <input type="text" class="form-control" wire:model.defer="state.atendido">
                    </div>
                    @error('atendido') <span class="text-danger er">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                        <label for="date">Fecha *</label>
                        <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date" wire:model.defer="state.fecha_inicio">
                    </div>
                    @error('fecha_inicio') <span class="text-danger er">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                        <label for="due_date">Fecha Fin *</label>
                        <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date" wire:model.defer="state.fecha_fin">
                    </div>
                    @error('fecha_fin') <span class="text-danger er">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-4 mt-5">
                    <div class="custom-control custom-switch">
                        <input wire:model.defer="state.foto" type="checkbox" class="custom-control-input" id="sidebarCollapse1">
                        <label class="custom-control-label" for="sidebarCollapse1">Firma</label>
                    </div>
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
                                            <option {{ ($producto->id == $rows[$key]['producto_id']) ? 'selected' : '' }} value="{{ $producto->id }}">{{$producto->codigo .'-(' . $producto->stock . ')'}}</option>
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
                    <p class="lead">Terminos:</p>
                    <textarea wire:model.defer="state.terminos" class="form-control" rows="5">
                    </textarea>
                </div>
                <div class="col-4">
                    <p class="lead">Condiciones:</p>
                    <textarea wire:model.defer="state.condiciones" class="form-control" rows="5"></textarea>
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
                                <th>
                                    <select wire:model.defer="state.impuesto_id" class="form-control" wire:change="calculateTaxAmount(event.target.value)">
                                        <option value="0">Impuestos</option>
                                        @foreach($impuestos as $impuesto)
                                            <option value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                        @endforeach
                                    </select>
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
                <!-- /.col -->
            </div>
            <div class="row no-print">
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
            <!-- /.row -->
        </section>
        </form>
    </div>
    @push('js')
    <script>
        $('#sidebarCollapse1').on('change', function() {
            $('body').toggleClass('sidebar-collapse1');
        })
    </script>
    @endpush
        <script>
            document.addEventListener('DOMContentLoaded', function (){
                window.livewire.on('cotizacion-ok', msg =>{
                    noty(msg)
                })
            });
        </script>
</div>
