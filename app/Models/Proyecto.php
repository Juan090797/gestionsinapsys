<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['fecha_dia','inicio','fin','restante'];

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
        return $f1->diffInDays($f2,false);
    }
    public function getRestanteAttribute()
    {
        $f1=Carbon::now();
        $f2=Carbon::parse($this->fecha_fin);
        return $f1->diffInDays($f2,false);
    }
    public function getInicioAttribute()
    {
        return Carbon::parse($this->fecha_inicio)->format('d-m-Y');
    }
    public function getFinAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('d-m-Y');
    }
    public function getPrioridadBadgeAttribute()
    {
        $badges= [
            'ALTA'  => 'badge-danger',
            'MEDIA' => 'badge-warning',
            'BAJA'  => 'badge-primary',
        ];
        return $badges[$this->prioridad];
    }
    public function getEstadoBadgeAttribute()
    {
        $badges= [
            'DEFINIDO'      => 'badge-success',
            'APROBADO'      => 'badge-primary',
            'ARCHIVADO'     => 'badge-danger',
            'COMPLETADO'    => 'badge-warning',
        ];
        return $badges[$this->estado];
    }
}
