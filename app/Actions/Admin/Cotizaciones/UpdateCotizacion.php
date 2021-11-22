<?php

namespace App\Actions\Admin\Cotizaciones;

use App\Contracts\Admin\Cotizaciones\UpdatesCotizaciones;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateCotizacion implements UpdatesCotizaciones
{
    public function update($cotizacion, array $input)
    {
        DB::transaction(function() use($cotizacion, $input) {
            $cotizacion->update([
                'cliente_id' => $input['cliente_id'],
                'fecha_inicio' => $input['fecha_inicio'],
                'fecha_fin' => $input['fecha_fin'],
                'terminos' => $input['terminos'] ?? '',
                'condiciones' => $input['condiciones'] ?? '',
                'impuesto_id' => $input['impuesto_id'],
                'total' => $input['total'],
                'impuesto' => $input['impuesto'],
                'subtotal' => $input['subtotal'],
                'codigo'        => $input['codigo'],
                'foto'          => $input['foto']
            ]);
            $cotizacion->CotizacionItem->each(function($item) {
                $item->delete();
            });

            collect($input['cotizacion_items'])->filter(function ($item) {
                    return $item['producto_id'] !== '';
                })->each(function($item) use($cotizacion) {
                    CotizacionItem::updateOrCreate(
                        [
                            'id' => $item['id'] ?? CotizacionItem::orderBy('id', 'desc')->first()->id + 1
                        ],
                        [
                            'cotizacion_id' => $cotizacion->id,
                            'producto_id' => $item['producto_id'],
                            'cantidad' => $item['cantidad'],
                            'precio' => $item['precio'],
                            'monto' => $item['monto'],
                        ]
                    );
                });
        });
    }

}

