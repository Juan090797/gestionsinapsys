<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProveedorsExport implements FromCollection, WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Proveedor::with(['tipo'])->get();

    }

    public function map($proveedor): array
    {
        return [
            $proveedor->ruc,
            $proveedor->razon_social,
            $proveedor->nombre_comercial,
            $proveedor->direccion,
            $proveedor->telefono,
            $proveedor->celular,
            $proveedor->correo,
            $proveedor->pagina_web,
            $proveedor->tipo->nombre,
            $proveedor->estado,
        ];
    }
    public function headings(): array
    {
        return ["ruc", "razon_social", "nombre_comercial", "direccion","telefono","celular","correo","pagina_web","tipo_proveedor","estado"];
    }
}
