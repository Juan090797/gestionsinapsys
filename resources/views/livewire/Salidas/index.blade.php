<div>
    @section('cabezera-contenido')
        <a href="{{route('salidascreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de guias de salidas</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="btn btn-success" wire:click="AprobarMovimiento()">Aprobar</a>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre del cliente o usuario">
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="text-center">Tipo Doc.</th>
                        <th class="text-center">N° Doc.</th>
                        <th class="text-center">Fecha Salida</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Doc. Referencia</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salidas as $salida)
                        <tr>
                            <th>
                                <input type="checkbox" wire:model="selectedProducts" value="{{ $salida->id }}" {{ $salida->estado_disabled }}>
                            </th>
                            <td class="text-center">{{$salida->tipo_documento}}</td>
                            <td class="text-center">{{$salida->numero_guia}}</td>
                            <td class="text-center">{{$salida->fecha_documento}}</td>
                            <td class="text-center">{{$salida->nombre_cliente}}</td>
                            <td class="text-center">{{$salida->referencia}}</td>
                            <td class="text-center"><span class="badge {{ $salida->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$salida->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{ route('salida.show',$salida) }}" class="btn btn-primary btn-sm" title="Ver"><i class="far fa-eye" aria-hidden="true"></i></a>
                                <button href="{{route('salida.edit', $salida)}}" class="btn btn-warning btn-sm" title="editar" {{ $salida->estado_disabled }}><i class="fas fa-pen"aria-hidden="true"></i></button>
                                <button href="javascript:void(0)" onclick="Confirm('{{ $salida->id }}')" class="btn btn-danger btn-sm" title="Eliminar" {{ $salida->estado == 'ANULADO' ? 'disabled' : '' }}><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$salidas->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
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

