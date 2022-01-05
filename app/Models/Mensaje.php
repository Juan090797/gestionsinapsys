<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function conversacion()
    {
        return $this->belongsTo(Conversacion::class,'conversacion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
