<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebSesionPersonal extends Controller
{
    public function index()
    {
        $seccion = "Sesion Personal";
        return view('web.sesion-personal', compact('seccion'));
    }

}
