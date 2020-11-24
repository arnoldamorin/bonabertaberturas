<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebTestimonios extends Controller
{
    public function index()
    {
        return view('web.testimonios');
    }

}
