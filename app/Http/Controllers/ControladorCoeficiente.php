<?php

    namespace App\Http\Controllers;

    use App\Entidades\Coeficiente;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorCoeficiente extends Controller
    {
        public function index()
        {
            $titulo = "Coeficiente";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('tipoproducto.tipo-producto-listar', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadCoeficiente = new Coeficiente();
            $aCoeficiente = $entidadCoeficiente ->obtenerFiltrado();

    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aCoeficiente) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aCoeficiente) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = '<a href="/admin/productos/tipodeproductos/nuevo/' . $aCoeficiente[$i]->idcoeficiente . '">' . $aCoeficiente[$i]->nombre . '</a>';
                $row[] = $aCoeficiente[$i]->valor;                     
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aCoeficiente), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aCoeficiente), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }
       
        public function nuevo(){
            $titulo = "Nuevo Coeficiente";
            if(Usuario::autenticado() == true){
                if (!Patente::autorizarOperacion("COEFICIENTEALTA")) {
                    $codigo = "COEFICIENTEALTA";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('coeficiente.coeficiente-nuevo', compact('titulo'));
                }
            } else {
               return redirect('admin/login');
            }           
        }

        public function editar($id)
        {
            $titulo = "Modificar Coeficiente";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("COEFICIENTEEDITAR")) {
                    $codigo = "COEFICIENTEEDITAR";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $coeficiente = new Coeficiente();
                    $coeficiente->obtenerPorId($id);
    
                    return view('coeficiente.coeficiente-nuevo', compact('coeficiente', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Coeficiente";
                $coeficiente = new Coeficiente();
                
                $coeficiente->cargarDesdeRequest($request);
    
                //validaciones
                if ($coeficiente->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $coeficiente->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo
                        $titulo = "Nuevo Coeficiente";
                        $coeficiente->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $coeficiente->idcoeficiente;
                    return view('coeficiente.coeficiente-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
        }

        public function eliminar(Request $request)
        {
            $id = $request->input('id');            
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("COEFICIENTEBAJA")) {
                    
                    $coeficiente = new Coeficiente();
                    $coeficiente->cargarDesdeRequest($request);
                                                          
                    $coeficiente->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente                         
                } else {
                    //$codigo = "ELIMINARTIPOPRODUCTO"; no se porque no se usa
                    $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }        
    }

?>