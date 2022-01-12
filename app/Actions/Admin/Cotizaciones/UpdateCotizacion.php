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
        $validatedData = Validator::make($input, [
            'atendido' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ],
            [
                'atendido.required' => 'La persona atendida es requerido',
                'fecha_inicio.required' => 'El fecha de inicio es requerido',
                'fecha_fin.required' => 'El fecha de fin es requerido',
            ])->validate();

        DB::transaction(function() use($cotizacion, $input) {
            $cotizacion->update([
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
                'total_items'   => $input['total_items'],
                'foto'          => $input['foto'] ?? '',
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

