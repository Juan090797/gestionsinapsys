<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function movimientoDetalles()
    {
        return $this->hasMany(MovimientoAlmacenDetalle::class, 'movimiento_almacens_id');
    }

    public function motivos()
    {
        return $this->belongsTo(Motivo::class, 'motivo_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function costos()
    {
        return $this->belongsTo(CentroCosto::class, 'centro_costo_id');
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
