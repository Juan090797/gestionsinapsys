<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductosExport implements FromCollection, WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::with(['marca','clasificacion','unidad'])->get();

    }

    public function map($producto): array
    {
        return [
            $producto->codigo,
            $producto->nombre,
            $producto->modelo,
            $producto->stock,
            $producto->tipo,
            $producto->marca->nombre,
            $producto->clasificacion->nombre,
            $producto->unidad->nombre,
        ];
    }
    public function headings(): array
    {
        return ["CODIGO", "NOMBRE", "MODELO", "STOCK","TIPO","MARCA","CLASIFICACION","UNIDAD MEDIDA"];
    }
}
