<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

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
    public function comentarios()
    {
        return $this->hasMany(ComentarioPedido::class,'pedido_id');
    }
    public function archivos()
    {
        return $this->hasMany(ArchivoPedido::class,'pedido_id');
    }
    public function getFormateFechaAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
    public function getEstadoBadgeAttribute()
    {
        $badges= [
            'ANULADO'       => 'badge-danger',
            'EN PROCESO'    => 'badge-success',
            'FACTURADO'     => 'badge-dark',
            'DESPACHADO'    => 'badge-warning',
            'COMPLETADO'    => 'badge-primary',
            'FINALIZADO'    => 'badge-info',
        ];
        return $badges[$this->estado];
    }
    public function getEstadoDisabledAttribute()
    {
        $badges= [
            'ANULADO'       => 'disabled',
            'EN PROCESO'    => '',
            'FACTURADO'     => 'disabled',
            'DESPACHADO'    => 'disabled',
            'COMPLETADO'    => 'disabled',
            'FINALIZADO'    => 'disabled',
        ];
        return $badges[$this->estado];
    }

}
