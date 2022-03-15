<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ordenDetalles()
    {
        return $this->hasMany(OrdenCompraDetalle::class);
    }

    public function impuestoc()
    {
        return $this->belongsTo(impuesto::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
