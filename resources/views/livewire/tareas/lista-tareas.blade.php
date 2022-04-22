<div>
    @section('cabezera-contenido')
        <h1>Lista de Tareas</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Mantenimientos({{count($mantenimientos)}})
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha ejecucion</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Tecnico responsable</th>
                                    <th class="text-center">Ultima Act.</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mantenimientos as $mantenimiento)
                                    <tr>
                                        <th scope="row">{{$mantenimiento->id}}</th>
                                        <td class="text-center"><span class="badge {{ $mantenimiento->estado_badge}}">{{$mantenimiento->estado}}</span></td>
                                        <td class="text-center">{{$mantenimiento->fecha_ejecucion}}</td>
                                        <td class="text-center">{{$mantenimiento->garantia->cliente->razon_social}}</td>
                                        <td class="text-center">{{$mantenimiento->garantia->producto->nombre}}</td>
                                        <td class="text-center">{{$mantenimiento->garantia->producto->marca->nombre}}</td>
                                        <td class="text-center">#SERIE</td>
                                        <td class="text-center">{{$mantenimiento->tecnico->name}}</td>
                                        <td class="text-center">{{$mantenimiento->updated_at->diffforhumans()}}</td>
                                        <td class="text-center">
                                            <a href="{{route('mantenimiento.show',$mantenimiento)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="py-3 float-right"></div>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Incidencias({{count($incidencias)}})
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha ejecucion</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Tecnico responsable</th>
                                    <th class="text-center">Ultima Act.</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incidencias as $incidencia)
                                    <tr>
                                        <th scope="row">{{$incidencia->id}}</th>
                                        <td class="text-center"><span class="badge {{ $incidencia->estado_badge }}">{{$incidencia->estado}}</span></td>
                                        <td class="text-center">{{$incidencia->fecha_ejecucion}}</td>
                                        <td class="text-center">{{$incidencia->cliente->razon_social}}</td>
                                        <td class="text-center">{{$incidencia->producto->nombre}}</td>
                                        <td class="text-center">{{$incidencia->producto->marca->nombre}}</td>
                                        <td class="text-center">#SERIE</td>
                                        <td class="text-center">{{$incidencia->tecnico->name}}</td>
                                        <td class="text-center">{{$incidencia->updated_at->diffforhumans()}}</td>
                                        <td class="text-center">
                                            <a href="{{route('incidencia.show',$incidencia)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="py-3 float-right"></div>
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Instalaciones({{count($instalaciones)}})
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha entrega</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Tecnico responsable</th>
                                    <th class="text-center">Ultima Act.</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($instalaciones as $instalacion)
                                    <tr>
                                        <th scope="row">{{$instalacion->id}}</th>
                                        <td class="text-center"><span class="badge {{ $instalacion->estado_badge }}">{{$instalacion->estado}}</span></td>
                                        <td class="text-center">{{$instalacion->fecha_entrega}}</td>
                                        <td class="text-center">{{$instalacion->cliente->razon_social}}</td>
                                        <td class="text-center">{{$instalacion->producto->nombre}}</td>
                                        <td class="text-center">{{$instalacion->producto->marca->nombre}}</td>
                                        <td class="text-center">#SERIE</td>
                                        <td class="text-center">{{$instalacion->tecnico->name}}</td>
                                        <td class="text-center">{{$instalacion->updated_at->diffforhumans()}}</td>
                                        <td class="text-center">
                                            <a href="{{route('instalacion.show',$instalacion)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="py-3 float-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

