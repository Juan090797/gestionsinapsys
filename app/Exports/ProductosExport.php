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
        return ["ID", "CODIGO", "MODELO", "DESCRIPCION", "PRECIO", "TIPO", "MARCA", "EQUIPO","FECHA CREADO", "FECHA ACTUALIZACION"];
    }
}
