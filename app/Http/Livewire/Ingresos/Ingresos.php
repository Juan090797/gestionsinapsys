<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Models\MovimientoAlmacen;

class Ingresos extends ComponenteBase
{
    public $search, $selected_id;
    public $state = [];

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = MovimientoAlmacen::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = MovimientoAlmacen::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.ingresos.index', ['ingresos' => $data])->extends('layouts.tema.app')->section('content');
    }
}
