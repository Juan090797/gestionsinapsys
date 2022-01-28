<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Categorias</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por nombre" wire:model="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">Fecha Creado</th>
                        <th class="text-center">Fecha Actualizacion</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorias as $index => $categoria)
                    <tr>
                        <th scope="row">{{$categorias->firstItem() + $index}}</th>
                        <td class="text-center">{{$categoria->nombre}}</td>
                        <td class="text-center"><span class="badge {{ $categoria->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$categoria->estado}}</span></td>
                        <td class="text-center">{{$categoria->created_at}}</td>
                        <td class="text-center">{{$categoria->updated_at}}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)"  wire:click="Edit({{ $categoria->id }})" class="btn btn-primary" title="Edit">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="Confirm('{{ $categoria->id }}')" class="btn btn-danger" title="Delet">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$categorias->links()}}
                </div>
            </div>
        </div>
        @include('livewire.categorias.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('categoria-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('categoria-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('categoria-deleted', msg =>{
                noty(msg)
            })
            window.livewire.on('error', msg =>{
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

