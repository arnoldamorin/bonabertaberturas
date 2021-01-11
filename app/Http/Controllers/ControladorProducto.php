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
                if (!Patente::autorizarOperacion("CURSOSCONSULTA")) {
                    $codigo = "CURSOSCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('curso.curso-listar', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

    public function nuevo()
    {
        $entidad = new Categoria();
        $array_categorias = $entidad->obtenerTodos();

        $titulo = "Nuevo Producto";

        if(Usuario::autenticado() == true){
            if(!Patente::autorizarOperacion("CURSOSALTA")){
                $codigo = "CURSOSALTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else{
                return view('curso.curso-nuevo', compact('titulo', 'array_categorias'));

            }
        } else{
            return redirect("admin/login");
        }


    }

    public function guardar(Request $request)
    {
        try {

            //Define la entidad curso
            $titulo = "Modificar Producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);

            $idproducto=$_REQUEST['id'];
            if($_FILES["imagenProducto"]["error"] === UPLOAD_ERR_OK)
            {
                $nombre = date("Ymdhmsi") . ".jpg"; 
                $archivo = $_FILES["imagenProducto"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/web/img/$nombre");//guardaelarchivo
                $entidad->imagen =$nombre;
            }

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PRODUCTOSMODIFICACION")) {
                    $codigo = "PRODUCTOSMODIFICACION";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    if ($entidad->nombre == "") {
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = "Complete todos los datos";
                    } else {
                        if ($_POST["id"] > 0) {
                            $ProductoAnt = new Producto();
                            $ProductoAnt->obtenerPorId($entidad->idcurso);
                       
                            if(isset($_FILES["imagenProducto"]) && $_FILES["imagenProducto"]["name"] != ""){
                                $archivoAnterior =$_FILES["imagenProducto"]["name"];
                                if($archivoAnterior !=""){
                                    @unlink (env('APP_PATH') . "/public/web/img/$archivoAnterior");
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
                    
                        $_POST["id"] = $entidad->idcurso;
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

        $entidad = new Categoria(); //cambiar por tipo producto
        $array_categorias = $entidad->obtenerTodos();

        return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo', 'array_categorias')) . '?id=' . $producto->idproducto;

    }

    public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("CURSOSELIMINAR")) {
                    $entidad = new Curso();
                    $entidad->cargarDesdeRequest($request);

                    if ($entidad->idcurso > 0) {
                        $entidad->eliminar();
                        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                    } else {
                        $aResultado["err"] = MSG_ERROR;
                    }
    
                } else {
                    $codigo = "CURSOSELIMINAR";
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
                //$row[] = $aCursos[$i]->categoria;
                $row[] = "$" . number_format($aCursos[$i]->precio, 2, ",", ".");
                $row[] = $aCursos[$i]->cupo;
                $row[] = $aCursos[$i]->horario;
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

        public function editar($id)
        {
            $entidad = new Categoria();
            $array_categorias = $entidad->obtenerTodos();
        
            $titulo = "Modificar producto";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PRODUCTOSMODIFICACION")) {
                    $codigo = "CURSOSMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $producto = new Producto();
                    $producto->obtenerPorId($id);
    
                    return view('producto.producto-nuevo', compact('producto', 'titulo', 'array_categorias'));
                }
            } else {
                return redirect('admin/login');
            }
        }
}

?>