<?php

namespace App\Http\Livewire\Usuarios;

use App\Http\Livewire\ComponenteBase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class Usuarios extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id,$usuarios,$roles;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $this->update();
        return view('livewire.usuarios.index')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->usuarios();
        $this->roles();
    }
    public function usuarios()
    {
        $this->usuarios = User::where('estado','ACTIVO')->get();
    }
    public function roles()
    {
        $this->roles = Role::all();
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
        $this->emit('hide-modal');
        $this->alert('success', 'Usuario creado!!',['timerProgressBar' => true]);
    }
    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->state = $user->toArray();
        $this->emit('show-modal', 'show-modal!');
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
        $this->emit('hide-modal');
        $this->alert('success', 'Usuario actualizado!!',['timerProgressBar' => true]);
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
        $user->update(['estado'=>'INACTIVO']);
        $this->resetUI();
        $this->alert('success', 'Usuario eliminado!!',['timerProgressBar' => true]);
    }
}
