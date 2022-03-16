<?php

namespace App\Http\Livewire\Usuarios;

use App\Http\Livewire\ComponenteBase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class Usuarios extends ComponenteBase
{
    public $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $usuarios = User::latest()->paginate($this->pagination);
        $roles = Role::orderBy('name', 'asc')->get();
        return view('livewire.usuarios.index', ['usuarios' => $usuarios, 'roles' => $roles])->extends('layouts.tema.app')->section('content');
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
        $validated['dni'] = bcrypt('1234567');
        $user = User::create($validated);
        $user->syncRoles($validated['perfil']);
        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'name'      => 'required|min:3',
            'email'     => 'required',
            'estado'    => 'required',
            'perfil'    => 'required',
            'area'      => 'required',
        ],[
            'name.required'     => 'El nombre del centro de costo es requerido',
            'name.min'          => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'email.required'    => 'El correo es requerido',
            'estado.required'   => 'El estado es requerido',
            'area.required'     => 'El area es requerido',
            'perfil.required'   => 'El perfil es requerido',
        ])->validate();

        $user = User::findOrFail($this->state['id']);
        $user->update($validated);
        $user->assignRole($validated['perfil']);
        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado');
    }

    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Destroy(User $user)
    {
        $user->delete();
        $this->resetUI();
        $this->emit('user-deleted', 'Usuario eliminado');
    }
}
