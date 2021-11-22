<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;
    protected $fillable = ['cotizacion_id', 'producto_id', 'cantidad', 'precio', 'monto'];

    protected $appends = [
        'formate_precio',
        'formate_monto',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function getFormatePrecioAttribute()
    {
        return $this->precio;
    }

    public function getFormateMontoAttribute()
    {
        return $this->monto;
    }

}
