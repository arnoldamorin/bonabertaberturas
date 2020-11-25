<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
    {
        return view('web.contacto');
    }

}
