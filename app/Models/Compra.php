<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function compraDetalles()
    {
        return $this->hasMany(CompraDetalle::class);
    }

    public function impuestoc()
    {
        return $this->belongsTo(impuesto::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function costo()
    {
        return $this->belongsTo(CentroCosto::class, 'centro_costo_id');
    }

    public function documento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
    public function getEstadoDisabledAttribute()
    {
        $badges= [
            'ANULADO'       => 'disabled',
            'PENDIENTE'     => '',
            'APROBADO'      => 'disabled',
        ];
        return $badges[$this->estado];
    }
}
