<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contacto;
use http\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('livewire.clientes.show', compact('cliente'));
    }
}
