<div>
    @section('cabezera-contenido')
        <a href="{{route('ingresoscreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de guias de ingresos</h1>
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
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre">
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
                        <th class="text-center">Fecha ingreso</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Doc. Referencia</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingresos as $ingreso)
                        <tr>
                            <th>
                                @if($ingreso->estado == 'APROBADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $ingreso->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $ingreso->id }}">
                                @endif
                            </th>
                            <td class="text-center">{{$ingreso->tipo_documento}}</td>
                            <td class="text-center">{{$ingreso->numero_guia}}</td>
                            <td class="text-center">{{$ingreso->created_at}}</td>
                            <td class="text-center">{{$ingreso->nombre_cliente}}</td>
                            <td class="text-center">{{$ingreso->referencia}}</td>
                            <td class="text-center"><span class="badge {{ $ingreso->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$ingreso->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{route('ingreso.show', $ingreso)}}" class="btn btn-primary" title="Ver">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $ingreso->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$ingresos->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal-ingreso', msg =>{
                $('#theModalPedido').modal('show')
            });
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

