<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Fecha Emision</th>
        <th>Fecha Pago</th>
        <th>Tipo Documento</th>
        <th>Serie Documento</th>
        <th>N° Documento</th>
        <th>Tipo Doc. Proveedor</th>
        <th>N° Documento</th>
        <th>Razon Social</th>
        <th>Base imponible</th>
        <th>Igv</th>
        <th>Otros Gastos</th>
        <th>Total</th>
        <th>Tipo Cambio</th>
        <th>Glosa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($facturas as $factura)
        <tr>
            <td>{{ $factura->id }}</td>
            <td>{{ date('d-m-Y', strtotime($factura->fecha_emision)) }}</td>
            <td>{{ date('d-m-Y', strtotime($factura->fecha_pago)) }}</td>
            <td>{{ $factura->documento->codigo}}</td>
            <td>{{ $factura->serie_documento }}</td>
            <td>{{ $factura->numero_documento }}</td>
            <td>01</td>
            <td>{{ $factura->pedido->cliente->ruc }}</td>
            <td>{{ $factura->pedido->cliente->razon_social }}</td>
            <td>S/ {{ number_format($factura->subtotal,2)}}</td>
            <td>S/ {{ number_format($factura->igv,2) }}</td>
            <td>S/ {{ number_format($factura->otros_gatos,2) }}</td>
            <td>S/ {{ number_format($factura->total,2) }}</td>
            <td> {{ number_format($factura->tipo_cambio,2) }}</td>
            <td>{{ $factura->glosa }}</td>
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
        <td style="background-color: yellow;">S/ {{ number_format($sumabase,2) }}</td>
        <td style="background-color: yellow;">S/ {{ number_format($sumaigv,2) }}</td>
        <td></td>
        <td style="background-color: yellow;">S/ {{ number_format($sumatotal,2) }}</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
