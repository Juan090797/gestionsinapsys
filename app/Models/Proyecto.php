<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected  $casts = ['team' => 'array'];
    protected $fillable = ['nombre', 'prioridad', 'ingreso_estimado', 'gasto_estimado', 'fecha_inicio', 'fecha_fin', 'cliente_id', 'user_id', 'lider', 'team'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
