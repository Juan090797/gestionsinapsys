<div>
    <section>
        <div class="card">
            <div class="card-header">
                <button class="my-0 btn btn-outline-info btn-sm " id='btn_print' onclick="printDiv('areaImprimir')">
                    <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                </button>
                <a href="{{route('ordenes')}}" class="btn btn-primary float-right">Atras</a>
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
                        <b>{{$ordencompra->proveedor->razon_social}}</b>
                        <p>
                            <b>Ruc:</b> {{$ordencompra->proveedor->ruc}}<br>
                            <b>Direccion:</b> {{$ordencompra->proveedor->direccion}}<br>
                            <b>Telefono:</b> {{$ordencompra->proveedor->telefono}}<br>
                            <b>Correo:</b> {{$ordencompra->proveedor->correo}}
                        </p>
                    </div>
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
                        <p>
                            <b>N° Orden: #{{$ordencompra->codigo}}</b><br>
                            <b>Fecha:</b> {{$ordencompra->fecha_documento}}<br>
                            <b>Referencia:</b> {{$ordencompra->referencia}}<br>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">#</th>
                            <th scope="col" class="text-left" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">PRODUCTO</th>
                            <th scope="col"class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">U.M.</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">CANTIDAD</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">PRECIO UNI.</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ordencompra->ordenDetalles as $item)
                            <tr>
                                <th scope="row" style="border-top: 1px solid #000000;">{{$loop->iteration}}</th>
                                <td style="width:55%;border-top: 1px solid #000000;" class="text-left">
                                    {{$item->producto->nombre}} <br>
                                </td>
                                <td class="text-center" style="border-top: 1px solid #000000;">{{$item->producto->unidad->nombre}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">{{$item->cantidad}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">S/ {{$item->precio_unitario}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">S/ {{$item->precio_total}}</td>
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
                                <td class="py-3"></td>
                                <td class="py-3"></td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>Total Items</b></td>
                                <td class="py-2 border-0">{{$ordencompra->total_items}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>SubTotal</b></td>
                                <td class="py-2 border-0">S/ {{number_format($ordencompra->subtotal,2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>IGV 18%</b></td>
                                <td class="py-2 border-0">S/ {{number_format($ordencompra->impuesto,2)}}</td>
                            </tr>
                            <tr>
                                <td class="py-3"></td>
                                <td class="py-3"></td>
                            </tr>
                            <tr style="border: black 2px solid;">
                                <td class="border-0" style="padding:8px !important;"><b>Total</b></td>
                                <td class="py-8 border-0" style="color: blue;padding:8px !important;">S/ {{number_format($ordencompra->total,2)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-10">
                        <p>
                            <b>Formas de Pago:</b><br>
                            {!! nl2br(htmlspecialchars($ordencompra->terminos)) !!}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-2">
                        <p>Firma:</p>
                    </div>
                    <div class="col-3">
                        <hr style="border-top: 3px solid rgb(26 25 25);">
                    </div>
                </div>
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
