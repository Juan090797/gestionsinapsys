<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $appends = [
        'formate_fecha',
    ];

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
    public function getFormateFechaAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
