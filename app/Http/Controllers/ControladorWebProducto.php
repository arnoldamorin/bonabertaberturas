<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebProducto extends Controller
{
    public function index()
    {
        $seccion = "Producto";
        return view('web.producto', compact('seccion'));
    }

}
