<div>
    <section>
        <div class="card">
            <div class="card-header">
                <button class="my-0 btn btn-outline-info btn-sm " id='btn_print' onclick="printDiv('areaImprimir')">
                    <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                </button>
                <a href="{{route('purchases')}}" class="btn btn-primary float-right">Atras</a>
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
                        <b>{{$purchase->user->name}}</b>
                        <p>
                            <b>{{$empresa->nombre}}</b> <br>
                            {{$empresa->ruc}}<br>
                            {{$empresa->direccion}}<br>
                            Lima - Perú<br>
                            +51 994 422 160
                        </p>
                    </div>
                    <div class="col-4">
                        <b>{{ $purchase->atendido }}</b>
                        <p>
                            <b>{{ $purchase->proveedor->razon_social }}</b><br>
                            {{ $purchase->proveedor->ruc }}<br>
                            {{ $purchase->proveedor->direccion }}<br>
                            Anhui, China<br>
                            {{$purchase->proveedor->telefono}}
                        </p>
                    </div>
                    <div class="col-4">
                        <p>
                            <b>Order number: #{{ $purchase->codigo }}</b><br>
                            <b>Order date:</b> {{ $purchase->fecha}}<br>
                            <b>Supplier number: </b>A019
                        </p>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">#</th>
                            <th scope="col" class="text-left" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">DESCRIPTION</th>
                            <th scope="col"class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">QTY</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">UNIT PRICE</th>
                            <th scope="col" class="text-center" style="border-bottom: 1px solid #000000;border-top: 1px solid #000000;">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchase->purcharseItem as $item)
                            <tr>
                                <th scope="row" style="border-top: 1px solid #000000;">{{$loop->iteration}}</th>
                                <td style="width:55%;border-top: 1px solid #000000;" class="text-left">
                                    {{$item->producto->nombre}} <br>
                                    {!! nl2br(htmlspecialchars($item->descripcion)) !!}
                                </td>
                                <td class="text-center" style="border-top: 1px solid #000000;">{{$item->cantidad}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">$ {{number_format($item->precio_u,2)}}</td>
                                <td class="text-center" style="border-top: 1px solid #000000;">$ {{number_format($item->precio_t,2)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-3">
                        <table class="table table-bordered">
                            <tr>
                                <td><b>CURRENT</b></td>
                                <td class="py-2">{{$purchase->moneda}}</td>
                            </tr>
                            <tr>
                                <td><b>INCOTERM</b></td>
                                <td class="py-2">{{$purchase->incoterm}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <table width="100%" cellspacing="0px" border="0">
                            <tr>
                                <td class="border-0"><b>SUB TOTAL</b></td>
                                <td class="py-2 border-0">$ {{number_format($purchase->subtotal,2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>SALES TAX</b></td>
                                <td class="py-2 border-0">$ {{number_format($purchase->salestax,2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>HANDLING & PACKAGING</b></td>
                                <td class="py-2 border-0">$ {{number_format($purchase->handling,2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-0"><b>OTHER (FREIGHT & INSURANCE)</b></td>
                                <td class="py-2 border-0">$ {{number_format($purchase->otros,2)}}</td>
                            </tr>
                            <tr style="border: black 2px solid;">
                                <td class="border-0" style="padding:8px !important;"><b>TOTAL</b></td>
                                <td class="py-8 border-0" style="color: blue;padding:8px !important;">$ {{number_format($purchase->total,2)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <p>
                            {!! nl2br(htmlspecialchars($purchase->terminos)) !!}
                        </p>
                    </div>
                </div>
                <br>
                @if($purchase->foto)
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
