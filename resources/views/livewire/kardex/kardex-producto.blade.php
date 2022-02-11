<div>
    @section('cabezera-contenido')
        <h1>Kardex</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <form wire:submit.prevent="consultar">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="producto_id">Producto</label>
                                <select wire:model.defer="state.producto_id" id="producto_id" class="form-control">
                                    <option value="ELEGIR" selected>Elegir</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->codigo . ' - ' . $producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('producto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
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
                <h3 class="text-center">Kardex de producto: {{$pro->nombre}}</h3>
                <h5 class="text-center">Del:{{$fecha_inicio}}  Saldo a la Fecha:{{$fecha_fin}}</h5>
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th class="text-center">Operacion</th>
                        <th class="text-center">Documento</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Referencia</th>
                        <th class="text-center">Entradas</th>
                        <th class="text-center">Salidas</th>
                        <th class="text-center">Saldo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td class="text-center">Saldo inicial:</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">0.00</td>
                    </tr>
                    @foreach($data as $d)
                        <tr>
                            <th scope="row">{{$d->fecha_documento}}</th>
                            <td class="">{{$d->motivos->nombre}}</td>
                            <td class="text-center">{{$d->numero_guia}}</td>
                            <td class="text-center">{{$d->nombre_cliente}}</td>
                            <td class="text-center">{{$d->referencia}}</td>
                            @foreach($d->movimientoDetalles as $detalle)
                                @if($detalle->producto_id == $pro->id)
                                    @if($d->tipo_documento == "GI")
                                        <td class="text-center text-primary">{{number_format($detalle->cantidad,2)}}</td>
                                    @else
                                        <td class="text-center text-primary">-</td>
                                    @endif
                                @endif
                            @endforeach
                            @foreach($d->movimientoDetalles as $detalle)
                                @if($detalle->producto_id == $pro->id)
                                    @if($d->tipo_documento == "GS")
                                        <td class="text-center text-danger">{{number_format($detalle->cantidad,2)}}</td>
                                    @else
                                        <td class="text-center text-danger">-</td>
                                    @endif
                                @endif
                            @endforeach
                            @foreach($d->movimientoDetalles as $detalle)
                                @if($detalle->producto_id == $pro->id)
                                    @if($d->tipo_documento == "GI")
                                        <td class="text-center text-primary">{{number_format($detalle->cantidad + $detalle->stock_old,2)}}</td>
                                    @else
                                        @if($detalle->stock_old > 0)
                                            <td class="text-center text-primary">{{number_format($detalle->stock_old - $detalle->cantidad,2)}}</td>
                                        @else
                                            <td class="text-center text-primary">{{number_format($detalle->cantidad - $detalle->stock_old,2)}}</td>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td class="text-center">Stock actual: <b>{{$pro->stock}}</b> </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">Resumen</td>
                        <td class="text-center text-primary">{{number_format($sumEntradas,2)}}</td>
                        <td class="text-center">{{number_format($sumSalidas,2)}}</td>
                        <td class="text-center">{{$pro->stock}}</td>
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

