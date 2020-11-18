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

    public function index()
        {
            $titulo = "Cursos";
            if (Usuario::autenticado() == true) {
                /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {*/
                    return view('curso.curso-listar', compact('titulo'));
                //}
            } else {
                return redirect('admin/login');
            }
        }

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

    public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadCurso = new Curso();
            $aCursos = $entidadCurso->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aCursos) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aCursos) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aCursos[$i]->nombre;
                $row[] = $aCursos[$i]->descripcion;
                $row[] = $aCursos[$i]->precio;
                $row[] = $aCursos[$i]->cupo;
                $row[] = $aCursos[$i]->horario;
                $row[] = $aCursos[$i]->categoria;
                $row[] = "<a href='/admin/curso/nuevo/".$aCursos[$i]->idcurso."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aCursos), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aCursos), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }
}

?>