<?php

namespace App\Http\Controllers;

use App\Entidades\Curso;
use Illuminate\Http\Request;
use App\Entidades\Venta;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;


require app_path() . '/start/constants.php';

class ControladorWebCurso extends Controller
{
    public function mercadoPago(){
        $curso = new Curso();
        
        SDK::setClientId(
            config("payment-methods.mercadopago.client")
        );
        SDK::setClientSecret(
            config("payment-methods.mercadopago.secret")
        );
        SDK::setAccessToken("APP_USR-6762967140461719-120122-448806452e0e0b2ca0efc854dd9c8452-166554415
        ");

        $aCursos = $curso->obtenerPorId($id);
        $item = new Item();
        $item->id = $aCursos->idcurso;
        $item->title =  $aCursos->nombre;
        $item->category_id = "services";
        $item->quantity = 1;
        $item->currency_id = "ARS";
        $item->unit_price = $aCursos->precio;

        $preference = new Preference();
        $preference->items = array($item);
        
        $venta = new Venta();
        $aVenta = $venta->obtenerPorId($id);
        if($_REQUEST){
            $payer = new Payer();
            $payer->name = $aVenta->nombre_comprador;
            $payer->surname = $array_usuario[0]->apellido;
            $payer->email = $aVenta->correo_comprador;
            $payer->date_created = date('Y-m-d H:m');
            //$payer->identification = array(
            //    "type" => "CUIT",
            //    "number" => $cliente->cuit
            //);
            $preference->payer = $payer;
        }
    }
    public function index()
    {
        $seccion = "Cursos";
        $curso = new Curso();
        $aCursos = $curso->obtenerTodos();
        return view('web.cursos', compact('seccion', 'aCursos'));
    }

    public function compraCurso() {
        return view('web.compra-curso');
    }

    public function detalleCurso($id) {
        $curso = new Curso();
        $curso->obtenerPorId($id);
        return view('web.detalle-curso', compact('curso'));
    }

    public function subirDatosCompra($id, Request $request){
        $venta = new Venta();
        $venta->fecha = date("Y-m-d");
        $venta->fk_idcurso = $id;
        $venta->estado = 1;
        $venta->nombre_comprador = $request->input("txtNombreComprador");
        $venta->correo_comprador = $request->input("txtCorreoComprador");
        $venta->telefono_comprador = $request->input("txtTelefonoComprador");

        $venta->insertarDatosCompra();
        return view("web.compra-realizada");
    }

}
