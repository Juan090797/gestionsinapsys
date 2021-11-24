<!DOCTYPE html>
<html>

<head>
    <title>Cotizacion_{{$cotizacion->id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        /* -- Base -- */
        body {
            font-family: "DejaVu Sans";
        }

        html {
            margin: 0px;
            padding: 0px;
            margin-top: 50px;
        }

        .text-center {
            text-align: center
        }

        hr {
            margin: 0 30px 0 30px;
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #000000;
        }

        /* -- Header -- */

        .header-bottom-divider {
            color: rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 90px;
            left: 0px;
            width: 100%;
        }

        .header-container {
            position: absolute;
            width: 100%;
            height: 90px;
            left: 0px;
            top: -50px;
        }

        .header-logo {
            height: 50px;
            margin-top: 20px;
            text-transform: capitalize;
            color: #817AE3;
        }

        .content-wrapper {
            display: block;
            margin-top: 0px;
            padding-top: 16px;
            padding-bottom: 20px;
        }

        .company-address-container {
            padding-top: 15px;
            padding-left: 30px;
            float: left;
            width: 30%;
            text-transform: capitalize;
            margin-bottom: 2px;
        }
        .company-address-container-cliente {
            padding-top: 15px;
            float: left;
            width: 30%;
            text-transform: capitalize;
            margin-bottom: 2px;
        }

        .company-address-container h1 {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            margin-bottom: 0px;
            margin-top: 10px;
        }

        .company-address {
            margin-top: 2px;
            text-align: left;
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            width: 280px;
            word-wrap: break-word;
        }

        /* -- Items Table -- */

        .items-table {
            margin-top: 35px;
            padding: 0px 30px 10px 30px;
        }

        .items-table hr {
            height: 0.1px;
        }

        .item-table-heading {
            font-size: 13.5;
            text-align: center;
            color: rgba(0, 0, 0, 0.85);
            padding: 5px;
            color: #55547A;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #000000;
            font-size: 12px;
            line-height: 18px;
        }

        tr.item-row td {
            font-size: 12px;
            line-height: 18px;
        }

        .item-cell {
            font-size: 13;
            text-align: center;
            padding: 5px;
            padding-top: 10px;
            color: #040405;
        }

        .item-description {
            color: #595959;
            font-size: 9px;
            line-height: 12px;
        }

        /* -- Total Display Table -- */

        .total-display-container {
            padding: 0 25px;
        }

        .total-display-table {
            border-top: none;
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            margin-left: 500px;
            margin-top: 20px;
        }

        .total-table-attribute-label {
            font-size: 13px;
            color: #55547A;
            text-align: left;
            padding-left: 10px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 13px;
            color: #040405;
            padding-right: 10px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .total-border-left {
            border: 1px solid #000000 !important;
            border-right: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        .total-border-right {
            border: 1px solid #000000 !important;
            border-left: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        /* -- Notes -- */

        .notes {
            font-size: 9px;
            color: #595959;
            margin-top: 15px;
            margin-left: 30px;
            width: 300px;
            text-align: left;
            page-break-inside: avoid;
        }

        .notes-label {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            color: #040405;
            width: 250px;
            height: 19.87px;
            padding-bottom: 10px;
        }

        /* -- Helpers -- */

        .text-center {
            text-align: center
        }

        table .text-left {
            text-align: left;
        }

        table .text-right {
            text-align: right;
        }

        .border-0 {
            border: none;
        }

        .py-2 {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .py-8 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .py-3 {
            padding: 3px 0;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pl-0 {
            padding-left: 0;
        }
        .invoice-logo{
            max-height: 120px;
            max-width: 240px;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <table width="100%">
            <tr>
                <td class="text-left">
                    <h2 class="header-logo"><img src="{{ public_path('/img/logo.png') }}" class="invoice-logo"> </h2>
                </td>
            </tr>
        </table>
        <hr class="header-bottom-divider" style="border: 0.620315px solid #000000;" />
    </div>
    <div class="content-wrapper">
        <div style="padding-top: 30px">
            <div class="company-address-container company-address">
                <address>
                    <strong>{{$empresa->nombre}}</strong><br>
                    {{$empresa->direccion}}<br>
                    Telefono: {{$empresa->telefono}}<br>
                    Correo: {{$empresa->correo}}<br>
                </address>
            </div>
            <div class="company-address-container-cliente company-address">
                <address>
                    <strong>{{ $client->razon_social }}</strong><br>
                    {{ $client->direccion }}<br>
                    Telefono: {{ $client->telefono }}<br>
                    Correo: {{ $client->correo }}
                </address>
            </div>
            <div class="company-address-container-cliente company-address">
                <address>
                    <strong>Cotizacion# {{ $cotizacion->codigo }}</strong><br>
                    F.Cotizacion: {{ $cotizacion->fecha_inicio }}<br>
                    F.Caducidad: {{ $cotizacion->fecha_fin }}<br>
                </address>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="position: relative; clear: both;">
        <!-- table start -->
        <table width="100%" class="items-table" cellspacing="0" border="0">
                <tr class="item-table-heading-row">
                    <th width="2%" class="pr-20 text-right item-table-heading">#</th>
                    <th width="40%" class="pl-0 text-left item-table-heading">Producto</th>
                    <th class="pr-20 text-center item-table-heading">Cantidad</th>
                    <th class="pr-20 text-center item-table-heading">Precio</th>
                    <th class="text-center item-table-heading">Total</th>
                </tr>
                @php
                    $index = 1
                @endphp
                @foreach ($cotizacion->CotizacionItem as $item)
                    <tr class="item-row">
                        <td class="pr-20 text-right item-cell" style="vertical-align: top;">
                            {{$index}}
                        </td>
                        <td class="pl-0 text-left item-cell" style="vertical-align: top;word-break: break-all;">
                            <span class="item-description">{!! nl2br(htmlspecialchars($item->producto->descripcion)) !!}</span>
                        </td>
                        <td class="pr-20 text-center item-cell" style="vertical-align: top;">
                            {{$item->cantidad}}
                        </td>
                        <td class="pr-20 text-center item-cell" style="vertical-align: top;">
                            S/ {{number_format($item->precio,2)}}
                        </td>

                        <td class="text-center item-cell" style="vertical-align: top;">
                            S/ {{number_format($item->monto,2)}}
                        </td>
                    </tr>
                    @php
                        $index += 1
                    @endphp
                @endforeach
            </table>


            <hr class="item-cell-table-hr">

            <div class="total-display-container">
                <table width="100%" cellspacing="0px" border="0" class="total-display-table @if(count($cotizacion->CotizacionItem) > 12) page-break @endif">
                    <tr>
                        <td class="border-0 total-table-attribute-label">SubTotal</td>
                        <td class="py-2 border-0 item-cell total-table-attribute-value">
                            S/ {{number_format($cotizacion->subtotal,2)}}
                        </td>
                    </tr>

                    <tr>
                        <td class="border-0 total-table-attribute-label">
                            IGV {{$cotizacion->Impuesto->nombre}}
                        </td>
                        <td class="py-2 border-0 item-cell total-table-attribute-value">
                            S/ {{number_format($cotizacion->impuesto,2)}}
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3"></td>
                        <td class="py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-0 total-border-left total-table-attribute-label">
                            Total
                        </td>
                        <td class="py-8 border-0 total-border-right item-cell total-table-attribute-value" style="color: #5851D8">
                            S/ {{number_format($cotizacion->total,2)}}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- table end -->
        </div>
        <div class="notes">
                <div class="notes-label">
                    Formas de Pago:
                </div>
                {!! nl2br(htmlspecialchars($cotizacion->terminos)) !!}
        </div>
        <div class="notes">
            <div class="notes-label">
                Condiciones Comerciales:
            </div>
            c
        </div>
    </div>
    @if($cotizacion->foto)
        <div>
            <table width="100%">
                <tr>
                    <td class="text-left">
                        <h2 class="header-logo"><img src="{{ public_path('/storage/firmas/grupomarquina.png') }}" class="invoice-logo"> </h2>
                    </td>
                </tr>
            </table>
        </div>
    @endif
</body>
</html>
