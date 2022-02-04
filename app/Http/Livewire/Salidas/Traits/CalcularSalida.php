<?php

namespace App\Http\Livewire\Salidas\Traits;

use App\Models\Producto;

trait CalcularSalida
{
    public $total = 0;
    public $cantidadTotal = 0;

    public function getServicePrice($productoId, $index)
    {
        $this->rows[$index]['precio'] = Producto::findOrFail($productoId)->precio_compra;
        $this->rows[$index]['formate_precio'] = $this->rows[$index]['precio'];
        $this->rows[$index]['producto_id'] = $productoId;
        $this->calculateAmount($this->rows[$index]['cantidad'], $index);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculateAmount($cantidad, $index)
    {
        $this->rows[$index]['cantidad'] = $cantidad;
        $this->rows[$index]['monto'] = (int) $cantidad * $this->rows[$index]['precio'] ?? 0;
        $this->rows[$index]['formate_monto'] = number_format($this->rows[$index]['monto'],2);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculatePrice($precio, $index)
    {
        $this->rows[$index]['precio'] = $precio;
        $this->rows[$index]['monto'] = (int) $precio * $this->rows[$index]['cantidad'] ?? 0;
        $this->rows[$index]['formate_monto'] = number_format($this->rows[$index]['monto'],2);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('monto');
    }

    public function calcularTotalItems()
    {
        $this->cantidadTotal = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('cantidad');
    }

}
