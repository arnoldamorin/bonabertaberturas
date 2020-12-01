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
        SDK::setAccessToken("$mercadoPago->token_acceso");
        
        $aCursos = $curso->obtenerPorId();
        $item = new Item();
        $item->id = $aCursos->idcurso;
        $item->title =  $aCursos->nombre;
        $item->category_id = "services";
        $item->quantity = 1;
        $item->currency_id = "ARS";
        $item->unit_price = $aCursos->precio;
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
    public function compraRealizada() {
        return view('web.compra-realizada');
    }
    public function compraPendiente() {
        return view('web.compra-pendiente');
    }
    public function compraError() {
        return view('web.compra-error');
    }



}
