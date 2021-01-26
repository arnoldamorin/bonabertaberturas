<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebProductosss extends Controller
{
    public function index()
    {
        $seccion = "Productos";
        return view('web.productos', compact('seccion'));
    }

}
