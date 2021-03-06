@extends('layouts.tema.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <a href="{{ url('clientes') }}" class="btn btn-primary float-right">Atras</a>
                        <h1>Informacion del Cliente #{{$cliente->id}}</h1>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>Nombre del cliente: {{$cliente->nombre}}</p>
                        <p>Razon social: {{$cliente->razon_social}}</p>
                        <p>Ruc:  {{$cliente->ruc}}</p>
                        <p>Estado: {{$cliente->estado}}</p>
                        <p>Correo: {{$cliente->correo}}</p>
                        <p>Pagina Web: {{$cliente->pagina_web}}</p>
                        <p>Descripcion: {{$cliente->descripcion}}</p>
                        <p>Detalles Bancarios: {{$cliente->detalle_banco}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @livewire('contactos', ['cliente' => $cliente])
            </div>
        </div>

    </div>
@endsection
