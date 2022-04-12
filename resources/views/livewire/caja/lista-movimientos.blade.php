<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de movimientos {{$caja->nombre}}</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="btn btn-primary" wire:click="aprobar()">Aprobar</a>
                        <a class="btn btn-success" wire:click="exportMovimientos({{$caja}})"><i class="fas fa-file-excel"></i> Excel</a>
                    </div>
                    <div class="col-2">
                        <p class="text-primary"><b>Suma Ingresos:</b> S/ {{ number_format($sumaIngresos,2)}}</p>
                    </div>
                    <div class="col-2">
                        <p class="text-danger"><b>Suma Egresos:</b> S/ {{ number_format($sumaEgresos,2)}}</p>
                    </div>
                    <div class="col-2">
                        <p class="text-success"><b>Saldo:</b> S/ {{ number_format($saldo,2)}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Concepto</th>
                        <th class="text-center">Motivo</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($movimientos as $movimiento)
                        <tr>
                            <td>
                                @if($movimiento->estado == 'APROBADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $movimiento->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $movimiento->id }}">
                                @endif
                            </td>
                            <td class="text-center"><span class="badge {{ $movimiento->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{ $movimiento->estado }}</span></td>
                            <td class="text-center">
                                @if($movimiento->tipo == 'INGRESO')
                                    <i class="fa fa-plus" aria-hidden="true" style="color: blue"></i>
                                @else
                                    <i class="fa fa-minus" aria-hidden="true" style="color: red"></i>
                                @endif
                            <td class="text-center">{{ $movimiento->fecha }}</td>
                            <td class="text-center">{{ $movimiento->usuario->name }}</td>
                            <td class="text-center">{{$movimiento->concepto}}</td>
                            <td class="text-center">{{ $movimiento->motivo }}</td>
                            <td class="text-center">S/ {{ number_format($movimiento->importe,2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('movimiento-show',$movimiento) }}" class="btn btn-success" title="Ver">
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </a>
                                @if($movimiento->estado == 'APROBADO')
                                    <button type="button" class="btn btn-primary" wire:click="Edit({{ $movimiento->id }})" disabled><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                @else
                                    <button type="button" class="btn btn-primary" wire:click="Edit({{ $movimiento->id }})"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                @endif
                                <a href="javascript:void(0)"  onclick="Confirm('{{ $movimiento->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
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
        @include('livewire.caja.form-cajamovimiento')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('movimiento-added', msg =>{
                $('#theModal').modal('hide');
            })
            window.livewire.on('movimiento-updated', msg =>{
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

