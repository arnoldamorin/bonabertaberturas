<?php

    namespace App\Http\Controllers;

    use App\Entidades\Cliente;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorCliente extends Controller
    {
        public function index()
        {
            $titulo = "Clientes";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("CLIENTECONSULTA")) {
                    $codigo = "CLIENTECONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('cliente.cliente-listar', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadCliente = new Cliente();
            $aClientes = $entidadCliente->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aClientes) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aClientes[$i]->nombre;
                $row[] = $aClientes[$i]->apellido;
                $row[] = $aClientes[$i]->dni;
                $row[] = $aClientes[$i]->mail;
                $row[] = $aClientes[$i]->telefono;
                $row[] = $aClientes[$i]->direccion;                
                $row[] = "<a href='/admin/cliente/nuevo/".$aClientes[$i]->idcliente."'><i class='fas fa-edit'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $titulo = "Nuevo Cliente";
            return view('cliente.cliente-nuevo', compact('titulo'));
        }

        public function editar($id)
        {
            $titulo = "Modificar Cliente";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("CLIENTEEDITAR")) {
                    $codigo = "CLIENTESEDITAR";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $cliente = new Cliente();
                    $cliente->obtenerPorId($id);
    
                    return view('cliente.cliente-nuevo', compact('cliente', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Cliente";
                $entidad = new Cliente();
                $entidad->cargarDesdeRequest($request);
    
                //validaciones
                if ($entidad->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $entidad->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo                       
                        $entidad->insertar();
                        
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idcliente;
                    return view('Cliente.Cliente-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }

            $id = $entidad->idcliente;
            $cliente = new Cliente();
            $cliente->obtenerPorId($id);
    
            return view('cliente.cliente-nuevo', compact('msg', 'Cliente', 'titulo')) . '?id=' . $cliente->idcliente;
        }

        public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("CLIENTEELIMINAR")) {
                    $entidad = new Cliente();
                    $entidad->cargarDesdeRequest($request);

                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
    
                } else {
                    $codigo = "CLIENTEELIMINAR";
                    $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }
    }

?>