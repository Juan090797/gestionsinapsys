<div>
    @section('cabezera-contenido')
        <h1>Cronograma de Garantias</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Equipo</th>
                        <th class="text-center">OrdenCompra</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        <th class="text-center">Serie</th>
                        <th class="text-center">Tiempo Garantia</th>
                        <th class="text-center">Fin Garantia</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Mantenimiento</th>
                        <th class="text-center">Prioridad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($garantias as $garantia)
                        <tr>
                            <th scope="row">{{$garantia->id}}</th>
                            <td class="text-center">{{$garantia->cliente->razon_social}}</td>
                            <td class="text-center">{{$garantia->producto->nombre}}</td>
                            <td class="text-center">{{$garantia->orden_compra}}</td>
                            <td class="text-center">{{$garantia->producto->marca->nombre}}</td>
                            <td class="text-center">{{$garantia->producto->modelo}}</td>
                            <td class="text-center">Serie</td>
                            <td class="text-center">{{$garantia->tiempo_garantia}} meses</td>
                            <td class="text-center">{{$garantia->fin}}</td>
                            <td class="text-center"><span class="badge {{ $garantia->estado == 'CG' ? 'badge-success' : 'badge-danger'}}">{{$garantia->estado}}</span></td>
                            <td class="text-center"><i class="fa fa-check-circle" aria-hidden="true" style="{{$garantia->if_mantenimiento == true ? 'color:blue' : null}}"></i></td>
                            <td class="text-center"><span class="badge {{ $garantia->prioridad == 'REGULAR' ? 'badge-info' : 'badge-warning'}}">{{$garantia->prioridad}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $garantia->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('garantia.show', $garantia)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $garantia->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">

                </div>
            </div>
        </div>
        @include('livewire.garantias.form')
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

