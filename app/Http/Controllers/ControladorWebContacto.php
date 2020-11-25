<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
    {
        $seccion = "Contacto";
        return view('web.contacto', compact('seccion'));
    }

}
