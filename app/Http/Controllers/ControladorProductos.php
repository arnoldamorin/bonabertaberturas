<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use App\Entidades\TipoProducto;
use App\Entidades\Producto;
require app_path() . '/start/constants.php';

class ControladorProductos extends Controller
{

    public function index()
        {
            $titulo = "Productos";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PRODUCTOSCONSULTA")) {
                    $codigo = "PRODUCTOSCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('producto.producto-listar', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

    public function nuevo()
    {
        $entidad = new TipoProducto();
        $array_TipoProductos = $entidad->obtenerTodos();

        $titulo = "Nuevo Producto";

        if(Usuario::autenticado() == true){
            if(!Patente::autorizarOperacion("PRODUCTOSALTA")){
                $codigo = "PRODUCTOSALTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else{
                return view('producto.producto-nuevo', compact('titulo', 'array_TipoProductos'));

            }
        } else{
            return redirect("admin/login");
        }


    }

    public function guardar(Request $request)
    {
        try {

            //Define la entidad producto
            $titulo = "Modificar Producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);

            $idproducto=$_REQUEST['id'];
            if($_FILES["imagenProducto"]["error"] === UPLOAD_ERR_OK)
            {
                $nombre = date("Ymdhmsi") . ".jpg"; 
                $archivo = $_FILES["imagenProducto"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/web/img/puertas/$nombre");//guardaelarchivo
                $entidad->imagen =$nombre;
            }

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PRODUCTOSEDITAR")) {
                    $codigo = "PRODUCTOSEDITAR";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    if ($entidad->descripcion == "") {
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = "Complete todos los datos";
                    } else {
                        if ($_POST["id"] > 0) {
                            $ProductoAnt = new Producto();
                            $ProductoAnt->obtenerPorId($entidad->idproducto);
                       
                            if(isset($_FILES["imagenProducto"]) && $_FILES["imagenProducto"]["name"] != ""){
                                $archivoAnterior =$_FILES["imagenProducto"]["name"];
                                if($archivoAnterior !=""){
                                    @unlink (env('APP_PATH') . "/public/web/img/puertas/$archivoAnterior");
                                }
                            } else {
                                $entidad->imagen = $ProductoAnt->imagen;
                            }
            
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
                    
                        $_POST["id"] = $entidad->idproducto;
                        return view('producto.producto-listar', compact('titulo', 'msg'));
                    }
                }
            } else {
                return redirect('admin/login');
            }

            //validaciones
            
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idproducto;
        $producto = new Producto();
        $producto->obtenerPorId($id);

        $entidad = new TipoProducto(); 
        $array_TipoProductos = $entidad->obtenerTodos();

        return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo', 'array_TipoProductos')) . '?id=' . $producto->idproducto;

    }

    public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("PRODUCTOSBAJA")) {
                    $entidad = new Producto();
                    $entidad->cargarDesdeRequest($request);

                    if ($entidad->idproducto > 0) {
                        $entidad->eliminar();
                        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                    } else {
                        $aResultado["err"] = MSG_ERROR;
                    }
    
                } else {
                    $codigo = "PRODUCTOSBAJA";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('codigo', 'mensaje'));
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }

    public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadproducto = new Producto();
            $aProductos = $entidadproducto->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aProductos) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                
                $row[] = "<img class='img-thumbnail' style='height: 70px' src='/img/puertas/".$aProductos[$i]->imagen."'>";               
                $row[] = $aProductos[$i]->codigo;               
                $row[] = $aProductos[$i]->descripcion;                
                $row[] = $aProductos[$i]->medidas_externas;
                $row[] = $aProductos[$i]->medidas_internas;
                $row[] = $aProductos[$i]->peso;
                $row[] = "$" . number_format($aProductos[$i]->precio_costo, 2, ",", ".");
                $row[] = "$" . number_format($aProductos[$i]->precio_venta, 2, ",", ".");               
                $row[] = $aProductos[$i]->marca;               
                $row[] = "<a href='/admin/productos/nuevo/".$aProductos[$i]->idproducto."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function editar($id)
        {
            $entidad = new TipoProducto();
            $array_TipoProductos = $entidad->obtenerTodos();
        
            $titulo = "Modificar producto";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PRODUCTOSEDITAR")) {
                    $codigo = "PRODUCTOSEDITAR";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $producto = new Producto();
                    $producto->obtenerPorId($id);
    
                    return view('producto.producto-nuevo', compact('producto', 'titulo', 'array_TipoProductos'));
                }
            } else {
                return redirect('admin/login');
            }
        }
}

?>