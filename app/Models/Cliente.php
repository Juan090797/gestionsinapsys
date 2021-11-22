<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'correo', 'direccion', 'estado', 'pagina_web','telefono', 'descripcion', 'ruc', 'razon_social', 'detalle_banco',
        'ciudad_entrega', 'ciudad_recojo', 'direccion_entrega', 'direccion_recojo', 'pais_entrega', 'pais_recojo', 'usuario_auditoria',
        'industria_id','categoria_id'];

    public function proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function cotizaciones()
    {
        return $this->hasMany(Proyecto::class);
    }

    public static function getBillingInfo($clientId)
    {
        return Cliente::select('id', 'razon_social', 'telefono', 'correo')
            ->findOrFail($clientId);
    }
}
