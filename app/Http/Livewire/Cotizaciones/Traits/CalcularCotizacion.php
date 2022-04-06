<?php

namespace App\Http\Livewire\Cotizaciones\Traits;

use App\Models\Producto;
use App\Models\impuesto;

trait CalcularCotizacion
{
    public $subTotal = 0;
    public $impuestoCalculo = 0;
    public $impuestoD = 0;
    public $total = 0;
    public $cantidadTotal = 0;

    public function calculateAmount($cantidad, $index)
    {
        $this->lista[$index]['cantidad'] = $cantidad;
        $this->lista[$index]['precio_t'] = $cantidad * $this->lista[$index]['precio_u'] ?? 0;
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculatePrice($precio, $index)
    {
        $this->lista[$index]['precio_u'] = $precio;
        $this->lista[$index]['precio_t'] = $precio * $this->lista[$index]['cantidad'] ?? 0;
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }

    public function calculateSubTotal()
    {
        $this->subTotal = collect($this->lista)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('precio_t');
    }

    public function calculateTaxAmount($impuestoId = null)
    {
        $impuestoCalculo = 0;
        if ($impuestoId) {
            $impuestoCalculo = impuesto::find($impuestoId)->valor;
        }
        $this->impuestoCalculo = $impuestoCalculo;
        $this->impuestoD = $this->subTotal * ($this->impuestoCalculo/100);
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
