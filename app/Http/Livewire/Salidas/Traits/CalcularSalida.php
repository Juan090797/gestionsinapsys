<?php

namespace App\Http\Livewire\Salidas\Traits;

use App\Models\Producto;

trait CalcularSalida
{
    public $cantidadTotal = 0;

    public function getServicePrice($productoId, $index)
    {
        $this->rows[$index]['stock'] = Producto::findOrFail($productoId)->stock;
        $this->rows[$index]['producto_id'] = $productoId;
        $this->calcularTotalItems();
    }

    public function cambioCantidad($cantidad, $index)
    {
        $this->rows[$index]['cantidad'] = $cantidad;
        $this->calcularTotalItems();
    }

    public function calcularTotalItems()
    {
        $this->cantidadTotal = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('cantidad');
    }

}
