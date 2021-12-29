<?php

namespace App\Http\Livewire\Cotizaciones\Traits;

trait DataCotizacion
{
    public $invoiceData = [
        'producto_id' => '',
        'cantidad' => 1,
        'precio' => '',
        'monto' => '',
    ];

    public $rows = [
        [
            'producto_id' => '',
            'cantidad' => 1,
            'precio' => '',
            'monto' => '',
        ]
    ];

    public function addNewRow()
    {
        array_push($this->rows, $this->invoiceData);
    }

    public function deleteRow($index)
    {
        unset($this->rows[$index]);

        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }
}
