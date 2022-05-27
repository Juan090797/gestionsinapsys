<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar Gasto</a>
        <a href="{{route('purchases')}}" class="btn btn-secondary float-left mr-3">Atras</a><h1>Costeos</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-12">
                @foreach($orden->costos as $costo)
                <div class="card">
                    <div class="card-header"><h5>COSTEO {{$costo->tipo_costeo}}#{{$costo->id}}</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-sm table-hover table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Producto</th>
                                        <td>{{$costo->producto->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Invoice</th>
                                        <td>{{$costo->invoice}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Peso</th>
                                        <td>{{$costo->peso}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nº AWB</th>
                                        <td>{{$costo->costeable->num_awb}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Proveedor</th>
                                        <td>{{$costo->proveedor->razon_social}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Origen</th>
                                        <td>{{$costo->origen}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Aerolinea</th>
                                        <td>{{$costo->costeable->aerolinea}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ETA</th>
                                        <td>{{$costo->costeable->eta}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Guia madre</th>
                                        <td>{{$costo->costeable->guia_madre}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Express</th>
                                        <td><i class="fa fa-check-circle" aria-hidden="true" style="{{$costo->express == true ? 'color:blue' : null}}"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Bultos</th>
                                            <td>{{$costo->bultos}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Volumen</th>
                                            <td>{{$costo->volumen}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Consignatario</th>
                                            <td>{{$costo->consignatario}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Consolidacion</th>
                                            <td>{{$costo->consolidacion}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Salida</th>
                                            <td>{{$costo->salida}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Almacen</th>
                                            <td>{{$costo->almacen}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Operador aeroportuario</th>
                                            <td>{{$costo->costeable->operador_aeroportuario}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Otro</th>
                                            <td>{{$costo->costeable->otro}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Agente</th>
                                            <td>{{$costo->agente}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Gasto en origen</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Concepto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">IGV</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orden->gastos as $gasto)
                                @if($gasto->tipo == 'ORIGEN')
                                    <tr>
                                        <th scope="row">{{$gasto->concepto}}</th>
                                        <td class="text-center">{{$gasto->cantidad}}</td>
                                        <td class="text-center">{{number_format($gasto->subtotal,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->igv,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->total,2)}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">TOTAL</td>
                                <td class="bg-primary text-center">{{number_format($sumaOrigen,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Gasto en destino</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Concepto</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">IGV</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orden->gastos as $gasto)
                                @if($gasto->tipo == 'DESTINO')
                                    <tr>
                                        <th scope="row">{{$gasto->concepto}}</th>
                                        <td class="text-center">{{number_format($gasto->subtotal,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->igv,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->total,2)}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td class="text-center"></td>
                                <td class="text-center">TOTAL</td>
                                <td class="bg-primary text-center">{{number_format($sumaDestino,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Gasto de agenciamiento</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Concepto</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">IGV</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orden->gastos as $gasto)
                                @if($gasto->tipo == 'AGENCIAMIENTO')
                                    <tr>
                                        <th scope="row">{{$gasto->concepto}}</th>
                                        <td class="text-center">{{number_format($gasto->subtotal,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->igv,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->total,2)}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td class="text-center"></td>
                                <td class="text-center">TOTAL</td>
                                <td class="bg-primary text-center">{{number_format($sumaAgenciamiento,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Gasto de derechos</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Concepto</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">IGV</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orden->gastos as $gasto)
                                @if($gasto->tipo == 'DERECHOS')
                                    <tr>
                                        <th scope="row">{{$gasto->concepto}}</th>
                                        <td class="text-center">{{number_format($gasto->subtotal,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->igv,2)}}</td>
                                        <td class="text-center">{{number_format($gasto->total,2)}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td class="text-center"></td>
                                <td class="text-center">TOTAL</td>
                                <td class="bg-primary text-center">{{number_format($sumaDerecho,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.importaciones.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('hide-modal', msg =>{
                $('#theModal').modal('hide');
            })
        });
    </script>
</div>
