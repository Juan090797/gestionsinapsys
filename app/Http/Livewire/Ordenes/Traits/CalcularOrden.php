<?php

namespace App\Http\Livewire\Ordenes\Traits;

use App\Models\Producto;

trait CalcularOrden
{
    public $subTotal = 0;
    public $impuestoCalculo = 0;
    public $impuestoD = 0;
    public $total = 0;
    public $cantidadTotal = 0;

    public function getServicePrice($productoId, $index)
    {
        $this->rows[$index]['precio'] = Producto::findOrFail($productoId)->precio_compra;
        $this->rows[$index]['formate_precio'] = $this->rows[$index]['precio'];
        $this->rows[$index]['producto_id'] = $productoId;

        $this->calculateAmount($this->rows[$index]['cantidad'], $index);
        $this->calculateSubTotal();
        $this->calculateTaxAmount();
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculateAmount($cantidad, $index)
    {
        $this->rows[$index]['cantidad'] = $cantidad;
        $this->rows[$index]['monto'] = (int) $cantidad * $this->rows[$index]['precio'] ?? 0;
        $this->rows[$index]['formate_monto'] = number_format($this->rows[$index]['monto'],2);

        $this->calculateSubTotal();
        $this->calculateTaxAmount();
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculatePrice($precio, $index)
    {
        $this->rows[$index]['precio'] = $precio;
        $this->rows[$index]['monto'] = (int) $precio * $this->rows[$index]['cantidad'] ?? 0;
        $this->rows[$index]['formate_monto'] = number_format($this->rows[$index]['monto'],2);

        $this->calculateSubTotal();
        $this->calculateTaxAmount();
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculateSubTotal()
    {
        $this->subTotal = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('monto');
    }

    public function calculateTaxAmount($impuestoId = null)
    {
        $this->impuestoCalculo = 18;
        $this->impuestoD = $this->subTotal * ($this->impuestoCalculo/100);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = $this->subTotal+ $this->impuestoD;
    }

    public function calcularTotalItems()
    {
        $this->cantidadTotal = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('cantidad');
    }
}
