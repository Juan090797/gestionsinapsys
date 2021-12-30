<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Dashboard extends Component
{

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
            'contactos' => Contacto::all(),
            'clientes' => Cliente::all(),
            'productos' => Producto::all(),
            'proyectos' => Proyecto::all(),
            'chart1'   => $chart1,
            'chart2'   => $chart2,
            'chart3'   => $chart3,
        ]
        )->extends('layouts.tema.app')->section('content');
    }
}
