<?php|

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
}

?>