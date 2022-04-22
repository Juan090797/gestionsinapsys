<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function tecnico()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function comentarios()
    {
        return $this->hasMany(ComentarioInstalacion::class,'instalacion_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class,'instalacion_id');
    }
    public function getEstadoBadgeAttribute()
    {
        $badges= [
            'ACTIVO'        => 'badge-info',
            'ASIGNADO'      => 'badge-warning',
            'EN PROCESO'    => 'badge-primary',
            'TERMINADO'     => 'badge-success',
        ];
        return $badges[$this->estado];
    }
}
