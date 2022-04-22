<?php

namespace App\Http\Livewire\Tareas;

use App\Models\ComentarioIncidencia;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class VerIncidencia extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $incidencia,$comentarios,$archivo,$contenido,$estado;

    public function mount(Incidencia $incidencia)
    {
        $this->incidencia = $incidencia;
        $this->estado = $incidencia->estado;
    }
    public function render()
    {
        $this->update();
        return view('livewire.tareas.ver-incidencia')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->comentarios();
    }
    public function comentarios()
    {
        $this->comentarios = ComentarioIncidencia::all();
    }
    public function resetUI()
    {
        $this->selected_id  = '';
        $this->contenido    = '';
        $this->archivo      = '';
        $this->resetValidation();
    }
    public function createComentario()
    {
        if($this->archivo)
        {
            $nombreArchivo = $this->archivo->getClientOriginalName();
            $this->archivo->storeAs('incidencias_comentarios', $nombreArchivo);
        }
        $this->incidencia->comentarios()->create([
            'texto' => $this->contenido,
            'archivo'   => $nombreArchivo ?? null,
            'user_id'   => Auth::id(),
        ]);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Comentario agregado!!',['timerProgressBar' => true]);
    }
    public function updatedEstado($value)
    {
        $this->incidencia->update(['estado' => $value]);
        $this->alert('success', 'Incidencia actualizada!!',['timerProgressBar' => true]);
    }
    public function descargaArchivoComentario(ComentarioIncidencia $comentarioIncidencia)
    {
        $archivopedido = $comentarioIncidencia->archivo;
        return Storage::disk('local')->download('incidencias_comentarios/'.$archivopedido);
    }
}
