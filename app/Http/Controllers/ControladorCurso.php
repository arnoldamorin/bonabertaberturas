<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorCurso extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Curso";
        return view('curso.curso-nuevo', compact('titulo'));

    }
}

?>