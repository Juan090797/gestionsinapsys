<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $appends = ['nombre'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function getNombreAttribute()
    {
        $date = Producto::find($this->producto_id);
        return $date->nombre;
    }
}
