<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebCoachingEmpresarial extends Controller
{
    public function index()
    {
        $seccion = "";        
        return view('web.empresarial', compact('seccion'));
    }

}
