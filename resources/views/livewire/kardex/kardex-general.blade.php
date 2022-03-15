<div>
    @section('cabezera-contenido')
        <h1>Kardex</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <form wire:submit.prevent="consultar">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input id="fecha_inicio" class="form-control" type="date" wire:model.defer="state.fecha_inicio">
                            </div>
                            @error('fecha_inicio') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input id="fecha_fin" class="form-control" type="date" wire:model.defer="state.fecha_fin">
                            </div>
                            @error('fecha_fin') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success mt-4">Consultar</button>
                        </div>
                        @if($data)
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary mt-4" id='btn_print' onclick="printDiv('areaImprimir')">Imprimir</button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            @if($data)
                <div class="card-body table-responsive" id="areaImprimir">
                    <h3 class="text-center">Kardex General</h3>
                    <h5 class="text-center">Del:{{$fecha_inicio}}  Saldo a la Fecha:{{$fecha_fin}}</h5>
                    <table class="table table-sm table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Saldo Inicial</th>
                            <th class="text-center">Total Ingresos</th>
                            <th class="text-center">Total Salidas</th>
                            <th class="text-center">Saldo Final</th>
                            <th class="text-center">Valorizado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            @foreach($d->movimientoDetalles as $l)
                                <tr>
                                    <td class="">{{$l->producto->nombre.'-'. $d->numero_guia}}</td>
                                    <td class="text-center">0</td>
                                    @if($d->tipo_documento == "GI")
                                        <td class="text-center text-primary">{{number_format($l->cantidad,2)}}</td>
                                        <td class="text-center text-danger"></td>
                                    @else
                                        <td class="text-center text-primary"></td>
                                        <td class="text-center text-danger">{{number_format($l->cantidad,2)}}</td>
                                    @endif
                                    <td class="text-center">{{$sumEntradas .'-'. $sumSalidas}}</td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach
                        @endforeach
                        <tr>
                            <th scope="row"></th>
                            <td class="text-center">Stock actual: <b></b> </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">Resumen</td>
                            <td class="text-center text-primary"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
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
    @push('js')
        <script>
            function printDiv(areaImprimir) {
                var contenido = document.getElementById(areaImprimir).innerHTML;
                var contenidoOriginal = document.body.innerHTML;
                document.body.innerHTML = contenido;
                window.print();
                document.body.innerHTML = contenidoOriginal;
            }
        </script>
    @endpush
</div>

