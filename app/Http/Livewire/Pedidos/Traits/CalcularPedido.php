<?php

namespace App\Http\Livewire\Pedidos\Traits;

use App\Models\impuesto;

trait CalcularPedido
{
    public $subTotal = 0;
    public $impuestoD = 0;
    public $total = 0;
    public $cantidadTotal = 0;

    public function calcularCantidad($cantidad, $index)
    {
        $this->lista[$index]['cantidad'] = $cantidad;
        $this->lista[$index]['precio_t'] = $cantidad * $this->lista[$index]['precio_u'] ?? 0;
        $this->calculateSubTotal();
        $this->calculateTaxAmount();
        $this->calculateTotal();
        $this->calcularTotalItems();
    }
    public function calcularPrecio($precio, $index)
    {
        $this->lista[$index]['precio_u'] = $precio;
        $this->lista[$index]['precio_t'] = $precio * $this->lista[$index]['cantidad'] ?? 0;
        $this->calculateSubTotal();
        $this->calculateTaxAmount();
        $this->calculateTotal();
        $this->calcularTotalItems();
    }
    public function calculateSubTotal()
    {
        $this->subTotal = collect($this->lista)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('precio_t');
    }
    public function calculateTaxAmount()
    {
        $this->impuestoD = $this->subTotal * (18/100);
        $this->calculateTotal();
    }
    public function calculateTotal()
    {
        $this->total = $this->subTotal+ $this->impuestoD;
    }
    public function cambiarDetalle($descripcion, $index)
    {
        $this->lista[$index]['descripcion'] = $descripcion;
    }
    public function calcularTotalItems()
    {
        $this->cantidadTotal = collect($this->lista)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('cantidad');
    }
}
