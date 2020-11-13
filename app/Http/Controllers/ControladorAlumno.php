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
            return view('sistema.menu-nuevo', compact('titulo', 'array_menu'));

        }
    }

?>