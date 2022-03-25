<table>
    <thead>
    <tr>
        <th>Fecha Salida</th>
        <th>Nombre</th>
        <th>Area</th>
        <th>Concepto</th>
        <th>Motivo</th>
        <th>Detalle</th>
        <th>Cliente</th>
        <th>Referencia</th>
        <th>Ingreso</th>
        <th>Egreso</th>
    </tr>
    </thead>
    <tbody>
    @foreach($movimientos as $movimiento)
        <tr>
            <td>{{ date('d-m-Y', strtotime($movimiento->fecha)) }}</td>
            <td>{{ $movimiento->usuario->name }}</td>
            <td>{{ $movimiento->usuario->area }}</td>
            <td>{{ $movimiento->concepto }}</td>
            <td>{{ $movimiento->motivo}}</td>
            <td>{{ $movimiento->detalle }}</td>
            <td>{{ $movimiento->cliente->razon_social ?? null }}</td>
            <td>{{ $movimiento->referencia }}</td>
            <td style="color: blue">
                @if($movimiento->tipo == 'INGRESO')
                    S/ {{ number_format($movimiento->importe,2) }}
                @endif
            </td>
            <td style="color: red">
                @if($movimiento->tipo == 'EGRESO')
                    S/ {{ number_format($movimiento->importe,2) }}
                @endif
            </td>
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
        <td style="color: blue">T.Ingresos: S/ {{ number_format($sumaIngresos,2) }}</td>
        <td style="color: red">T.Egresos: S/ {{ number_format($sumaEgresos,2) }}</td>
        <td style="color: green">Saldo: S/ {{ number_format($saldo,2) }}</td>
    </tr>
    </tbody>
</table>
