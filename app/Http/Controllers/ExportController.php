<?php

namespace App\Http\Controllers;

use App\Exports\ClienteExport;
use App\Exports\ProductosExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportCliente()
    {
        $reportName = 'Clientes_' . uniqid() . '.xlsx';
        return Excel::download(new ClienteExport, $reportName);
    }

    public function exportProducto()
    {
        $reportName = 'Productos_' . uniqid() . '.xlsx';
        return Excel::download(new ProductosExport, $reportName);
    }
}
