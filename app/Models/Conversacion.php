<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversacion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function getMensajesNoAttribute()
    {
        $noLeidos = Conversacion::where('id', $this->id)->withCount(['mensajes' => function (Builder $query) {
            $query->where('visto', null);
        },])->get();
        return $noLeidos[0];
    }
}
