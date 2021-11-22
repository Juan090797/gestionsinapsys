<?php

namespace App\Http\Controllers;

use App\Imports\ClienteImport;
use App\Imports\ProductosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{

    public function importCliente(Request $request)
    {
        Excel::import(new ClienteImport(), $request->file);
        return back()->withInput();
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
}
