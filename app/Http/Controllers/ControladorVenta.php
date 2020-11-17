<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorVenta extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva Venta";
        return view('venta.venta-nuevo', compact('titulo'));

    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar ventas";
            $entidad = new Ventas();
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
            
                $_POST["id"] = $entidad->idmenu;
                return view('sistema.menu-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idmenu;
        $menu = new Ventas();
        $menu->obtenerPorId($id);

        $entidad = new Ventas();
        $array_menu = $entidad->obtenerMenuPadre($id);

        return view('sistema.menu-nuevo', compact('msg', 'menu', 'titulo', 'array_menu')) . '?id=' . $menu->idmenu;

    }
}

?>