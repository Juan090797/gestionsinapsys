<?php

namespace App\Http\Livewire\Cotizaciones\Traits;

use App\Models\Producto;
use App\Models\impuesto;

trait CalcularCotizacionUpdate
{
    public $subTotal = 0;
    public $taxRate = 0;
    public $taxAmount = 0;
    public $totalAmount = 0;

    public function getServicePrice($serviceId, $index)
    {
        $this->rows[$index]['precio'] = Producto::findOrFail($serviceId)->precio;
        $this->rows[$index]['formatted_rate'] = $this->rows[$index]['precio'];
        $this->rows[$index]['producto_id'] = $serviceId;

        $this->calculateAmount($this->rows[$index]['quantity'], $index);
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();

    }

    public function calculateAmount($quantity, $index)
    {
        $this->rows[$index]['quantity'] = $quantity;
        $this->rows[$index]['amount'] = (int) $quantity * $this->rows[$index]['precio'] ?? 0;
        $this->rows[$index]['formatted_amount'] = number_format($this->rows[$index]['amount'],2);
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
    }

    public function calculatePrice($precio, $index)
    {
        $this->rows[$index]['precio'] = $precio;
        $this->rows[$index]['amount'] = (int) $precio * $this->rows[$index]['quantity'] ?? 0;
        $this->rows[$index]['formatted_amount'] = number_format($this->rows[$index]['amount'],2);
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
    }

    public function calculateSubTotal()
    {
        $this->subTotal = collect($this->rows)->filter(function ($row) {
            return $row['producto_id'] !=='';
        })->sum('precio_total');
    }

    public function calculateTaxAmount($impuestoId = null)
    {
        $taxRate = 0;
        if ($impuestoId) {
            $taxRate = impuesto::find($impuestoId)->valor;
        }

        $this->taxRate = $taxRate;
        $this->taxAmount = $this->subTotal * ($this->taxRate/100);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalAmount = $this->subTotal+ $this->taxAmount;
    }

}
