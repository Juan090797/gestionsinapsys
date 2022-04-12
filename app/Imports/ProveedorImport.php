<?php

namespace App\Imports;

use App\Models\Proveedor;
use App\Models\TipoDocumento;
use App\Models\TipoProveedor;
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
    private $tipo_proveedor, $tipo_documento;

    public function __construct()
    {
        $this->tipo_proveedor = TipoProveedor::select('id','nombre')->get();
        $this->tipo_documento = TipoDocumento::select('id','nombre')->get();
    }

    public function model(array $row)
    {
        $tipo = $this->tipo_proveedor->where('nombre',$row['tipo_proveedor'])->first();
        $documento = $this->tipo_documento->where('nombre',$row['tipo_documento'])->first();
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
            'tipo_proveedors_id'=> $tipo->id,
            'tipo_documento_id' => $documento->id,
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
