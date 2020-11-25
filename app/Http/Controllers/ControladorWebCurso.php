<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebCurso extends Controller
{
    public function index()
    {
        return view('web.cursos');
    }

}
