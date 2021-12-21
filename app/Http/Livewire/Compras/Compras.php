<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\ComponenteBase;
use App\Models\Compra;

class Compras extends ComponenteBase
{
    public $state= [];
    public $search, $selected_id;

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->selected_id = 0;
    }
    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = Compra::where('razon_social', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        }else {
            $data = Compra::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.compras.index', ['compras'=> $data])->extends('layouts.tema.app')->section('content');
    }
}
