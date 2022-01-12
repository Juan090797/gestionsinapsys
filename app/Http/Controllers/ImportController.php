<?php

namespace App\Http\Controllers;

use App\Imports\ClienteImport;
use App\Imports\ProductosImport;
use App\Imports\ProveedorImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importCliente(Request $request)
    {
        $import = new ClienteImport();
        $import->import($request->file);

        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures());
        }
        return back()->with('message', "La importacion fue satisfactoria");
    }

    public function importProducto(Request $request)
    {
        $import = new ProductosImport();
        $import->import($request->file);

        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures());
        }
        return back()->with('message', "La importacion fue satisfactoria");
    }

    public function importProveedor(Request $request)
    {
        $import = new ProveedorImport();
        $import->import($request->file);

        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures());
        }
        return back()->with('message', "La importacion fue satisfactoria");
    }
}
