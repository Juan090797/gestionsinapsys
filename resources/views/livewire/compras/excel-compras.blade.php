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
        <th>NO GRAVADAS</th>
        <th>ICBPER</th>
        <th>Otros Gastos</th>
        <th>Total</th>
        <th>Moneda</th>
        <th>Tipo Cambio</th>
        <th>Items</th>
        <th>Centro Costo</th>
        <th>Glosa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($compras as $compra)
        <tr>
            <td>{{ $compra->id }}</td>
            <td>{{ $compra->periodo }}</td>
            <td>{{ date('d-m-Y', strtotime($compra->fecha_documento)) }}</td>
            <td>{{ date('d-m-Y', strtotime($compra->fecha_pago)) }}</td>
            <td>{{ $compra->documento->codigo}}</td>
            <td>{{ $compra->serie_documento }}</td>
            <td>{{ $compra->numero_documento }}</td>
            <td>{{ $compra->proveedor->tipodoc->codigo}}</td>
            <td>{{ $compra->proveedor->ruc }}</td>
            <td>{{ $compra->proveedor->razon_social }}</td>
            <td>S/ {{ number_format($compra->subtotal,2)}}</td>
            <td>S/ {{ number_format($compra->impuesto,2) }}</td>
            <td>S/ {{ number_format($compra->no_gravadas,2) }}</td>
            <td>S/ {{ number_format($compra->icbper,2) }}</td>
            <td>S/ {{ number_format($compra->otros_gatos,2) }}</td>
            <td>S/ {{ number_format($compra->total,2) }}</td>
            <td> {{ $compra->moneda }}</td>
            <td> {{ number_format($compra->tipo_cambio,2) }}</td>
            <td>
                @foreach($compra->compraDetalles as $item)
                    <li>{{$item->producto->nombre}}</li>
                @endforeach
            </td>
            <td>{{ $compra->costo->nombre }}</td>
            <td>{{ $compra->detalle }}</td>
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
        <td></td>
        <td style="background-color: yellow;">SUMA TOTAL:</td>
        <td style="background-color: yellow;">S/ {{ number_format($sumabase,2) }}</td>
        <td style="background-color: yellow;">S/ {{ number_format($sumaigv,2) }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="background-color: yellow;">S/ {{ number_format($sumatotal,2) }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
