<?php

namespace App\Http\Livewire\Pedidos\Traits;

trait CalcularPedido
{
    public $subTotal = 0;
    public $impuestoCalculo = 0;
    public $impuestoD = 0;
    public $total = 0;
    public $cantidadTotal = 0;
    public $suma = 0;
    public $icbper = 0;
    public $otros_gastos = 0;
    public $tipo_documento_id;

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

    public function calculateSubTotal($impuestoId = null)
    {
        $this->suma = collect($this->lista)->filter(function ($row) {
            return $row['id'] !=='';
        })->sum('precio_t');
        $this->impuestoCalculo = 1.18;
        $this->subTotal = $this->suma / ($this->impuestoCalculo);
    }

    public function calculateTaxAmount()
    {
        $this->impuestoD = $this->suma - $this->subTotal;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = $this->subTotal + $this->impuestoD + $this->icbper + $this->otros_gastos;
    }
    public function calculateTotalBoleta()
    {
        $this->total = collect($this->lista)->filter(function ($row) {
            return $row['id'] !=='';
        })->sum('precio_t');
        $this->total = $this->total + $this->icbper;
    }

    public function updatedTipoDocumentoId()
    {
        if ($this->tipo_documento_id == 6)
        {
            $this->calculateSubTotal();
            $this->calculateTaxAmount();
            $this->calculateTotal();
        }else{
            $this->subTotal=0;
            $this->impuestoD=0;
            $this->calculateTotalBoleta();
        }
    }
    public function updatedIcbper()
    {
        $this->calculateTotal();
    }
    public function updatedOtrosGastos()
    {
        $this->calculateTotal();
    }
}
