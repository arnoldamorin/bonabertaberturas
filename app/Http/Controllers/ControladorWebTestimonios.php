<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Testimonio;

require app_path() . '/start/constants.php';

class ControladorWebTestimonios extends Controller
{
    public function index()
    {
        $testimonio = new Testimonio();
        $aTestimonios = $testimonio->obtenerTodos();
        $seccion = "Testimonios";
        return view('web.testimonios', compact('seccion','aTestimonios'));
    }

}
