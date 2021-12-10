<div>
    @section('cabezera-contenido')
        <a href="{{url('pedidos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Crear Pedido</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Cotizacion:</label>
                        <select wire:model.defer="state.cotizacion_id" class="form-control" wire:change="GetCotizacion(event.target.value)">
                            <option value="0">Cotizaciones</option>
                            @foreach($cotizaciones as $c)
                                <option value="{{ $c->id }}">{{ $c->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <b>Cotizacion #{{$codigo}}</b>
                            <small class="float-right">Fecha: {{date("d-m-Y")}}</small>
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label for="">Cliente:</label>
                            <input type="text" class="form-control" value="{{$cliente}}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label for="">Atencion:</label>
                            <input type="text" class="form-control" value="{{$atendido}}" disabled>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label for="date">Fecha *</label>
                            <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date">
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label for="due_date">Fecha Fin *</label>
                            <input class="form-control" type="date" aria-label="Use the arrow keys to pick a date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-4">
                        <p class="lead">Terminos:</p>
                        <p>{{$terminos}}</p>

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <p class="lead">Condiciones:</p>
                        <p>{{$condiciones}}</p>
                    </div>
                    <div class="col-4">
                        <p class="lead">Detalle</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>S/ {{number_format($subTotal,2)}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <select class="form-control">
                                            <option value="0">Impuestos</option>
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
            </div>
        </div>
    </div>
</div>
