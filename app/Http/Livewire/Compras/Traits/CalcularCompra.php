<?php

namespace App\Http\Livewire\Compras\Traits;

trait CalcularCompra
{
    public $cantidadTotal =0;

    public function calcularCantidad($cantidad, $index)
    {
        $this->lista[$index]['cantidad'] = $cantidad;
        $this->lista[$index]['precio_t'] =  $cantidad * $this->lista[$index]['precio_u'] ?? 0;
        $this->calcularTotalItems();
    }
    public function calcularPrecio($precio, $index)
    {
        $this->lista[$index]['precio_u'] = $precio;
        $this->lista[$index]['precio_t'] = $precio * $this->lista[$index]['cantidad'] ?? 0;
    }
    public function calcularTotalItems()
    {
        $this->cantidadTotal = collect($this->lista)->filter(function ($row) {
            return $row['id'] !=='';
        })->sum('cantidad');
    }

}
