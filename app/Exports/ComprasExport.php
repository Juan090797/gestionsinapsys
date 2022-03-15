<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ComprasExport implements FromCollection, WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Compra::with(['proveedor','costo'])->get();

    }

    public function map($compra): array
    {
        return [
            $compra->proveedor->razon_social,
            $compra->tipo_documento,
            $compra->numero_documento,
            $compra->fecha_documento,
            $compra->fecha_pago,
            $compra->total_items,
            $compra->costo->nombre,
            $compra->estado,
            $compra->subtotal,
            $compra->impuesto,
            $compra->total,
        ];
    }
    public function headings(): array
    {
        return ["proveedor","tipo_documento","numero_documento","fecha_documento","fecha_pago","total_items","centro_costo", "estado","subtotal","impuesto","total"];
    }
}
