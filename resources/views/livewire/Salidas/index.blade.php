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
                                @if($salida->estado == 'APROBADO' || $salida->estado == 'ANULADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $salida->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $salida->id }}">
                                @endif
                            </th>
                            <td class="text-center">{{$salida->tipo_documento}}</td>
                            <td class="text-center">{{$salida->numero_guia}}</td>
                            <td class="text-center">{{$salida->fecha_documento}}</td>
                            <td class="text-center">{{$salida->nombre_cliente}}</td>
                            <td class="text-center">{{$salida->referencia}}</td>
                            <td class="text-center"><span class="badge {{ $salida->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$salida->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{ route('salida.show',$salida) }}" class="btn btn-primary" title="Ver">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                                @if($salida->estado == 'ANULADO')
                                <button href="javascript:void(0)" onclick="Confirm('{{ $salida->id }}')" class="btn btn-danger" title="Eliminar" disabled>
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                @else
                                    <button href="javascript:void(0)" onclick="Confirm('{{ $salida->id }}')" class="btn btn-danger" title="Eliminar">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                @endif
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
            window.livewire.on('marca-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('marca-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('marca-deleted', msg =>{
                noty(msg)
            })
            window.livewire.on('error', msg =>{
                noty(msg)
            })
            window.livewire.on('aprobado', msg =>{
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

