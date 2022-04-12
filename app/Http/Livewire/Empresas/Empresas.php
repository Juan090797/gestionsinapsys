<?php

namespace App\Http\Livewire\Empresas;
use App\Models\Empresa;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Empresas extends Component
{
    use LivewireAlert;
    public $nombre, $ruc, $celular, $correo, $telefono, $direccion;

    public function mount()
    {
        $record = Empresa::find(1, ['id','nombre', 'ruc', 'celular', 'correo', 'telefono', 'direccion']);
        $this->nombre = $record->nombre;
        $this->ruc = $record->ruc;
        $this->celular = $record->celular;
        $this->correo = $record->correo;
        $this->telefono = $record->telefono;
        $this->direccion = $record->direccion;
    }

    public function updateEmpresa()
    {
        $e = Empresa::find(1);
        $e->update([
            'nombre' => $this->nombre,
            'ruc' => $this->ruc,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'correo' => $this->correo,
        ]);
        $this->alert('success', 'Empresa actualizada!!',['timerProgressBar' => true]);
    }
    public function render()
    {
        return view('livewire.empresa.empresa')->extends('layouts.tema.app')->section('content');
    }
}
