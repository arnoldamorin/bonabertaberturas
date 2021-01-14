<?php

    namespace App\Http\Controllers;

    use App\Entidades\TipoProducto;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorTipoProducto extends Controller
    {
        public function index()
        {
            $titulo = "Tipo Producto";
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
    
            $entidadTipoProducto = new TipoProducto();
            $aTipoProducto = $entidadTipoProducto->obtenerFiltrado();

    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aTipoProducto) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aTipoProducto) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = '<a href="/admin/productos/tipodeproductos/nuevo/' . $aTipoProducto[$i]->idtipo_producto . '">' . $aTipoProducto[$i]->nombre . '</a>';
                $row[] = $aTipoProducto[$i]->descripcion;                     
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aTipoProducto), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aTipoProducto), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }
       
        public function nuevo(){
            $titulo = "Nuevo Tipo Producto";
            if(Usuario::autenticado() == true){
                if (!Patente::autorizarOperacion("TIPOPRODUCTOALTA")) {
                    $codigo = "TIPOPRODUCTOALTA";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('tipoproducto.tipo-producto-nuevo', compact('titulo'));
                }
            } else {
               return redirect('admin/login');
            }           
        }

        public function editar($id)
        {
            $titulo = "Modificar Tipo Producto";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("TIPOPRODUCTOEDITAR")) {
                    $codigo = "TIPOPRODUCTOEDITAR";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $tipodeproducto = new TipoProducto();
                    $tipodeproducto->obtenerPorId($id);
    
                    return view('tipoproducto.tipo-producto-nuevo', compact('tipodeproducto', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Tipo Producto";
                $tipoproducto = new TipoProducto();
                
                $tipoproducto->cargarDesdeRequest($request);
    
                //validaciones
                if ($tipoproducto->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $tipoproducto->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo
                        $titulo = "Nuevo Tipo Producto";
                        $tipoproducto->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $tipoproducto->idtipo_producto;
                    return view('tipoproducto.tipo-producto-nuevo', compact('titulo', 'msg'));
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
                if (Patente::autorizarOperacion("TIPOPRODUCTOBAJA")) {
                    
                    $tipoproducto = new TipoProducto();
                    $tipoproducto->cargarDesdeRequest($request);
                                                          
                    $tipoproducto->eliminar();
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