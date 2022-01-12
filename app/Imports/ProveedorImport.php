<?php

namespace App\Imports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProveedorImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new Proveedor([
            'ruc'               => $row['ruc'],
            'razon_social'      => $row['razon_social'],
            'nombre_comercial'  => $row['nombre_comercial'],
            'direccion'         => $row['direccion'],
            'telefono'          => $row['telefono'],
            'celular'           => $row['celular'],
            'correo'            => $row['correo'],
            'pagina_web'        => $row['pagina_web'],
            'estado'            => $row['estado'],
            'tipo_proveedors_id'=> $row['tipo_proveedor'],
        ]);
    }
    public function rules(): array
    {
        return [
            'ruc' => 'required|unique:proveedors,ruc',
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
