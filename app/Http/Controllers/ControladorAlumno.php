<?php

    namespace App\Http\Controllers;

    use App\Entidades\Sistema\Patente;
    use App\Entidades\Sistema\Usuario;
    use Illuminate\Http\Request;

    require app_path() . '/start/constants.php';

    class ControladorAlumno extends Controller
    {
        public function nuevo()
        {
            $titulo = "Nuevo Alumno";
            return view('alumno.alumno-nuevo', compact('titulo'));
        }
    }

?>