<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';

class ControladorWebHome extends Controller
{
    public function contacto()
=======
require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
>>>>>>> e91ecd939ab600e3bea7e4e8ad9aeea905ccd5e4
    {
        return view('web.contacto');
    }

}
