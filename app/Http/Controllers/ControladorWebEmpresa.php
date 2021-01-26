<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebEmpresa extends Controller
{
    public function index()
    {
        $seccion = "Empresa";
        return view('web.empresa', compact('seccion'));
    }

}