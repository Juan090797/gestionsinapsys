<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Proyectos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">Prioridad</th>
                        <th scope="col">Fecha inicio</th>
                        <th scope="col">Ingreso Estimado</th>
                        <th scope="col">Jefe Proyecto</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">EQUIPO</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proyectos as $index => $proyecto)
                        <tr>
                            <th scope="row">{{$proyectos->firstItem() + $index}}</th>
                            <td><a href="{{ route('proyecto.show', $proyecto) }}">{{$proyecto->nombre}}</a></td>
                            <td>{{ $proyecto->prioridad }}</td>
                            <td>{{ $proyecto->fecha_inicio }}</td>
                            <td>S/ {{ $proyecto->ingreso_estimado }}</td>
                            <td>{{ $proyecto->user->name }}</td>
                            <td>{{ $proyecto->cliente->razon_social }}</td>
                            <td>
                                <div class="row">
                                    @if($proyecto->team)
                                        @foreach($proyecto->team as $r)
                                            @if($proyecto->user->name = $r)
                                                <div class="col-md-4 user-panel p-2 b-1">
                                                    <img src="{{ $proyecto->user->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p class="text-danger text-center">Sin Equipo</p>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)"  wire:click="Edit({{ $proyecto->id }})" class="btn btn-primary" title="Editar">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $proyecto->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
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
            $('.select2').select2();
            $('.select2').on('change', function () {
                let data = $(this).val();
                @this.set('state.team', $(this).val());
            });

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
        });

        function Confirm(id)
        {
            swal({
                title: 'CONFIRMAR',
                text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonText: 'Aceptar',
                getConfirmButtonColor: '#3B3F5C'
            }).then(function (result){
                if(result.value){
                    window.livewire.emit('deleteRow', id)
                    swal.close()
                }
            })
        }
    </script>
</div>

