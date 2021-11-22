<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new Producto([
            'codigo'            => $row['codigo'],
            'modelo'            => $row['modelo'],
            'descripcion'       => $row['descripcion'],
            'precio'            => $row['precio'],
            'tipo'              => $row['tipo'],
            'marca_id'          => $row['marca'],
            'familia_id'        => $row['equipo'],
        ]);
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required|unique:productos,codigo',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'codigo.required' => 'El codigo es requerido',
            'codigo.unique' => 'El codigo es unico',
        ];
    }

}
