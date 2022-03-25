<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaMovimiento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function caja()
    {
        return $this->belongsTo(Caja::class,'caja_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
