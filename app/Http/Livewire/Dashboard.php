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
        $chart_options = [
            'chart_title' => 'Ingresos de ventas por dia',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pedido',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '158, 190, 187',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',
            'date_format' => 'd-m-Y',
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Proyectos por mes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Proyecto',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '255, 51, 0',
            'date_format' => 'm-Y',
        ];
        $chart2 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Compras por mes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Compra',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '0, 126, 255',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',
            'date_format' => 'm-Y',
        ];
        $chart3 = new LaravelChart($chart_options);

        return view('livewire.dashboard',
        [
            'chart1'   => $chart1,
            'chart2'   => $chart2,
            'chart3'   => $chart3,
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
