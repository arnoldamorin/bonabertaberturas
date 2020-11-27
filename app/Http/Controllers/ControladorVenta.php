<?php

namespace App\Http\Controllers;

use App\Entidades\Venta;
use App\Entidades\Venta_estado;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Alumno;
use App\Entidades\Curso;
use Illuminate\Http\Request;


require app_path() . '/start/constants.php';

class ControladorVenta extends Controller
{
    public function index()
    {
        $titulo = "Nuevo Venta";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("INSCRIPCIONCONSULTA")) {
                $codigo = "INSCRIPCIONCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('venta.venta-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
        {
            $request = $_REQUEST;

            $entidadVenta = new Venta();
            $aVenta = $entidadVenta->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aVenta) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aVenta) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aVenta[$i]->fecha;
                $row[] = $aVenta[$i]->importe;
                $row[] = $aVenta[$i]->fk_idcurso;
                $row[] = $aVenta[$i]->fk_idalumno;
                $row[] = $aVenta[$i]->fk_idestado;
                $row[] = "<a href='/admin/venta/nueva/".$aVenta[$i]->idinscripcion."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aVenta), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aVenta), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $curso = new Curso();
            $array_curso = $curso->obtenerTodos();

            $alumnos = new Alumno();
            $array_alumno = $alumnos->obtenerTodos();

            $venta_estado = new Venta_estado();
            $array_estado = $venta_estado->obtenerTodos();

            $titulo = "Nueva Venta";
            return view('venta.venta-nuevo', compact('titulo', 'array_curso', 'array_alumno', 'array_estado'));
        }

        public function editar($id)
        {
            $entidad = new Curso();
            $array_curso = $entidad->obtenerTodos();
            
            $entidad2 = new Alumnos();
            $array_alumno = $entidad2->obtenerTodos();

            $venta_estado = new Venta_estado();
            $array_estado = $venta_estado->obtenerTodos();

            $titulo = "Modificar Venta";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("INSCRIPCIONMODIFICACION")) {
                    $codigo = "INSCRIPCIONMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $venta = new Venta();
                    $venta->obtenerPorId($id);
    
                    return view('venta.venta-nuevo', compact('venta', 'titulo', 'array_curso', 'array_alumno', 'array_estado'));
                }
            } else {
                return redirect('admin/login');
            }
        }

    public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Venta";
                $entidad = new Venta();
                $entidad->cargarDesdeRequest($request);
    
                //validaciones
                if ($entidad->fecha == "") {
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
                        $titulo = "Nuevo Venta";
                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idinscripcion;
                    return view('venta.venta-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
            $id = $entidad->idinscripcion;
            $venta = new Venta();
            $venta->obtenerPorId($id);
    
            return view('venta.venta-nuevo', compact('msg', 'fecha', 'importe','array_curso', 'array_alumno', 'array_estado')) . '?id=' . $venta->idisncripcion;
        }

public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("INSCRIPCIONBAJA")) {
                    $entidad = new Venta();
                    $entidad->cargarDesdeRequest($request);
                   
                    if ($entidad->nombre != "") {
                        $entidad->eliminar();
                        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                    } else {
                        $aResultado["err"] = MSG_ERROR;
                    }    
                } else {
                    $codigo = "ELIMINARPROFESIONAL";
                    $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }
    }

?>