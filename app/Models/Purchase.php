<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function purcharseItem()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function costos()
    {
        return $this->hasMany(Costo::class);
    }
    public function gastos()
    {
        return $this->hasManyThrough(Gasto::class, Costo::class);
    }
}
