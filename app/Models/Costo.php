<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function costeable()
    {
        return $this->morphTo();
    }
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
