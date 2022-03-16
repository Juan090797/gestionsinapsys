<?php

namespace App\Imports;

use App\Models\Clasificacion;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\UnidadMedida;
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
    private $marcas, $unidades, $clasificaciones;

    public function __construct()
    {
        $this->marcas = Marca::select('id','nombre')->get();
        $this->unidades = UnidadMedida::select('id','nombre')->get();
        $this->clasificaciones = Clasificacion::select('id','nombre')->get();
    }
    public function model(array $row)
    {
        $marca = $this->marcas->where('nombre', $row['marca'] ?? $row['MARCA'] ?? $row['Marca'])->first();
        $unidad = $this->unidades->where('nombre', $row['unidad_medida'] ?? $row['UNIDAD_MEDIDA'] ?? $row['UNIDAD MEDIDA'])->first();
        $clasificacion = $this->clasificaciones->where('nombre', $row['clasificacion'] ?? $row['CLASIFICACION'] ?? $row['Clasificacion'])->first();
        return new Producto([
            'codigo'            => $row['codigo'] ?? $row['CODIGO'] ?? $row['Codigo'],
            'nombre'            => $row['nombre'] ?? $row['NOMBRE'] ?? $row['Nombre'],
            'modelo'            => $row['modelo'] ?? $row['MODELO'] ?? $row['Modelo'] ?? null,
            'stock'             => $row['stock'] ?? $row['STOCK'] ?? $row['Stock'],
            'estado'            => $row['estado'] ?? $row['ESTADO'] ?? $row['Estado'] ?? 'Activo',
            'descripcion'       => $row['descripcion'] ?? $row['DESCRIPCION'] ?? $row['Descripcion'] ?? null,
            'precio_venta'      => $row['precio_venta'] ?? $row['PRECIO_VENTA'] ?? $row['Precio_venta'] ?? 0.00,
            'precio_compra'     => $row['precio_compra'] ?? $row['PRECIO_COMPRA'] ?? $row['Precio_compra'] ?? 0.00,
            'tipo'              => $row['tipo'] ?? $row['TIPO'] ?? $row['Tipo'] ?? null,
            'marca_id'          => $marca->id,
            'clasificacions_id' => $clasificacion->id,
            'unidad_medidas_id' => $unidad->id,
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
