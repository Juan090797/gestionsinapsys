<?php

namespace App\Http\Livewire\Tareas;

use App\Models\Categoria;
use App\Models\ComentarioIncidencia;
use App\Models\ComentarioInstalacion;
use App\Models\Instalacion;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class VerInstalacion extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $instalacion,$comentarios,$archivo,$estado,$contenido,$items,$titulo,$checked;

    public function mount(Instalacion $instalacion)
    {
        $this->instalacion = $instalacion;
    }
    public function render()
    {
        $this->update();
        return view('livewire.tareas.ver-instalacion')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->comentarios();
        $this->items();
    }
    public function comentarios()
    {
        $this->comentarios = ComentarioInstalacion::where('instalacion_id',$this->instalacion->id)->get();
    }
    public function items()
    {
        $this->items = Item::where('instalacion_id',$this->instalacion->id)->get();
    }
    public function updatedEstado($value)
    {
        $this->instalacion->update(['estado' => $value]);
        $this->alert('success', 'Instalacion actualizado!!',['timerProgressBar' => true]);
    }
    public function createComentario()
    {
        if($this->archivo)
        {
            $nombreArchivo = $this->archivo->getClientOriginalName();
            $this->archivo->storeAs('instalaciones_comentarios', $nombreArchivo);
        }
        $this->instalacion->comentarios()->create([
            'texto' => $this->contenido,
            'archivo'   => $nombreArchivo ?? null,
            'user_id'   => Auth::id(),
        ]);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Comentario agregado!!',['timerProgressBar' => true]);
    }
    public function descargaArchivoComentario(ComentarioInstalacion $comentarioInstalacion)
    {
        $archivopedido = $comentarioInstalacion->archivo;
        return Storage::disk('local')->download('instalaciones_comentarios/'.$archivopedido);
    }
    public function agregarItem()
    {
        $validated = $this->validate([
            'titulo' => 'required|min:6',
        ],[
            'titulo.required'   => 'El titulo es requerido',
        ]);
        $this->instalacion->items()->create($validated);
        $this->resetUI();
        $this->emit('hide-modal-item');
        $this->alert('success', 'Item agregado!!',['timerProgressBar' => true]);
    }
    public function itemClick(Item $item)
    {
        if($item->checked == true){
            $item->update(['checked' => false]);
            $this->alert('success', 'Item actualizado!!',['timerProgressBar' => true]);
        }else{
            $item->update(['checked' => true]);
            $this->alert('success', 'Item actualizado!!',['timerProgressBar' => true]);
        }
    }
    public function resetUI()
    {
        $this->selected_id  = '';
        $this->contenido    = '';
        $this->archivo      = '';
        $this->titulo       = '';
        $this->resetValidation();
    }
}
