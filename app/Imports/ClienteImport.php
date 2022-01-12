<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClienteImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new Cliente([
            'nombre'            => $row['nombre_comercial'],
            'correo'            => $row['correo'],
            'direccion'         => $row['direccion'],
            'estado'            => $row['estado'],
            'pagina_web'        => $row['pagina_web'],
            'telefono'          => $row['telefono'],
            'descripcion'       => $row['descripcion'],
            'ruc'               => $row['ruc'],
            'razon_social'      => $row['razon_social'],
            'detalle_banco'     => $row['detalle_banco'],
            'ciudad_entrega'    => $row['ciudad_entrega'],
            'ciudad_recojo'     => $row['ciudad_recojo'],
            'direccion_entrega' => $row['direccion_entrega'],
            'direccion_recojo'  => $row['direccion_recojo'],
            'pais_entrega'      => $row['pais_entrega'],
            'pais_recojo'       => $row['pais_recojo'],
            'usuario_auditoria' => $row['usuario_auditoria'],
            'industria_id'      => $row['industria'],
            'categoria_id'      => $row['categoria'],
        ]);
    }
    public function rules(): array
    {
        return [
            'ruc' => 'required|unique:clientes,ruc',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'ruc.required' => 'El ruc es requerido',
            'ruc.unique' => 'El ruc es unico',
        ];
    }
}
