<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorWebConferencias extends Controller{
    public function index(){
        $seccion = "Conferencias";
        $conferencia = new Conferencia();
        $aConferencias = $conferencia->obtenerTodos();
        return view('web.conferencias', compact('seccion', 'aConferencias'));
    }

}
