<?php

namespace App\Models;

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


}
