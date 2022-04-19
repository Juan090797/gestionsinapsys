<?php

namespace App\Http\Livewire\Garantias;

use App\Models\Garantia;
use Livewire\Component;

class ShowGarantia extends Component
{
    public $garantia;

    public function mount(Garantia $garantia)
    {
        $this->garantia = $garantia;
    }
    public function render()
    {
        return view('livewire.garantias.show-garantia')->extends('layouts.tema.app')->section('content');
    }
}
