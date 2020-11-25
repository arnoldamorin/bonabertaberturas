<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebConferencias extends Controller
{
    public function index()
    {
        $seccion = "Conferencias";
        return view('web.conferencias', compact('seccion'));
    }

}
