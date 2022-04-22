<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Instalaciones</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">Fecha entrega</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Serie</th>
                        <th class="text-center">Tecnico</th>
                        <th class="text-center">Ultima actualizacion</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instalaciones as $instalacion)
                        <tr>
                            <th scope="row">{{$instalacion->id}}</th>
                            <td class="text-center"><span class="badge {{ $instalacion->estado_badge}}">{{$instalacion->estado}}</span></td>
                            <td class="text-center">{{$instalacion->fecha_entrega}}</td>
                            <td class="text-center">{{$instalacion->cliente->razon_social}}</td>
                            <td class="text-center">{{$instalacion->producto->nombre}}</td>
                            <td class="text-center">#serie</td>
                            <td class="text-center">{{$instalacion->tecnico->name ?? null}}</td>
                            <td class="text-center">{{$instalacion->updated_at->diffforhumans()}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $instalacion->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="." class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $instalacion->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right"></div>
            </div>
        </div>
        @include('livewire.instalaciones.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('hide-modal', msg =>{
                $('#theModal').modal('hide');
            })
        });
        function Confirm(id)
        {
            Swal.fire({
                title: 'CONFIRMAR',
                text: "¿CONFIRMAS ELIMINAR EL REGISTRO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if(result.value){
                    window.livewire.emit('deleteRow', id)
                    swal.close()
                }
            })
        }
    </script>
</div>

