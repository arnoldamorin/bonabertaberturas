<?php

namespace App\Http\Controllers;

use App\Entidades\Testimonio;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Menu;

require app_path() . '/start/constants.php';

class ControladorTestimonio extends Controller
{
    public function index()
    {
        $titulo = "Testimonio";
        if (Usuario::autenticado() == true) {
            /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {*/
                return view('testimonio.testimonio-listado', compact('titulo'));
            //}
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadTestimonio = new Testimonio();
            $aTestimonios = $entidadTestimonio->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aTestimonios) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aTestimonios) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aTestimonios[$i]->nombre;
                $row[] = $aTestimonios[$i]->descripcion;
                $row[] = $aTestimonios[$i]->video;
                $row[] = "<a href='/admin/testimonio/nuevo/".$aTestimonios[$i]->idTestimonio."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aTestimonios), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aTestimonios), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }


    public function nuevo()
    {
        $titulo = "Nuevo Testimonio";
        return view('testimonio.testimonio-nuevo', compact('titulo'));

    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar testimonio";
            $entidad = new Testimonio();
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
            
                $_POST["id"] = $entidad->idtestimonio;
                return view('testimonio.testimonio-listado', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idtestimonio;
        $testimonio = new Testimonio();
        $testimonio->obtenerPorId($id);

        return view('testimonio.testimonio-nuevo', compact('msg', 'testimonio', 'titulo')) . '?id=' . $testimonio->idtestimonio;

    }
}

?>
