<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Proyectos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="btn-group">
                        <button wire:click="filtroProyectosEstados" type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                            <span class="mr-1">TODOS</span>
                            <span class="badge badge-pill badge-info">{{ $proyectosCount }}</span>
                        </button>
                        <button wire:click="filtroProyectosEstados('DEFINIDO')" type="button" class="btn {{ ($status === 'DEFINIDO') ? 'btn-secondary' : 'btn-default' }}">
                            <span class="mr-1">DEFINIDOS</span>
                            <span class="badge badge-pill badge-success">{{ $proyectosDefinidosCount }}</span>
                        </button>
                        <button wire:click="filtroProyectosEstados('APROBADO')" type="button" class="btn {{ ($status === 'APROBADO') ? 'btn-secondary' : 'btn-default' }}">
                            <span class="mr-1">APROBADOS</span>
                            <span class="badge badge-pill badge-primary">{{ $proyectosAprobadosCount }}</span>
                        </button>
                        <button wire:click="filtroProyectosEstados('ARCHIVADO')" type="button" class="btn {{ ($status === 'ARCHIVADO') ? 'btn-secondary' : 'btn-default' }}">
                            <span class="mr-1">ARCHIVADOS</span>
                            <span class="badge badge-pill badge-danger">{{ $proyectosArchivadosCount }}</span>
                        </button>
                        <button wire:click="filtroProyectosEstados('COMPLETADO')" type="button" class="btn {{ ($status === 'COMPLETADO') ? 'btn-secondary' : 'btn-default' }}">
                            <span class="mr-1">COMPLETADOS</span>
                            <span class="badge badge-pill badge-warning">{{ $proyectosCompletadosCount }}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Proyecto</th>
                        <th class="text-center">Prioridad</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Etapa</th>
                        <th class="text-center">Fecha inicio</th>
                        <th class="text-center">Fecha fin</th>
                        <th class="text-center">Ingreso Estimado</th>
                        <th class="text-center">Jefe Proyecto</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Dias restantes</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proyectos as $proyecto)
                        <tr>
                            <td scope="col">{{ $proyecto->nombre }}</td>
                            <td class="text-center"><span class="badge {{ $proyecto->prioridad_badge }}">{{ $proyecto->prioridad }}</span></td>
                            <td class="text-center"><span class="badge {{ $proyecto->estado_badge }}">{{ $proyecto->estado }}</span></td>
                            <td class="text-center">{{ $proyecto->etapa->nombre }}</td>
                            <td class="text-center">{{ $proyecto->inicio }}</td>
                            <td class="text-center">{{ $proyecto->fin}}</td>
                            <td class="text-center">S/ {{ $proyecto->ingreso_estimado }}</td>
                            <td class="text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item user-panel"><img src="{{ $proyecto->lider->profile_photo_url }}" class="img-circle" title="{{ $proyecto->lider->name }}"></li>
                                </ul>
                            </td>
                            <td class="text-center">{{ $proyecto->cliente->razon_social }}</td>
                            <td class="text-center {{ $proyecto->restante > 0 ? 'text-primary' : 'text-danger'}}">{{ $proyecto->restante }} días</td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $proyecto->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{ route('proyecto.show', $proyecto) }}" class="btn btn-primary btn-sm" title="Ver"><i class="far fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $proyecto->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
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

