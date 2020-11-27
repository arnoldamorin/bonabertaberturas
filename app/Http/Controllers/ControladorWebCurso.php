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

    public function compraCurso() {
        return view('web.compra-curso');
    }

    public function detalleCurso($id) {
        $curso = new Curso();
        $curso->obtenerPorId($id);
        return view('web.detalle-curso', compact('curso'));
    }

    public function subirDatosCompra($request){
        
    }

}
