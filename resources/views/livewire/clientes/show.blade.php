@extends('layouts.tema.app')
@section('cabezera-contenido')
    <a href="{{ url('clientes') }}" class="btn btn-primary float-right">Atras</a>
    <h1>Informacion del Cliente #{{$cliente->id}}</h1>
@endsection
@section('content')
    <div class="content-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p><b>Nombre del cliente:</b> {{$cliente->nombre}}</p>
                        <p><b>Razon social:</b> {{$cliente->razon_social}}</p>
                        <p><b>Ruc:</b>  {{$cliente->ruc}}</p>
                        <p><b>Estado:</b> {{$cliente->estado}}</p>
                        <p><b>Correo:</b> {{$cliente->correo}}</p>
                        <p><b>Pagina Web:</b> {{$cliente->pagina_web}}</p>
                        <p><b>Descripcion:</b> {{$cliente->descripcion}}</p>
                        <p><b>Detalles Bancarios:</b> {{$cliente->detalle_banco}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @livewire('contactos', ['cliente' => $cliente])
            </div>
        </div>
    </div>
@endsection
