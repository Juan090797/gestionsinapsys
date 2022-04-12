<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClienteExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cliente::all();
    }
    public function headings(): array
    {
        return ["ID", "NOMBRE COMERCIAL", "CORREO", "DIRECCION", "ESTADO", "PAGINA WEB", "CELULAR", "DESCRIPCION", "RUC", "RAZON SOCIAL", "DETALLE BANCO", "CIUDAD ENTREGA",
            "CIUDAD RECOJO", "DIRECCION ENTREGA", "DIRECCION RECOJO", "PAIS ENTREGA", "PAIS RECOJO", "USUARIO_AUDITORIA", "INDUSTRIA", "CATEGORIA","TIPO_DOCUMENTO", "FECHA CREADO", "FECHA ACTUALIZACION"
            ];
    }
}
