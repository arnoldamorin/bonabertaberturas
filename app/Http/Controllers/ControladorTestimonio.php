<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
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
}

?>
