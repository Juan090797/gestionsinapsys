<div>
    @push('styles')
    @endpush
    @section('cabezera-contenido')
        <h1>Resumen</h1>
    @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info" wire:click="cliente"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">{{count($clientes)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success" wire:click="producto"><i class="fa fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Productos</span>
                        <span class="info-box-number">{{count($productos)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info" wire:click="proveedor"><i class="fas fa-truck"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Proveedores</span>
                        <span class="info-box-number">{{count($proveedores)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger" wire:click="proyecto"><i class="fa fa-briefcase"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Proyectos</span>
                        <span class="info-box-number">{{count($proyectos)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $chart1->options['name'] }}</h1>
                        {!! $chart1->renderHtml() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $chart2->options['name'] }}</h1>
                        {!! $chart2->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('js')
            {!! $chart1->renderChartJsLibrary() !!}
            {!! $chart1->renderJs() !!}
            {!! $chart2->renderJs() !!}
        @endpush
</div>

