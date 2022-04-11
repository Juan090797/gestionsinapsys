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
                <hr style="border: 0.620315px solid #E8E8E8;">
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
                            <b>Ruc:</b> {{ $cliente->ruc }}<br>
                            <b>Direccion:</b> {{ $cliente->direccion }}<br>
                            <b>Telefono:</b> {{ $cliente->telefono }}<br>
                            <b>Correo:</b> {{ $cliente->correo }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p>
                            <b>Cotizacion: #{{ $cotizacion->codigo }}</b><br>
                            <b>Fecha:</b> {{ $cotizacion->inicio}}<br>
                            <b>Vencimiento:</b> {{ $cotizacion->fin }}<br>
                            <b>Atencion:</b> {{ $cotizacion->atendido }}<br>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">#</th>
                            <th scope="col" class="text-left" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">PRODUCTO</th>
                            <th scope="col"class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">CANTIDAD</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">PRECIO</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cotizacion->CotizacionItem as $item)
                            <tr>
                                <th scope="row" style="border-top: 1px solid #000000;">{{$loop->iteration}}</th>
                                <td style="width:55%;border-top: 1px solid #000000;" class="text-left">
                                    {{$item->producto->nombre}} <br>
                                    {!! nl2br(htmlspecialchars($item->descripcion)) !!}
                                </td>
                                <td class="text-center" style="border-top: 1px solid #000000;">{{$item->cantidad}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">S/ {{number_format($item->precio_u,2)}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">S/ {{number_format($item->precio_t,2)}}</td>
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
                            Plazo de entrega: {{$cotizacion->plazo_entrega}} dias {{$cotizacion->txt_plazo}}
                            <br>
                            Lugar de entrega: {{$cotizacion->direccion_entrega}}
                            <br>
                            Garantia: {{$cotizacion->garantia}} meses {{$cotizacion->txt_garantia}}
                            <br>
                            @if($cotizacion->txt_mantenimiento)
                                Mantenimientos preventivos: {{$cotizacion->txt_mantenimiento}}
                            @endif
                        </p>
                    </div>
                </div>
                @if($cotizacion->archivo_cotizacion)
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset("/storage/cotizaciones/$cotizacion->archivo_cotizacion") }}" class="invoice-logo" style="width: 100%">
                        </div>
                    </div>
                @endif
                <br>
                @if($cotizacion->foto)
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('/storage/firmas/firma.png') }}" class="invoice-logo" style="width: 100%">
                        </div>
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
