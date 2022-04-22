<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
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
    public function contacto()
    {
        return $this->belongsTo(Contacto::class,'contacto_id');
    }
    public function comentarios()
    {
        return $this->hasMany(ComentarioIncidencia::class,'incidencia_id');
    }
    public function getEstadoBadgeAttribute()
    {
        $badges= [
            'ASIGNADO'          => 'badge-info',
            'EN PROCESO'        => 'badge-primary',
            'SOLUCIONADO'       => 'badge-success',
            'ANULADO'           => 'badge-danger',
        ];
        return $badges[$this->estado];
    }
}
