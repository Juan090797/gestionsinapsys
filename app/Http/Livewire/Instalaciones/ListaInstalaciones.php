<?php

namespace App\Http\Livewire\Instalaciones;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Instalacion;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListaInstalaciones extends Component
{
    use LivewireAlert;
    public $instalaciones,$selected_id,$clientes,$productos,$tecnicos,$pedidos;
    public $state = [];

    public function render()
    {
        $this->update();
        return view('livewire.instalaciones.lista-instalaciones')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->instalaciones();
        $this->clientes();
        $this->tecnicos();
        $this->productos();
        $this->pedidos();
    }
    public function instalaciones()
    {
        $this->instalaciones = Instalacion::all();
    }
    public function tecnicos()
    {
        $this->tecnicos = User::where('perfil','Soporte')->get();
    }
    public function clientes()
    {
        $this->clientes = Cliente::where('estado','ACTIVO')->get();
    }
    public function productos()
    {
        $this->productos = Producto::where(['estado' => 'ACTIVO', 'clasificacions_id' => '2'])->get();
    }
    public function pedidos()
    {
        $this->pedidos = Pedido::all();
    }
    public function Edit(Instalacion $instalacion)
    {
        $this->selected_id = $instalacion->id;
        $this->state = $instalacion->toArray();
        $this->emit('show-modal');
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'    => 'required',
            'user_id'       => 'required',
            'producto_id'   => 'required',
            'pedido_id'     => 'required',
            'estado'        => 'required',
            'fecha_entrega' => '',
            'notas'         => '',
        ],[
            'cliente_id.required'   => 'El cliente es requerido',
            'user_id.unique'        => 'El tecnico es requerido',
            'producto_id.min'       => 'El producto es requerido',
            'pedido_id.required'    => 'El pedido es requerido',
            'estado.required'    => 'El estado es requerido',
        ])->validate();

        $instalacion = Instalacion::findOrFail($this->state['id']);
        $instalacion->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Instalacion actualizado!!',['timerProgressBar' => true]);
    }
}
