@extends('layouts.tema.app')
@section('cabezera-contenido')
    <a href="{{ url('garantias') }}" class="btn btn-primary float-right">Atras</a>
    <h1>Informacion de la garantia</h1>
@endsection
@section('content')
    <div class="content-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p>
                                    <b>CLIENTE:</b> <br>
                                    Razon social: {{$garantia->cliente->razon_social}}<br>
                                    Ruc: {{$garantia->cliente->ruc}}<br>
                                    Telefono: {{$garantia->cliente->telefono}}<br>
                                    Celular: {{$garantia->cliente->celular}}<br>
                                    Direccion: {{$garantia->cliente->direccion}}
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>PRODUCTO:</b> <br>
                                    Nombre: {{$garantia->producto->nombre}}<br>
                                    Marca: {{$garantia->producto->marca->nombre}}<br>
                                    Modelo: {{$garantia->producto->modelo}}<br>
                                    Serie: #SERIE<br>
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>GARANTIA:</b> <br>
                                    Tiempo: {{$garantia->tiempo_garantia}} meses<br>
                                    Fecha fin de la garantia: {{$garantia->fin_garantia}}<br>
                                    Estado: <span class="badge {{ $garantia->estado == 'CG' ? 'badge-success' : 'badge-danger'}}">{{$garantia->estado}}</span><br>
                                    Mantenimientos totales: {{$garantia->mant_total}}<br>
                                    Mantenimientos realizados: {{$garantia->mant_realizados}}<br>
                                    Mantenimientos Pendientes: {{$garantia->mant_pendientes - $garantia->mant_realizados}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <livewire:mantenimientos.lista-mantenimientos :garantia="$garantia" />
            </div>
        </div>
    </div>
@endsection
