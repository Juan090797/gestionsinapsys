<?php

namespace App\Http\Livewire\Ingresos\Traits;

trait DataIngreso
{
    public $compraData = [
        'producto_id' => '',
        'cantidad' => '1.00',
        'precio' => '',
        'stock' => '0.00',
        'monto' => '',
    ];

    public $rows = [
        [
            'producto_id' => '',
            'cantidad' => '1.00',
            'precio' => '',
            'stock' => '0.00',
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
        $this->calcularTotalItems();
    }
}
