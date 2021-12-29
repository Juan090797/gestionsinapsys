<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use DB;

class Dashboard extends Component
{

    public function cliente()
    {
        return redirect()->to('clientes');
    }
    public function producto()
    {
        return redirect()->to('productos');
    }
    public function proyecto()
    {
        return redirect()->to('proyectos');
    }
    public function render()
    {
        return view('livewire.dashboard',
        [
            'contactos' => Contacto::all(),
            'clientes' => Cliente::all(),
            'productos' => Producto::all(),
            'proyectos' => Proyecto::all(),
        ]
        )->extends('layouts.tema.app')->section('content');
    }
}
