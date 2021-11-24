<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $fillable = ['foto','codigo','fecha_inicio', 'fecha_fin', 'terminos', 'condiciones', 'total', 'subtotal', 'impuesto', 'cliente_id', 'impuesto_id', 'proyecto_id'];

    protected $appends = [
        'formate_fechai',
        'formate_fechac'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function CotizacionItem()
    {
        return $this->hasMany(CotizacionItem::class);
    }

    public function Impuesto()
    {
        return $this->belongsTo(impuesto::class);
    }

    public function deleteItems(): void
    {
        $this->CotizacionItem->each(function($item) {
            $item->delete();
        });
    }
    public function getFormateFechaiAttribute()
    {
        return Carbon::parse($this->fecha_inicio)->format('d-m-Y');
    }
    public function getFormateFechacAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('d-m-Y');
    }
}
