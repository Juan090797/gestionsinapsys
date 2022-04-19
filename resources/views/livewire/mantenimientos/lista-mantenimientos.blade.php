<div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
            <b><h5>MANTENIMIENTOS</h5></b>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Tecnico</th>
                        <th class="text-center">Fecha ejecucion</th>
                        <th class="text-center">Reporte(PDF)</th>
                        <th class="text-center">Fecha actualizacion</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mantenimientos as $mantenimiento)
                    <tr>
                        <th scope="row">{{$mantenimiento->id}}</th>
                        <td class="text-center"><span class="badge {{$mantenimiento->estado_badge}}">{{$mantenimiento->estado}}</span></td>
                        <td class="text-center">{{$mantenimiento->tecnico->name}}</td>
                        <td class="text-center">{{$mantenimiento->ejecucion}}</td>
                        <td class="text-center"><a href="#">{{$mantenimiento->reporte}}</a></td>
                        <td class="text-center">{{$mantenimiento->updated_at->diffforhumans()}}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)"  wire:click="Edit({{ $mantenimiento->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                            <a href="." class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="javascript:void(0)" onclick="Confirm('{{ $mantenimiento->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('livewire.mantenimientos.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
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
