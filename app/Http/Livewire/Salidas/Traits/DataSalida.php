<?php

namespace App\Http\Livewire\Salidas\Traits;

trait DataSalida
{
    public $compraData = [
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
        array_push($this->rows, $this->compraData);
    }

    public function deleteRow($index)
    {
        unset($this->rows[$index]);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }
}
