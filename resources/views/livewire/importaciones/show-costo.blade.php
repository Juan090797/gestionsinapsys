<div>
    @section('cabezera-contenido')
        <a href="{{route('purchase.create')}}" class="btn btn-primary float-right">Agregar Gasto</a>
        <h1>Costeos</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-12">
                @foreach($costos as $costo)
                <div class="card">
                    <div class="card-header"><h5>{{$costo->tipo_costeo}}</h5></div>
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
                                <th scope="col"></th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">IGV</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Precio de compra</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Flete</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Seguro</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Pick-up</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Embalaje</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">SHA</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            <tr>
                                <th scope="row">OUR</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">AWB</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">CCA</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">AS agreed</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
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
                                <th scope="col"></th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">IGV</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Precio de compra</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Flete</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Seguro</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Pick-up</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">Embalaje</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">SHA</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            <tr>
                                <th scope="row">OUR</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">AWB</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">CCA</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <th scope="row">AS agreed</th>
                                <td>100</td>
                                <td>50</td>
                                <td>100</td>
                                <td>200</td>
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

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Gasto de derechos</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('empresa-ok', msg =>{
                noty(msg)
            })
        });
    </script>
</div>
