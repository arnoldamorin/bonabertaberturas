<?php
namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorConferencia extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva Conferencia";
        $entidad = new Conferencia();
        $array_menu = $entidad->obtenerConferenciaPadre();
        return view('sistema.conferencia-nuevo', compact('titulo', 'array_menu'));

    }
}
namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorConferencia extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva Conferencia";
        return view('sistema.conferencia-nuevo', compact('titulo', 'array_menu'));

    }
}
?>