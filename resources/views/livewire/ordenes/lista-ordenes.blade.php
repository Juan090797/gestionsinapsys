<div>
    @section('cabezera-contenido')
        <a href="{{route('orden.create')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Ordenes Compras</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="btn btn-success" wire:click="AprobarMovimiento()">Aprobar</a>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por nombre del proveedor" wire:model="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="text-center">codigo</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Referencia</th>
                        <th class="text-center">IGV</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordenes as $orden)
                        <tr>
                            <th>
                                @if($orden->estado == 'APROBADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $orden->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $orden->id }}">
                                @endif
                            </th>
                            <td class="text-center">{{$orden->codigo}}</td>
                            <td class="text-center">{{$orden->proveedor->razon_social}}</td>
                            <td class="text-center">{{$orden->created_at}}</td>
                            <td class="text-center">{{$orden->referencia}}</td>
                            <td class="text-center">S/ {{$orden->impuesto}}</td>
                            <td class="text-center">S/ {{$orden->total}}</td>
                            <td class="text-center"><span class="badge {{ $orden->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$orden->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{route('orden.show', $orden)}}" class="btn btn-primary" title="Ver">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)"  wire:click="Edit({{ $orden->id }})" class="btn btn-primary" title="Editar">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $orden->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">

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

