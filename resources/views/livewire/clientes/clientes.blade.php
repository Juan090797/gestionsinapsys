<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Clientes</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre o ruc de un cliente">
                    </div>
                    <div class="col-4">
                        <a class="btn btn-success" href="{{ url('clientes/exports/') }}"><i class="fas fa-file-excel"></i> Excel</a>
                    </div>
                    <div class="col-4">
                        <form method="post" action="{{url('clientes/imports/')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" required>
                                    <label name="file" id="file" class="custom-file-label">Seleccionar archivo excel ....</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Insertar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Rz. Social</th>
                            <th class="text-center">Ruc</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <th scope="row">{{ $cliente->razon_social }}</th>
                            <td class="text-center">{{$cliente->ruc}}</td>
                            <td class="text-center">{{$cliente->correo}}</td>
                            <td class="text-center">{{$cliente->telefono}}</td>
                            <td class="text-center"><span class="badge {{ $cliente->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$cliente->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $cliente->id }})" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{ route('clients.show', $cliente) }}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $cliente->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$clientes->links()}}
                </div>
            </div>
        </div>
        @include('livewire.clientes.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('cliente-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('cliente-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('cliente-deleted', msg =>{
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
