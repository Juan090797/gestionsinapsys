<div>
    <section>
        <div class="card">
            <div class="card-header">
                <button class="my-0 btn btn-outline-info btn-sm " id='btn_print' onclick="printDiv('areaImprimir')">
                    <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                </button>
                <a href="{{route('caja-movimientos', $movimiento->caja_id)}}" class="btn btn-primary float-right">Atras</a>
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
                    <div class="col-12">
                        <h2 class="text-bold text-center">RECIBO DE GASTOS</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <b>Recibi:</b>S/ {{ number_format($movimiento->importe,2) }}<br>
                        <b>Por concepto de:</b> {{$movimiento->concepto}} <br>
                        <b>Motivo:</b> {{$movimiento->motivo}}<br>
                        <b>Cliente:</b> {{$movimiento->cliente->razon_social ?? null}}<br>
                        <b>Referencia:</b> {{$movimiento->referencia}}<br>
                    </div>
                    <div class="col-4">
                        <b>Nombre:</b> {{ $movimiento->usuario->name }}<br>
                        <b>Area:</b> {{ $movimiento->usuario->area }}<br>
                        <b>Fecha:</b> {{ date('d-m-Y', strtotime($movimiento->fecha)) }}<br>
                        <br>
                        <b>Firma:</b><hr style="border: 0.620315px solid #000000; width: 40%">
                    </div>
                    <div class="col-2">
                        <b></b> <br>
                        <b></b> <br>
                        <b></b><br>
                        <br>
                        <b>V°B°:</b><hr style="border: 0.620315px solid #000000; width: 50%">
                    </div>
                </div>
                <hr style="border: 0.620315px solid #E8E8E8;">
                <div class="row">
                    <div class="col-12">
                        <p>
                            <b>Detalle:</b> <br>
                            {{$movimiento->detalle}} <br>
                        </p>
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
