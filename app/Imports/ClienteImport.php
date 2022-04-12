<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Industria;
use App\Models\TipoDocumento;
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
    private $industria, $categoria,$tipo_documento;

    public function __construct()
    {
        $this->industria = Industria::select('id','nombre')->get();
        $this->categoria = Categoria::select('id','nombre')->get();
        $this->tipo_documento = TipoDocumento::select('id','nombre')->get();
    }

    public function model(array $row)
    {
        $i  = $this->industria->where('nombre',$row['industria'])->first();
        $c  = $this->categoria->where('nombre',$row['categoria'])->first();
        $d  = $this->tipo_documento->where('nombre',$row['tipo_documento'])->first();
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
            'industria_id'      => $i->id,
            'categoria_id'      => $c->id,
            'tipo_documento_id' => $d->id,
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
