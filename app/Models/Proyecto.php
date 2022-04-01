<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $casts = ['team' => 'array'];
    protected $guarded = ['id'];
    protected $appends = ['fecha_dia'];

    public function lider()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }
    public function colaboradores()
    {
        return $this->hasMany(ProyectoUser::class,'proyecto_id');
    }

    public function getFechaDiaAttribute()
    {
        $f1=Carbon::parse($this->fecha_inicio);
        $f2=Carbon::parse($this->fecha_fin);
        return $f1->diffInDays($f2);
    }
}
