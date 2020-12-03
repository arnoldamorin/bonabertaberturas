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
            $aVenta = $entidadVenta->obtenerTodos();

            $entidadCurso = new Curso();
            $entidadEstado = new Venta_estado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aVenta) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aVenta) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $fecha_formateada = date("d/m/Y H:i", strtotime($aVenta[$i]->fecha));
                $row[] = $fecha_formateada;
                $entidadCurso->obtenerPorId($aVenta[$i]->fk_idcurso);
                $row[] = $entidadCurso->nombre;
                $row[] = $aVenta[$i]->telefono;
                $row[] = $aVenta[$i]->correo;
                $row[] = $aVenta[$i]->nombre_comprador;
                $row[] = $aVenta[$i]->apellido_comprador;
                $entidadEstado->obtenerPorID($aVenta[$i]->fk_idestado);
                $row[] = $entidadEstado->nombre;
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

            $venta_estado = new Venta_estado();
            $array_estado = $venta_estado->obtenerTodos();

            $titulo = "Nueva Venta";
            return view('venta.venta-nuevo', compact('titulo', 'array_curso', 'array_estado'));
        }

        public function editar($id)
        {
            $entidad = new Curso();
            $array_curso = $entidad->obtenerTodos();
            
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
    
                    return view('venta.venta-nuevo', compact('venta', 'titulo', 'array_curso', 'array_estado'));
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
                $entidadAnt = new Venta();
                $entidadAnt = $entidadAnt->obtenerPorId($entidad->idinscripcion);
            
                //validaciones
                if ($entidad->fecha == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion

                        if (($entidadAnt->fk_idestado == 1) && ($entidad->fk_idestado == 2)) {
                            $alumno = new Alumno();
                            $alumno = $alumno->obtenerPorCorreo($entidad->correo);
                            if (isset($alumno) && ($alumno->idalumno != "")) {
                                $alumno->nombre = $entidad->nombre_comprador;
                                $alumno->apellido = $entidad->apellido_comprador;
                                $alumno->telefono = $entidad->telefono;
                                $alumno->guardar();
                            } else {
                                $alumno = new Alumno();
                                $alumno->nombre = $entidad->nombre_comprador;
                                $alumno->apellido = $entidad->apellido_comprador;
                                $alumno->dni = "";
                                $alumno->mail = $entidad->correo;
                                $alumno->telefono = $entidad->telefono;
                                $alumno->insertar();
                            }
                            
                        }

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
                    return view('venta.venta-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
            $id = $entidad->idinscripcion;
            $venta = new Venta();
            $venta->obtenerPorId($id);
    
            return view('venta.venta-nuevo', compact('msg', 'venta', 'fecha', 'array_curso', 'array_estado')) . '?id=' . $venta->idinscripcion;
        }

public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("INSCRIPCIONBAJA")) {
                    $entidad = new Venta();
                    $entidad->cargarDesdeRequest($request);
                   
                    if ($entidad->idinscripcion > 0) {
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