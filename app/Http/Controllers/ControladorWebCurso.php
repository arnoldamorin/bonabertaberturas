<?php

namespace App\Http\Controllers;

use App\Entidades\Curso;
use Illuminate\Http\Request;
use App\Entidades\Venta;



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

    public function subirDatosCompra($id, Request $request){
        $venta = new Venta();
        $venta->nombreComprador = $request->input("txtNombreComprador");
        $venta->correoComprador = $request->input("txtCorreoComprador");
        $venta->telefonoComprador = $request->input("txtTelefonoComprador");

        print_r($venta->nombreComprador);
        print_r($venta->telefonoComprador);
        print_r($venta->correoComprador);
        exit;
    }

}
