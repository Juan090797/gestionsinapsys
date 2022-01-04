<?php

namespace App\Http\Livewire\Usuarios;

use App\Http\Livewire\ComponenteBase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class Usuarios extends ComponenteBase
{
    public $selected_id;
    public $state = [];

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function render()
    {
        $usuarios = User::latest()->paginate($this->pagination);
        return view('livewire.usuarios.index', ['usuarios' => $usuarios])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->state = $user->toArray();

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|min:3',
            'email' => 'required',
            'estado' => 'required',
            'area'   => 'required',
        ],[
            'name.required' => 'El nombre del centro de costo es requerido',
            'name.min' => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'email.required' => 'El correo es requerido',
            'estado.required' => 'El estado es requerido',
            'area.required' => 'El area es requerido',
        ])->validate();

        $validated['password'] = bcrypt('123456');

        User::create($validated);
        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|min:3',
            'email' => 'required',
            'estado' => 'required',
            'area'   => 'required',
        ],[
            'name.required' => 'El nombre del centro de costo es requerido',
            'name.min' => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'email.required' => 'El correo es requerido',
            'estado.required' => 'El estado es requerido',
            'area.required' => 'El area es requerido',
        ])->validate();

        $user = User::findOrFail($this->state['id']);
        $user->update($validated);
        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(User $user)
    {
        $user->delete();
        $this->resetUI();
        $this->emit('user-deleted', 'Usuario eliminado');
    }
}
