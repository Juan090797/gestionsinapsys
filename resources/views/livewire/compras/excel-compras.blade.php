<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Periodo</th>
        <th>Fecha Documento</th>
        <th>Fecha Pago</th>
        <th>Tipo Documento</th>
        <th>Serie Documento</th>
        <th>N° Documento</th>
        <th>Tipo Doc. Proveedor</th>
        <th>N° Documento</th>
        <th>Razon Social</th>
        <th>Base imponible</th>
        <th>Igv</th>
        <th>ICBPER</th>
        <th>Otros Gastos</th>
        <th>Total</th>
        <th>Moneda</th>
        <th>Tipo Cambio</th>
        <th>Detalle</th>
        <th>Centro Costo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($compras as $compra)
        <tr>
            <td>{{ $compra->id }}</td>
            <td>{{ $compra->periodo }}</td>
            <td>{{ date('d-m-Y', strtotime($compra->fecha_documento)) }}</td>
            <td>{{ date('d-m-Y', strtotime($compra->fecha_pago)) }}</td>
            <td>{{ $compra->tipo_documento}}</td>
            <td>{{ $compra->serie_documento }}</td>
            <td>{{ $compra->numero_documento }}</td>
            <td>{{ $compra->proveedor->tipo_documento}}</td>
            <td>{{ $compra->proveedor->ruc }}</td>
            <td>{{ $compra->proveedor->razon_social }}</td>
            <td>S/ {{ $compra->subtotal}}</td>
            <td>S/ {{ $compra->impuesto }}</td>
            <td>S/ {{ $compra->icbper}}</td>
            <td>S/ {{ $compra->otros_gatos}}</td>
            <td>S/ {{ $compra->total }}</td>
            <td> {{ $compra->moneda }}</td>
            <td> {{ $compra->tipo_cambio }}</td>
            <td>
                @foreach($compra->compraDetalles as $item)
                    <li>{{$item->producto->nombre}}</li>
                @endforeach
            </td>
            <td>{{ $compra->costo->nombre }}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="background-color: yellow;">SUMA TOTAL:</td>
        <td style="background-color: yellow;">S/ {{$sumabase}}</td>
        <td style="background-color: yellow;">S/ {{ $sumaigv}}</td>
        <td style="background-color: yellow;">S/ {{ number_format($sumatotal,2) }}</td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
