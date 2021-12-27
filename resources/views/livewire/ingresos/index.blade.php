<div>
    @section('cabezera-contenido')
        <a href="{{route('ingresoscreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Ingresos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Tipo Doc.</th>
                        <th class="text-center">N° Doc.</th>
                        <th class="text-center">Fecha ingreso</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Doc. Referencia</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingresos as $index => $ingreso)
                        <tr>
                            <th scope="row">{{$ingresos->firstItem() + $index}}</th>
                            <td class="text-center">{{$ingreso->tipo_documento}}</td>
                            <td class="text-center">{{$ingreso->numero_guia}}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{$ingreso->proveedormovi->razon_social}}</td>
                            <td class="text-center"></td>
                            <td class="text-center"><span class="badge {{ $ingreso->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$ingreso->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $ingreso->id }})" class="btn btn-primary" title="Edit">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $ingreso->id }}')" class="btn btn-danger" title="Delet">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                    {{$ingresos->links()}}
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

