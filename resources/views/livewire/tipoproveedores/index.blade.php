<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Tipos de Proveedores</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha creado</th>
                        <th class="text-center">Fecha Actualizado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tipos as $index => $tipo)
                        <tr>
                            <th scope="row">{{$tipos->firstItem() + $index}}</th>
                            <td class="text-center">{{$tipo->nombre}}</td>
                            <td class="text-center"><span class="badge {{$tipo->estado == 'Activo' ? 'badge-success' : 'badge-danger'}}">{{$tipo->estado}}</span></td>
                            <td class="text-center">{{$tipo->created_at}}</td>
                            <td class="text-center">{{$tipo->updated_at}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{$tipo->id}})" class="btn btn-primary" title="Editar">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{$tipo->id}}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$tipos->links()}}
                </div>
            </div>
        </div>
        @include('livewire.tipoproveedores.form')
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

