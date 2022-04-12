<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Cajas</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th class="text-center">Nombre
                        <th class="text-center">Cajero</th>
                        <th class="text-center">Saldo</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cajas as $caja)
                        <tr>
                            <td>{{ $caja->id }}</td>
                            <td class="text-center">{{ $caja->nombre }}</td>
                            <td class="text-center">{{ $caja->user->name }}</td>
                            <td class="text-center">S/ {{ number_format($caja->saldo,2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('caja-movimientos',$caja) }}" class="btn btn-success btn-sm" title="Ver"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)"  wire:click="Edit({{ $caja->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)"  onclick="Confirm('{{ $caja->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">

                </div>
            </div>
        </div>
        @include('livewire.caja.form-caja')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('hide-modal', msg =>{
                $('#theModal').modal('hide');
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
            })
        }
    </script>
</div>

