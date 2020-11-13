<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorTestimonio extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Testimonio";
        return view('testimonio.testimonio-nuevo', compact('titulo'));

    }
}

?>
