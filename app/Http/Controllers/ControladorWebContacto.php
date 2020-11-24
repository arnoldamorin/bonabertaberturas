<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebHome extends Controller
{
    public function contacto()
    {
        return view('web.contacto');
    }

}
