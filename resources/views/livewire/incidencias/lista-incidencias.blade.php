<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Incidencias</h1>
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
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha registro</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Contacto</th>
                        <th class="text-center">Area</th>
                        <th class="text-center">Canal comunicacion</th>
                        <th class="text-center">Equipo</th>
                        <th class="text-center">Serie</th>
                        <th class="text-center">Incidencia</th>
                        <th class="text-center">Prioridad</th>
                        <th class="text-center">Requiere visita</th>
                        <th class="text-center">Fecha aviso</th>
                        <th class="text-center">Tecnico</th>
                        <th class="text-center">Reporte</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($incidencias as $incidencia)
                        <tr>
                            <th scope="row">{{$incidencia->id}}</th>
                            <td class="text-center"><span class="badge {{ $incidencia->estado_badge}}">{{$incidencia->estado}}</span></td>
                            <td class="text-center">{{$incidencia->created_at}}</td>
                            <td class="text-center">{{$incidencia->cliente->razon_social}}</td>
                            <td class="text-center">{{$incidencia->contacto->nombre}}</td>
                            <td class="text-center">{{$incidencia->contacto->area_cont}}</td>
                            <td class="text-center">{{$incidencia->canal_comunicacion}}</td>
                            <td class="text-center">{{$incidencia->producto->nombre}}</td>
                            <td class="text-center">#SERIE</td>
                            <td class="text-center">{{$incidencia->txt_incidencia}}</td>
                            <td class="text-center">{{$incidencia->prioridad}}</td>
                            <td class="text-center"><i class="fa fa-check-circle" aria-hidden="true" style="{{$incidencia->if_visita == true ? 'color:blue' : null}}"></i></td>
                            <td class="text-center">{{$incidencia->fecha_aviso}}</td>
                            <td class="text-center">{{$incidencia->tecnico->name}}</td>
                            <td class="text-center"><a href="#">{{$incidencia->reporte}}</a></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $incidencia->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('incidencia.show',$incidencia)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $incidencia->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">

                </div>
            </div>
        </div>
        @include('livewire.incidencias.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            $('#sidebarCollapse1').on('change', function() {
                $('body').toggleClass('sidebar-collapse1');
            })
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


