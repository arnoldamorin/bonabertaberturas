<?php

namespace App\Http\Controllers;

use App\Entidades\Curso;
use App\Entidades\Venta;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;

require app_path() . '/start/constants.php';

class ControladorWebCurso extends Controller
{
    public function comprar($idCurso, Request $request)
    {
        $curso = new Curso();

        SDK::setClientId(
            config("payment-methods.mercadopago.client")
        );
        SDK::setClientSecret(
            config("payment-methods.mercadopago.secret")
        );
        SDK::setAccessToken("APP_USR-6762967140461719-120122-448806452e0e0b2ca0efc854dd9c8452-166554415
        ");

        $curso->obtenerPorId($idCurso);

        $item = new Item();
        $item->id = $curso->idcurso;
        $item->title = $curso->nombre;
        $item->category_id = "services";
        $item->quantity = 1;
        $item->currency_id = "ARS";
        $item->unit_price = $curso->precio;

        $preference = new Preference();
        $preference->items = array($item);

        $payer = new Payer();
        $payer->name = $request->input("txtNombreComprador");
        $payer->surname = $request->input("txtApellidoComprador");
        $payer->email = $request->input("txtCorreoComprador");
        $payer->date_created = date('Y-m-d H:m');
        //$payer->identification = array(
        //    "type" => "CUIT",
        //    "number" => $cliente->cuit
        //);
        $preference->payer = $payer;

        $venta = new Venta();
        $venta->fecha = date('Y-m-d H:m');
        $venta->fk_idcurso = $idCurso;
        $venta->telefono = $request->input("txtTelefonoComprador");
        $venta->correo = $request->input("txtCorreoComprador");
        $venta->nombre_comprador = $request->input("txtNombreComprador");
        $venta->apellido_comprador = $request->input("txtApellidoComprador");
        $venta->fk_idestado = VENTA_PENDIENTE;
        $idVenta = $venta->insertar();

        $preference->back_urls = [
<<<<<<< HEAD
            "success" => "https://emilcecharras.com.ar/cursos/compra-realizada",
            "pending" => "https: //emilcecharras.com.ar/venta_pendiente/$idVenta",
            "failure" => "https: //emilcecharras.com.ar/venta_error/$idVenta",
=======
            "success" => "https://emilcecharras.com.ar/cursos/compra-realizada/$idVenta",
            "pending" => "https: //emilcecharras.com.ar/cursos/compra-pendiente/$idVenta",
            "failure" => "https: //emilcecharras.com.ar/cursos/compra-error/$idVenta",
>>>>>>> 8863181c08512d9a7574d5f279d914040d78e2b0
        ];

        $preference->payment_methods = array(
            "installments" => 6,
        );
        $preference->auto_return = "all";

        $preference->notification_url = '';

        $preference->save();

        header("Location: " . $preference->init_point);

    }
    public function index()
    {
        $seccion = "Cursos";
        $curso = new Curso();
        $aCursos = $curso->obtenerTodos();
        return view('web.cursos', compact('seccion', 'aCursos'));
    }

    public function compraCurso()
    {
        return view('web.compra-curso');
    }

    public function detalleCurso($id)
    {
        $curso = new Curso();
        $curso->obtenerPorId($id);
        return view('web.detalle-curso', compact('curso'));
    }

    public function subirDatosCompra($id, Request $request)
    {
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
    
    public function compraRealizada($idVenta)
    {
        $venta = new Venta();
        $venta->estado($idVenta, VENTA_APROBADO);

        return view('web.compra-realizada');
    }

    public function compraPendiente($idVenta)
    {
        $venta = new Venta();
        $venta->estado($idVenta, VENTA_PENDIENTE);

        return view('web.compra-pendiente');
    }

    public function compraError($idVenta)
    {
        $venta = new Venta();
        $venta->estado($idVenta, VENTA_RECHAZADO);
        return view('web.compra-error');
    }

}
