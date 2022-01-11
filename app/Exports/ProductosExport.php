<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::all();
    }
    public function headings(): array
    {
        return ["ID", "CODIGO", "MODELO", "DESCRIPCION", "STOCK", "ESTADO", "DESCRIPCION", "PRECIO_VENTA","PRECIO_COMPRA","TIPO","MARCA","FAMILIA","CLASIFICACION","UNIDAD MEDIDA","FECHA CREADO","FECHA ACTUALIZACION"];
    }
}
