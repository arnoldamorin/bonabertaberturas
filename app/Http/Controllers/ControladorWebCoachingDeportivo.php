<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebCoachingDeportivo extends Controller
{
    public function index()
    {
        $seccion = "";        
        return view('web.deportivo', compact('seccion'));
    }

}