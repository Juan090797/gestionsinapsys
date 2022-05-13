<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Empresa;
use App\Models\Purchase;
use Livewire\Component;

class ShowPurcharse extends Component
{
    public $empresa,$purchase;

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }
    public function render()
    {
        $this->update();
        return view('livewire.importaciones.show-purcharse')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->empresa();
    }
    public function empresa()
    {
        $this->empresa = Empresa::first();
    }
}
