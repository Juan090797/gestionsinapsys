<div>
    <section>
        <div class="card">
            <div class="card-header">
                <button class="my-0 btn btn-outline-info btn-sm " id='btn_print' onclick="printDiv('areaImprimir')">
                    <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                </button>
                <a href="{{route('proyecto.show', $cotizacion->proyecto_id)}}" class="btn btn-primary float-right">Atras</a>
            </div>
        </div>
    </section>
    <section class="container mt-2" id="areaImprimir">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h2 class="header-logo"><img style="width: 100%" src="{{ asset('/img/logo.png') }}" class="invoice-logo"></h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <b>{{$empresa->nombre}}</b>
                        <p>
                            <b>Ruc:</b> {{$empresa->ruc}}<br>
                            <b>Direccion:</b> {{$empresa->direccion}}<br>
                            <b>Telefono:</b> {{$empresa->telefono}}<br>
                            <b>Correo:</b> {{$empresa->correo}}
                        </p>
                    </div>
                    <div class="col-4">
                        <b>{{$cliente->razon_social}}</b>
                        <p>
                            <b>Ruc:</b> {{$cliente->ruc}}<br>
                            <b>Direccion:</b> {{$cliente->direccion}}<br>
                            <b>Telefono:</b> {{$cliente->telefono}}<br>
                            <b>Correo:</b> {{$cliente->correo}}
                        </p>
                    </div>
                    <div class="col-4">
                        <b>Cotizacion: #{{$cotizacion->codigo}}</b>
                        <p>
                            <b>Fecha Cotizacion:</b> {{$cotizacion->formate_fechai}}<br>
                            <b>Fecha Caducidad:</b> {{$cotizacion->formate_fechac}}<br>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-left">PRODUCTO</th>
                            <th scope="col"class="text-center">CANTIDAD</th>
                            <th scope="col" class="text-center">PRECIO</th>
                            <th scope="col" class="text-center">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cotizacion->CotizacionItem as $item)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td style="width:55%" class="text-left">{!! nl2br(htmlspecialchars($item->producto->descripcion)) !!}</td>
                                <td class="text-center">{{$item->cantidad}}</td>
                                <td class="text-center">S/ {{number_format($item->precio,2)}}</td>
                                <td class="text-center">S/ {{number_format($item->monto,2)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <table width="100%" cellspacing="0px" border="0">
                            <tr>
                                <td class="border-0"><b>SubTotal</b></td>
                                <td class="py-2 border-0">S/ {{number_format($cotizacion->subtotal,2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>IGV {{$cotizacion->Impuesto->nombre}}</b></td>
                                <td class="py-2 border-0">S/ {{number_format($cotizacion->impuesto,2)}}</td>
                            </tr>
                            <tr>
                                <td class="py-3"></td>
                                <td class="py-3"></td>
                            </tr>
                            <tr style="border: black 2px solid;">
                                <td class="border-0" style="padding:8px !important;"><b>Total</b></td>
                                <td class="py-8 border-0" style="color: blue;padding:8px !important;">S/ {{number_format($cotizacion->total,2)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <p>
                            <b>Formas de Pago:</b><br>
                            {!! nl2br(htmlspecialchars($cotizacion->terminos)) !!}
                        </p>
                        <p>
                            <b>Condiciones Comerciales:</b><br>
                            {!! nl2br(htmlspecialchars($cotizacion->condiciones)) !!}
                        </p>
                    </div>
                </div>
                @if($cotizacion->foto)
                    <div>
                        <table width="100%">
                            <tr>
                                <td class="text-left">
                                    <h2 class="header-logo"><img src="{{ asset('/storage/firmas/grupomarquina.png') }}" class="invoice-logo"> </h2>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @push('js')
        <script>
            function printDiv(areaImprimir) {
                var contenido = document.getElementById(areaImprimir).innerHTML;
                var contenidoOriginal = document.body.innerHTML;
                document.body.innerHTML = contenido;
                window.print();
                document.body.innerHTML = contenidoOriginal;
            }
        </script>
    @endpush
</div>
