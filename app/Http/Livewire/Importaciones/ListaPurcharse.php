<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Purchase;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListaPurcharse extends Component
{
    use LivewireAlert;
    public $ordenes;

    Protected $listeners = ['deleteRow' => 'Anular'];
    public function render()
    {
        $this->update();
        return view('livewire.importaciones.lista-purcharse')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->ordenes();
    }
    public function ordenes()
    {
        $this->ordenes = Purchase::all();
    }
    public function Anular()
    {
        $this->alert('success', 'Purchase Order anulado!!',['timerProgressBar' => true]);
    }
}
