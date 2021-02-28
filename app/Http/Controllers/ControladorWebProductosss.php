<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Producto;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorWebProductosss extends Controller
{
    public function index()
    {
        $seccion = "Productos";
        $producto = new Producto();
        $aMedidas = $producto->obtenerMedidasProductos();
        $precioMax = $producto->obtenerPrecioMaximo();
        $precioMin = $producto->obtenerPrecioMinimo();
        return view('web.productos', compact('seccion', 'aMedidas', 'precioMin', 'precioMax'));
    }

    public function obtenerProductos(Request $request) {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();
        if (count($aProductos) > 0) {
            $json_data =  array(
                "error" => 0,
                "productos" => $aProductos
            );
        } else {
            $json_data =  array(
                "error" => 1
            );
        }
        return json_encode($json_data);
    }

    public function setFiltroProductos(Request $request) {
        $aFiltros = $request->input("filtro");
        $precioMin = $request->input("precioMin");
        $precioMax = $request->input("precioMax");
        $producto = new Producto();

        if ($aFiltros != "") {
            $string = "(";
            for ($i = 0; $i < count($aFiltros); $i++) {
                $string .= "'" . $aFiltros[$i]["filtro"] . "',";
            }
            $string = substr($string, 0, -1).")";
        } else {
            $string = "";
        }

        $aProductos = array();
        $aProductos = $producto->obtenerPorFiltro($string, $precioMin, $precioMax);

        if (count($aProductos) > 0) {
            $json_data =  array(
                "error" => 0,
                "productos" => $aProductos
            );
        } else {
            $json_data =  array(
                "error" => 1
            );
        }
        return json_encode($json_data);
    }

}
