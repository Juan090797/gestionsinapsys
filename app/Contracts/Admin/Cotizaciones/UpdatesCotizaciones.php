<?php

namespace App\Contracts\Admin\Cotizaciones;

interface UpdatesCotizaciones
{
    public function update($cotizacion, array $input);
}
