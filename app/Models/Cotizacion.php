<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $fillable = ['foto','codigo','fecha_inicio', 'fecha_fin', 'terminos', 'condiciones', 'total', 'subtotal', 'impuesto', 'cliente_id', 'impuesto_id', 'proyecto_id'];

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
}
