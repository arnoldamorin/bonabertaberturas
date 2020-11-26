<?php

namespace App\Http\Controllers;

use App\Entidades\Curso;

require app_path() . '/start/constants.php';

class ControladorWebCurso extends Controller
{
    public function index()
    {
        $seccion = "Cursos";
        $curso = new Curso();
        $aCursos = $curso->obtenerTodos();
        return view('web.cursos', compact('seccion', 'aCursos'));
    }

}
