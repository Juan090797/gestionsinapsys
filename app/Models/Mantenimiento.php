<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function tecnico()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getEstadoBadgeAttribute()
    {
        $badges= [
            'ASIGNADO'          => 'badge-info',
            'EN PROCESO'        => 'badge-primary',
            'TERMINADO'         => 'badge-success',
            'REPROGRAMADO'      => 'badge-warning',
            'ANULADO'           => 'badge-danger',
        ];
        return $badges[$this->estado];
    }
    public function getEjecucionAttribute()
    {
        return Carbon::parse($this->fecha_ejecucion)->format('d-m-Y');
    }
}
