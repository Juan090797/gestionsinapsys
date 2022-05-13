<div>
    @section('cabezera-contenido')
        <a href="{{route('purchases')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Crear costeo</h1>
    @endsection
    <div class="content-fluid">
        <form wire:submit.prevent="crearCosteo">
            <div class="card p-3 mb-3" wire:ignore.self>
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tipo_costeo">Tipo costeo</label>
                                <select id="tipo_costeo" class="form-control" wire:model.defer="state.tipo_costeo" onChange="mostrar(this.value);">
                                    <option value="">Seleccionar costeo</option>
                                    <option value="MARITIMO">MARITIMO</option>
                                    <option value="AEREO">AEREO</option>
                                </select>
                            </div>
                            @error('tipo_costeo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="maritimo" class="row" style="display: none;">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="producto_id">Productos</label>
                                <select id="producto_id" class="form-control" wire:model.defer="state.producto_id">
                                    <option value="">Seleccionar producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('producto_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Invoice</label>
                                <input type="number" class="form-control" wire:model.defer="state.invoice">
                            </div>
                            @error('invoice') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="date">Peso</label>
                                <input class="form-control" type="number" wire:model.defer="state.peso">
                            </div>
                            @error('peso') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="date">Nº BL</label>
                                <input class="form-control" type="number" wire:model.defer="state.num_bl">
                            </div>
                            @error('num_bl') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <select class="form-control" wire:model.defer="state.proveedor_id">
                                    <option value="">Seleccionar proveedor</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Origen</label>
                                <input type="text" class="form-control" wire:model.defer="state.origen">
                            </div>
                            @error('origen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Linea Naviera</label>
                                <input type="text" class="form-control" wire:model.defer="state.linea_naviera">
                            </div>
                            @error('linea_naviera') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Buque Salida</label>
                                <input type="text" class="form-control" wire:model.defer="state.buque_salida">
                            </div>
                            @error('buque_salida') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Buque Llegada</label>
                                <input type="text" class="form-control" wire:model.defer="state.buque_llegada">
                            </div>
                            @error('buque_llegada') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4 mt-5">
                            <div class="custom-control custom-switch">
                                <input wire:model.defer="state.express" type="checkbox" class="custom-control-input" id="sidebarCollapse1">
                                <label class="custom-control-label" for="sidebarCollapse1">Express</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Contenedores</label>
                                <input type="number" class="form-control" wire:model.defer="state.contenedores">
                            </div>
                            @error('contenedores') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Viaje</label>
                                <input type="number" class="form-control" wire:model.defer="state.viaje">
                            </div>
                            @error('viaje') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Bultos</label>
                                <input type="number" class="form-control" wire:model.defer="state.bultos">
                            </div>
                            @error('bultos') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Volumen</label>
                                <input type="number" class="form-control" wire:model.defer="state.volumen">
                            </div>
                            @error('volumen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Consignatario</label>
                                <input type="text" class="form-control" wire:model.defer="state.consignatario">
                            </div>
                            @error('consignatario') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Consolidacion</label>
                                <input type="date" class="form-control" wire:model.defer="state.consolidacion">
                            </div>
                            @error('consolidacion') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Salida</label>
                                <input type="date" class="form-control" wire:model.defer="state.salida">
                            </div>
                            @error('salida') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Almacen</label>
                                <input type="text" class="form-control" wire:model.defer="state.almacen">
                            </div>
                            @error('almacen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>VºBº</label>
                                <input type="text" class="form-control" wire:model.defer="state.vb">
                            </div>
                            @error('vb') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Operador portuario</label>
                                <input type="text" class="form-control" wire:model.defer="state.operador_portuario">
                            </div>
                            @error('operador_portuario') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Agente</label>
                                <input type="text" class="form-control" wire:model.defer="state.agente">
                            </div>
                            @error('agente') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>MBL</label>
                                <input type="number" class="form-control" wire:model.defer="state.mbl">
                            </div>
                            @error('mbl') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Mamifiesto</label>
                                <input type="number" class="form-control" wire:model.defer="state.manifiesto">
                            </div>
                            @error('manifiesto') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div id="aereo" class="row" style="display: none;">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="producto_id">Productos</label>
                                <select id="producto_id" class="form-control" wire:model.defer="state.producto_id">
                                    <option value="">Seleccionar proveedor</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Invoice</label>
                                <input type="number" class="form-control" wire:model.defer="state.invoice">
                            </div>
                            @error('invoice') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Peso</label>
                                <input type="number" class="form-control" wire:model.defer="state.peso">
                            </div>
                            @error('peso') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>N° AWB</label>
                                <input type="number" class="form-control" wire:model.defer="state.num_awb">
                            </div>
                            @error('num_awb') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <select class="form-control" wire:model.defer="state.proveedor_id">
                                    <option value="">Seleccionar proveedor</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('proveedor_id') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Origen</label>
                                <input type="text" class="form-control" wire:model.defer="state.origen">
                            </div>
                            @error('origen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Aerolinea</label>
                                <input type="text" class="form-control" wire:model.defer="state.aerolinea">
                            </div>
                            @error('aerolinea') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>ETA</label>
                                <input type="date" class="form-control" wire:model.defer="state.eta">
                            </div>
                            @error('eta') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Guia madre</label>
                                <input type="number" class="form-control" wire:model.defer="state.guia_madre">
                            </div>
                            @error('guia_madre') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4 mt-5">
                            <div class="custom-control custom-switch">
                                <input wire:model.defer="state.express" type="checkbox" class="custom-control-input" id="sidebarCollapse2">
                                <label class="custom-control-label" for="sidebarCollapse2">Express</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>N° Bultos</label>
                                <input type="number" class="form-control" wire:model.defer="state.bultos">
                            </div>
                            @error('bultos') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Volumen</label>
                                <input type="number" class="form-control" wire:model.defer="state.volumen">
                            </div>
                            @error('volumen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Consignatario</label>
                                <input type="text" class="form-control" wire:model.defer="state.consignatario">
                            </div>
                            @error('consignatario') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Consolidacion</label>
                                <input type="date" class="form-control" wire:model.defer="state.consolidacion">
                            </div>
                            @error('consolidacion') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Salida</label>
                                <input type="date" class="form-control" wire:model.defer="state.salida">
                            </div>
                            @error('salida') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Almacen</label>
                                <input type="text" class="form-control" wire:model.defer="state.almacen">
                            </div>
                            @error('almacen') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Operador aeroportuario</label>
                                <input type="text" class="form-control" wire:model.defer="state.operador_aeroportuario">
                            </div>
                            @error('operador_aeroportuario') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Otro</label>
                                <input type="number" class="form-control" wire:model.defer="state.otro">
                            </div>
                            @error('otro') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Agente</label>
                                <input type="text" class="form-control" wire:model.defer="state.agente">
                            </div>
                            @error('agente') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fa fa-save mr-1"></i> Guardar
                            </button>
                            <a href="#">
                                <button type="button" class="btn btn-light border border-secondary float-right mr-1">
                                    <i class="fa fa-times mr-1"></i> Cancelar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            $('#sidebarCollapse1').on('change', function() {
                $('body').toggleClass('sidebar-collapse1');
            })
            $('#sidebarCollapse2').on('change', function() {
                $('body').toggleClass('sidebar-collapse2');
            })
        });
        function mostrar(id) {
            if (id == "MARITIMO") {
                $("#maritimo").show();
                $("#aereo").hide();
            }
            if (id == "AEREO") {
                $("#aereo").show();
                $("#maritimo").hide();
            }
        }
    </script>
</div>
