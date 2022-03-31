<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
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
    public function getFechaInicioAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function getFechaFinAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
