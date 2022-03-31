<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Proyectos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por nombre" wire:model="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Proyecto</th>
                        <th class="text-center">Etapa</th>
                        <th class="text-center">Fecha inicio</th>
                        <th class="text-center">Fecha fin</th>
                        <th class="text-center">Ingreso Estimado</th>
                        <th class="text-center">Jefe Proyecto</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Equipo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proyectos as $proyecto)
                        <tr>
                            <td><a href="{{ route('proyecto.show', $proyecto) }}">{{$proyecto->nombre}}</a></td>
                            <td class="text-center">{{ $proyecto->etapa->nombre }}</td>
                            <td class="text-center">{{ $proyecto->fecha_inicio }}</td>
                            <td class="text-center">{{ $proyecto->fecha_fin}}</td>
                            <td class="text-center">S/ {{ $proyecto->ingreso_estimado }}</td>
                            <td class="text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item user-panel"><img src="{{ $proyecto->user->profile_photo_url }}" class="img-circle"></li>
                                </ul>
                            </td>
                            <td class="text-center">{{ $proyecto->cliente->razon_social }}</td>
                            <td class="text-center">
                                <ul class="list-inline mb-0">
                                    @if($proyecto->colaboradores)
                                        @foreach($proyecto->colaboradores as $r)
                                            <li class="list-inline-item user-panel">
                                                <img src="{{ $r->usuario->profile_photo_url }}" class="img-circle" alt="{{ $r->usuario->name }}">
                                            </li>
                                        @endforeach
                                    @else
                                        <p class="text-danger text-center">Sin Equipo</p>
                                    @endif
                                </ul>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $proyecto->id }})" class="btn btn-primary" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $proyecto->id }}')" class="btn btn-danger" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                    {{$proyectos->links()}}
                </div>
            </div>
        </div>
        @include('livewire.proyectos.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('proyecto-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('proyecto-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('proyecto-deleted', msg =>{
                noty(msg)
            })
            window.livewire.on('error', msg =>{
                noty(msg)
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
                if (result.isConfirmed) {
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado',
                        'success'
                    )
                }
            })
        }
    </script>
</div>

