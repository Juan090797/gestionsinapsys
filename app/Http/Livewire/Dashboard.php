<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Proyecto;
use Livewire\Component;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Dashboard extends Component
{
    public $clientes,$productos,$proveedores,$proyectos;

    public function proveedor()
    {
        return redirect()->to('proveedores');
    }
    public function cliente()
    {
        return redirect()->to('clientes');
    }
    public function producto()
    {
        return redirect()->to('productos');
    }
    public function proyecto()
    {
        return redirect()->to('proyectos');
    }
    public function render()
    {
        $this->update();
        $settings1 = [
            'chart_title' => 'Ventas',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pedido',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'aggregate_function' => 'sum',
            'aggregate_field'  => 'total',
            'continuous_time' => true,
            'chart_color' => '204, 241, 237',
            'date_format' =>'d-m-Y',

        ];
        $settings2 = [
            'chart_title'           => 'Compras',
            'name'                  => 'Ventas - Compras',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Compra',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'total',
            'chart_color'           => '255, 28, 86',
        ];
        $chart1 = new LaravelChart($settings1,$settings2);

        $chart_options = [
            'chart_title' => 'Gastos',
            'chart_type' => 'pie',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\MovimientoAlmacen',
            'name' => 'Gastos '.now()->format('Y'),
            'relationship_name' => 'costos', // represents function user() on Transaction model
            'group_by_field' => 'nombre', // users.name

            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',
        ];

        $chart2 = new LaravelChart($chart_options);

        return view('livewire.dashboard',
        [
            'chart1'   => $chart1,
            'chart2'   => $chart2,
        ]
        )->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->clientes();
        $this->productos();
        $this->proyectos();
        $this->proveedores();
    }

    public function clientes()
    {
        $this->clientes = Cliente::all();
    }
    public function productos()
    {
        $this->productos = Producto::all();
    }
    public function proyectos()
    {
        $this->proyectos = Proyecto::all();
    }
    public function proveedores()
    {
        $this->proveedores = Proveedor::all();
    }
}
