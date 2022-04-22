<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\ArchivoPedido;
use App\Models\Comentario;
use App\Models\ComentarioPedido;
use App\Models\Garantia;
use App\Models\Instalacion;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $archivoComentario = $comentarioPedido->archivo;
        return Storage::disk('local')->download('pedidos_comentarios/'.$archivoComentario);
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
            $this->archivo_p->storeAs('pedidos_archivos', $nombreArchivo);
        }
        $this->pedido->archivos()->create([
            'tipo_documento' => $this->tipo,
            'archivo'       => $nombreArchivo,
        ]);
        $this->resetUI();
        $this->emit('archivo-added');
        $this->alert('success', 'Se agrego archivo',['timerProgressBar' => true]);
    }
    public function descargarArchivo(ArchivoPedido $archivoPedido)
    {
        $archivopedido = $archivoPedido->archivo;
        return Storage::disk('local')->download('pedidos_archivos/'.$archivopedido);
    }
    public function crearCronogramaGarantia(Pedido $pedido)
    {
        $mant = $pedido->num_mantenimiento > 0 ? true : false;
        DB::transaction(function() use($pedido,$mant) {
            foreach ($pedido->pedidoDetalle as $item){
                for ($i = 1; $i <= $item['cantidad']; $i++) {
                    Garantia::create([
                        'tiempo_garantia'   => $pedido->garantia,
                        'if_mantenimiento'  => $mant,
                        'mant_total'        => $pedido->num_mantenimiento,
                        'cliente_id'        => $pedido->cliente_id,
                        'producto_id'       => $item['producto_id'],
                        'pedido_id'         => $pedido->id,
                    ]);
                }
            }
        });
        $this->alert('success', 'Se genero los registros de garantias!!',['timerProgressBar' => true]);
    }
    public function crearInstalacion(Pedido $pedido)
    {
        DB::transaction(function() use($pedido) {
            foreach ($pedido->pedidoDetalle as $item){
                    Instalacion::create([
                        'cliente_id'    => $pedido->cliente_id,
                        'producto_id'   => $item['producto_id'],
                        'pedido_id'     => $pedido->id,
                    ]);
                }
        });
        $this->alert('success', 'Se genero los registros de instalaciones!!',['timerProgressBar' => true]);
    }
}
