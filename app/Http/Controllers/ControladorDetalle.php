<?php

    namespace App\Http\Controllers;

    use App\Entidades\Detalle;
    use App\Entidades\Producto;
    use App\Entidades\Venta;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorDetalle extends Controller
    {
        public function index()
        {
            $titulo = "Detalle";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('detalle.detalle-listar', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidaddetalle = new detalle();
            $adetalle = $entidaddetalle->obtenerFiltrado();

    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($adetalle) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($adetalle) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = '<a href="/admin/detalle/nuevo/' . $adetalle[$i]->iddetalle . '">' . $adetalle[$i]->fk_idventa . '</a>';
                $row[] = $adetalle[$i]->fk_idtipo_producto;                     
                $row[] = $adetalle[$i]->fk_idproducto;                     
                $row[] = $adetalle[$i]->cantidad;                     
                $row[] = $adetalle[$i]->total; 
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($adetalle), //cantidad total de registros sin paginar
                "recordsFiltered" => count($adetalle), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }
       
        public function nuevo(){
            $titulo = "Nuevo Detalle";
            if(Usuario::autenticado() == true){
                if (!Patente::autorizarOperacion("DETALLEALTA")) {
                    $codigo = "DETALLEALTA";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    
                    return view('detalle.detalle-nuevo', compact('titulo'));
                }
            } else {
               return redirect('admin/login');
            }           
        }

        public function editar($id)
        {
            $titulo = "Modificar Detalle";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("DETALLEEDITAR")) {
                    $codigo = "DETALLEEDITAR";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $detalle = new detalle();
                    $detalle->obtenerPorId($id);                   
    
                    return view('detalle.detalle-nuevo', compact('detalle', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Detalle";
                $detalle = new detalle();
                
                $detalle->cargarDesdeRequest($request);
    
                //validaciones
                if ($detalle->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $detalle->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo
                        $titulo = "Nuevo Detalle";
                        $detalle->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $detalle->iddetalle;
                    return view('venta.venta-nuevo', compact('titulo', 'msg',''));
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
                if (Patente::autorizarOperacion("DETALLEBAJA")) {
                    
                    $detalle = new detalle();
                    $detalle->cargarDesdeRequest($request);
                                                          
                    $detalle->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente                         
                } else {
                    //$codigo = "ELIMINARdetalle"; no se porque no se usa
                    $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }        
    }

?>