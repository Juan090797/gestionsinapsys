<?php

namespace App\Http\Livewire\Caja;

use App\Models\CajaMovimiento;
use Livewire\Component;

class ShowMovimiento extends Component
{
    public $movimiento;

    public function mount($movimiento)
    {
        $this->movimiento = CajaMovimiento::with('cliente','usuario','caja')->find($movimiento);
    }
    public function render()
    {
        return view('livewire.caja.show-movimiento')->extends('layouts.tema.app')->section('content');
    }
}
