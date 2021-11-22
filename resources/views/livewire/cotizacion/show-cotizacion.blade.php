<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <a href="{{route('proyecto.show', $cotizacion->proyecto_id)}}" class="btn btn-primary float-right">Atras</a>
                        <h1>Cotizacion del proyecto # {{$cotizacion->proyecto_id}}</h1>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content-fluid">
        <form wire:submit.prevent="createInvoice">
            <section class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <i class="fas fa-globe"></i> {{$empresa->nombre}}
                            <small class="float-right">Fecha: {{date("d-m-Y")}}</small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        De
                        <address>
                            <strong>Ventas</strong><br>
                            {{$empresa->direccion}}<br>
                            Telefono: {{$empresa->telefono}}<br>
                            Correo: {{$empresa->correo}}
                        </address>
                        <div class="custom-control custom-switch">
                            <input wire:model="state.foto" type="checkbox" class="custom-control-input" id="sidebarCollapse" disabled>
                            <label class="custom-control-label" for="sidebarCollapse">Firma</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Cotizado a
                        <address>
                            <strong>{{ $cliente->razon_social }}</strong><br>
                            {{ $cliente->direccion }}<br>
                            Telefono: {{ $cliente->telefono }}<br>
                            Correo: {{ $cliente->correo }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Cotizacion# {{$cotizacion->codigo}}</b><br>
                        <br>
                        <b>Fecha:</b> {{ $cotizacion->fecha_inicio }}<br>
                        <b>Fecha Fin:</b> {{ $cotizacion->fecha_fin}}<br>
                        <br>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cotizacion->CotizacionItem as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{$item->producto->codigo}}</td>
                                    <td class="text-center">{{$item->cantidad}}</td>
                                    <td class="text-center">S/ {{number_format($item->precio,2)}}</td>
                                    <td class="text-center">S/ {{number_format($item->monto,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-4">
                        <p class="lead">Terminos:</p>
                        <textarea class="form-control" rows="5" disabled>{{$cotizacion->terminos}}</textarea>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <p class="lead">Condiciones:</p>
                        <textarea class="form-control" rows="5" disabled>{{$cotizacion->condiciones}}</textarea>
                    </div>
                    <div class="col-4">
                        <p class="lead">Detalle</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>S/ {{number_format($cotizacion->subtotal,2)}}</td>
                                </tr>
                                <tr>
                                    <th>IGV {{$cotizacion->Impuesto->nombre}}</th>
                                    <td>S/ {{number_format($cotizacion->impuesto,2)}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>S/ {{number_format($cotizacion->total,2)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <a href="{{ route('cotizacion.imprimir', $cotizacion) }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                    </div>
                </div>
                <!-- /.row -->
            </section>
        </form>
    </div>
</div>
