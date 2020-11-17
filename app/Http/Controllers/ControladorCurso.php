<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use App\Entidades\Categoria;
use App\Entidades\Curso;
require app_path() . '/start/constants.php';

class ControladorCurso extends Controller
{
    public function nuevo()
    {
        $entidad = new Categoria();
        $array_categorias = $entidad->obtenerTodos();

        $titulo = "Nuevo Curso";
        return view('curso.curso-nuevo', compact('titulo', 'array_categorias'));

    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad curso
            $titulo = "Modificar Curso";
            $entidad = new Curso();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }
            
                $_POST["id"] = $entidad->idcurso;
                return view('curso.curso-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idcurso;
        $curso = new Curso();
        $curso->obtenerPorId($id);

        $entidad = new Categoria();
        $array_categorias = $entidad->obtenerTodos();

        return view('curso.curso-nuevo', compact('msg', 'curso', 'titulo', 'array_categorias')) . '?id=' . $curso->idcurso;

    }
}

?>