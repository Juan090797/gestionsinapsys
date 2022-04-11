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
                        <th class="text-center">Fecha doc.</th>
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
                                <input type="checkbox" wire:model="selectedProducts" value="{{ $ingreso->id }}" {{ $ingreso->estado_disabled}}>
                            </th>
                            <td class="text-center">{{$ingreso->tipo_documento}}</td>
                            <td class="text-center">{{$ingreso->numero_guia}}</td>
                            <td class="text-center">{{$ingreso->created_at}}</td>
                            <td class="text-center">{{$ingreso->nombre_cliente}}</td>
                            <td class="text-center">{{$ingreso->referencia}}</td>
                            <td class="text-center"><span class="badge {{ $ingreso->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$ingreso->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{route('ingreso.show', $ingreso)}}" class="btn btn-primary btn-sm" title="Ver"><i class="far fa-eye" aria-hidden="true"></i></a>
                                <button href="{{route('ingreso.edit', $ingreso)}}" class="btn btn-warning btn-sm" title="editar" {{ $ingreso->estado_disabled }}><i class="fas fa-pen"aria-hidden="true"></i></button>
                                <button href="javascript:void(0)" onclick="Confirm('{{ $ingreso->id }}')" class="btn btn-danger btn-sm" title="Eliminar" {{ $ingreso->estado == 'ANULADO' ? 'disabled' : ''}}><i class="fa fa-trash" aria-hidden="true"></i></button>
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

