<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClienteImport implements ToModel
{
    /**
    * @param array $rowS
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([
            'nombre'            => $row[0],
            'correo'            => $row[1],
            'direccion'         => $row[2],
            'estado'            => $row[3],
            'pagina_web'        => $row[4],
            'telefono'          => $row[5],
            'descripcion'       => $row[6],
            'ruc'               => $row[7],
            'razon_social'      => $row[8],
            'detalle_banco'     => $row[9],
            'ciudad_entrega'    => $row[10],
            'ciudad_recojo'     => $row[11],
            'direccion_entrega' => $row[12],
            'direccion_recojo'  => $row[13],
            'pais_entrega'      => $row[14],
            'pais_recojo'       => $row[15],
            'usuario_auditoria' => $row[16],
            'industria_id'      => $row[17],
            'categoria_id'      => $row[18],
        ]);
    }
}
