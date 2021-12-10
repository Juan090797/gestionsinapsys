<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedidoDetalle()
    {
        return $this->hasMany(PedidoDetalle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
