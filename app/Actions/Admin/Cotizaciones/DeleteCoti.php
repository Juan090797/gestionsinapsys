<?php

namespace App\Actions\Admin\Cotizaciones;

use App\Contracts\Admin\Cotizaciones\DeletesCotizaciones;
use Illuminate\Support\Facades\DB;

class DeleteCoti implements DeletesCotizaciones
{
    public function delete($cotizacion)
    {
        DB::transaction(function() use($cotizacion) {
            $cotizacion->deleteItems();
            $cotizacion->delete();
        });
    }
}
