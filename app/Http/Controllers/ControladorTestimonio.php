<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Testimonio;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Menu;
use App\Entidades\Sistema\MenuArea;

require app_path() . '/start/constants.php';

class ControladorTestimonio extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Testimonio";
        $entidad = new Menu();
        $array_menu = $entidad->obtenerMenuPadre();
        return view('testimonio.testimonio-nuevo', compact('titulo','array_menu'));

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
                return view('sistema.testimonio-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idtestimonio;
        $testimonio = new Testimonio();
        $testimonio->obtenerPorId($id);

        return view('sistema.testimonio-nuevo', compact('msg', 'testimonio', 'titulo')) . '?id=' . $testimonio->idtestimonio;

    }
}

?>
