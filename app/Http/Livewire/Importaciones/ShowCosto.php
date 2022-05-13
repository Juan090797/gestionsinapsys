<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Costo;
use App\Models\Purchase;
use Livewire\Component;

class ShowCosto extends Component
{
    public $orden,$costos;

    public function mount(Purchase $purchase)
    {
        $this->orden = $purchase;
    }
    public function render()
    {
        $this->update();
        return view('livewire.importaciones.show-costo')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->costos();
    }
    public function costos()
    {
        $this->costos = Costo::where('purchase_id',$this->orden->id)->get();
    }
}
