<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebCurso extends Controller
{
    public function index()
    {
        $seccion = "Cursos";
        return view('web.cursos', compact('seccion'));
    }

}
