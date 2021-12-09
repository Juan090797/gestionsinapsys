<?php

namespace App\Actions\Admin\Cotizaciones;

use App\Contracts\Admin\Cotizaciones\CreatesCotizaciones;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateCotizacion implements CreatesCotizaciones
{
    public function create(array $input)
    {
        DB::transaction(function() use ($input) {
            $cotizacion = Cotizacion::create([
                'cliente_id'    => $input['cliente_id'],
                'fecha_inicio'  => $input['fecha_inicio'],
                'fecha_fin'     => $input['fecha_fin'],
                'terminos'      => $input['terminos'] ?? '',
                'condiciones'   => $input['condiciones'] ?? '',
                'impuesto_id'   => $input['impuesto_id'],
                'total'         => $input['total'],
                'proyecto_id'   => $input['proyecto_id'],
                'impuesto'      => $input['impuesto'],
                'subtotal'      => $input['subtotal'],
                'codigo'        => $input['codigo'],
                'atendido'      => $input['atendido'],
                'foto'          => $input['foto'] ?? ''
            ]);

            collect($input['cotizacion_items'])
                ->filter(function ($item) {
                    return $item['producto_id'] !== '';
                })->each(function($item) use($cotizacion) {
                    CotizacionItem::create([
                        'cotizacion_id'     => $cotizacion->id,
                        'producto_id'       => $item['producto_id'],
                        'cantidad'          => $item['cantidad'],
                        'precio'   => $item['precio'],
                        'monto'      => $item['monto'],
                    ]);
                });
        });
    }
}
