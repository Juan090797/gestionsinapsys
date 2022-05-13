<?php

namespace App\Http\Livewire\Importaciones\Traits;

trait CalcularPurcharse
{
    public $subTotal        = 0;
    public $impuestoCalculo = 18;
    public $impuestoD       = 0;
    public $total           = 0;
    public $cantidadTotal   = 0;
    public $handling        = 0;
    public $otros           = 0;

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

    public function calculateTaxAmount()
    {
        $this->impuestoD = $this->subTotal * ($this->impuestoCalculo/100);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = $this->subTotal+ $this->impuestoD + $this->handling + $this->otros;
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
    public function updatedHandling($value)
    {
        if($value > 0){
            $this->handling = number_format($value,2);
            $this->calculateTotal();
        }else{
            $this->handling = 0.00;
            $this->calculateTotal();
        }
    }
    public function updatedOtros($value)
    {
        if($value > 0){
            $this->otros = number_format($value,2);
            $this->calculateTotal();
        }else{
            $this->otros = 0.00;
            $this->calculateTotal();
        }
    }
}
