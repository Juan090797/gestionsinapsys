<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Proveedores</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por ruc">
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <form method="post" action="{{url('proveedors/imports/')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" required>
                                    <label name="file" id="file" class="custom-file-label">Seleccionar archivo excel ....</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cargar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Ruc</th>
                        <th class="text-center">Razon Social</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Pagina Web</th>
                        <th class="text-center">Tipo Proveedor</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proveedores as $index => $proveedor)
                        <tr>
                            <th scope="row">{{$proveedores->firstItem() + $index}}</th>
                            <td class="text-center">{{$proveedor->ruc}}</td>
                            <td class="text-left">{{$proveedor->razon_social}}</td>
                            <td class="text-left">{{$proveedor->telefono}}</td>
                            <td class="text-left">{{$proveedor->correo}}</td>
                            <td class="text-left">{{$proveedor->pagina_web}}</td>
                            <td class="text-center">{{$proveedor->tipo->nombre}}</td>
                            <td class="text-center"><span class="badge {{ $proveedor->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$proveedor->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $proveedor->id }})" class="btn btn-primary" title="Edit">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $proveedor->id }}')" class="btn btn-danger" title="Delet">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                    {{$proveedores->links()}}
                </div>
            </div>
        </div>
        @include('livewire.proveedores.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('proveedor-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('proveedor-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('proveedor-deleted', msg =>{
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

