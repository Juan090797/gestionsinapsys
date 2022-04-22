<?php

namespace App\Http\Livewire\Tareas;

use App\Models\ComentarioMantenimiento;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class VerMantenimiento extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $mantenimiento,$selected_id,$comentarios,$estado,$archivo,$contenido;

    public function mount(Mantenimiento $mantenimiento)
    {
        $this->mantenimiento = $mantenimiento;
        $this->estado = $mantenimiento->estado;
    }
    public function render()
    {
        $this->update();
        return view('livewire.tareas.ver-mantenimiento')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->comentarios();
    }
    public function comentarios()
    {
        $this->comentarios = ComentarioMantenimiento::where('mantenimiento_id',$this->mantenimiento->id)->get();
    }
    public function createComentario()
    {
        if($this->archivo)
        {
            $nombreArchivo = $this->archivo->getClientOriginalName();
            $this->archivo->storeAs('mantenimientos_comentarios', $nombreArchivo);
        }
        $this->mantenimiento->comentarios()->create([
            'texto' => $this->contenido,
            'archivo'   => $nombreArchivo ?? null,
            'user_id'   => Auth::id(),
        ]);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Comentario agregado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->selected_id  = '';
        $this->contenido    = '';
        $this->archivo      = '';
        $this->resetValidation();
    }
    public function updatedEstado($value)
    {
        $this->mantenimiento->update(['estado' => $value]);
        $this->alert('success', 'Mantenimiento actualizado!!',['timerProgressBar' => true]);
    }
    public function descargaArchivoComentario(ComentarioMantenimiento $comentarioMantenimiento)
    {
        $archivopedido = $comentarioMantenimiento->archivo;
        return Storage::disk('local')->download('mantenimientos_comentarios/'.$archivopedido);
    }
}
