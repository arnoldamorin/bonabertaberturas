<?php
namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorMenu extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Menú";
        $entidad = new Menu();
        $array_menu = $entidad->obtenerMenuPadre();
        return view('sistema.categoria-nuevo', compact('titulo', 'array_menu'));

    }
}
?>