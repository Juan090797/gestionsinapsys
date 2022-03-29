<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\ArchivoPedido;
use App\Models\Comentario;
use App\Models\ComentarioPedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class PedidoShow extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $selected_id;
    public $pedido,$archivo,$contenido,$tipo,$archivo_p,$files;

    public function mount(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }
    public function render()
    {
        $this->update();
        return view('livewire.pedidos.pedido-show')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->comentarios();
        $this->files();
    }
    public function comentarios()
    {
        $this->comentarios = ComentarioPedido::where('pedido_id', $this->pedido->id)->latest()->get();
    }
    public function files()
    {
        $this->files = ArchivoPedido::where('pedido_id', $this->pedido->id)->get();
    }
    public function resetUI()
    {
        $this->selected_id  = '';
        $this->contenido    = '';
        $this->archivo      = '';
        $this->archivo_p    = '';
        $this->tipo         = '';
        $this->resetValidation();
    }

    public function createComentario()
    {
        if($this->archivo)
        {
            $nombreArchivo = $this->archivo->getClientOriginalName();
            $this->archivo->storeAs('pedidos_comentarios', $nombreArchivo);
        }
        $this->pedido->comentarios()->create([
            'contenido' => $this->contenido,
            'archivo'   => $nombreArchivo ?? null,
            'user_id'   => Auth::id(),
        ]);
        $this->resetUI();
        $this->emit('comentario-added');
        $this->alert('success', 'Se agrego comentario',['timerProgressBar' => true]);
    }
    public function descargaArchivoComentario(ComentarioPedido $comentarioPedido)
    {
        $archivopedido = $comentarioPedido->archivo;
        return Storage::disk('local')->download('pedidos_comentarios/'.$archivopedido);
    }
    public function agregarArchivo()
    {
        $rules = [
            'tipo' => 'required',
            'archivo_p' => 'required',
        ];
        $messages =[
            'tipo.required'     => 'El tipo de archivo es requerido',
            'archivo_p.required'=> 'El archivo es requerido',
        ];
        $this->validate($rules, $messages);

        if($this->archivo_p)
        {
            $nombreArchivo = $this->archivo_p->getClientOriginalName();
            $this->archivo_p->storeAs('pedidos_comentarios', $nombreArchivo);
        }
        $this->pedido->archivos()->create([
            'tipo_documento' => $this->tipo,
            'archivo_p'      => $nombreArchivo,
        ]);
        $this->resetUI();
        $this->emit('archivo-added');
        $this->alert('success', 'Se agrego archivo',['timerProgressBar' => true]);
    }
}
