<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'telefono', 'direccion', 'mail', 'dni'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idcliente = $request->input('id')!="0" ? $request->input('id') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');        
        $this->telefono = $request->input('txtTelefono');
        $this->direccion = $request->input('txtDireccion');
        $this->mail = $request->input('txtMail');        
        $this->dni = $request->input('txtDni');
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'A.nombre',
           1 => 'A.apellido',
           2 => 'A.telefono',
           3 => 'A.direccion',
           4 => 'A.mail',
           5 => 'A.dni'
           
            );
        $sql = "SELECT DISTINCT
                    A.idcliente,
                    A.nombre,
                    A.apellido,
                    A.dni,
                    A.mail,
                    A.telefono,
                    A.direccion
                    FROM clientes A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.= " AND ( A.nombre LIKE '%" .$request['search']['value']. "%'";
            $sql.= " OR A.apellido LIKE '%" .$request['search']['value']. "%'";
            $sql.= " OR A.dni LIKE '%" .$request['search']['value']. "%'";
            $sql.= " OR A.mail LIKE '%" .$request['search']['value']. "%'";
            $sql.= " OR A.telefono LIKE '%" .$request['search']['value']. "%')";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idcliente,
                  A.nombre,
                  A.apellido,
                  A.dni,
                  A.mail,
                  A.telefono,
                  A.direccion
                FROM clientes A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idalumno) {
        $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                dni,
                mail,
                telefono,
                direccion
                FROM clientes WHERE idalumno = $idalumno";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->dni = $lstRetorno[0]->dni;
            $this->mail = $lstRetorno[0]->mail;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->telefono = $lstRetorno[0]->telefono;
            return $this;
        }
        return null;
    }

    public function obtenerPorCorreo($correo) {
        $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                dni,
                mail,
                telefono,
                direccion
                FROM clientes WHERE mail = '$correo'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->dni = $lstRetorno[0]->dni;
            $this->mail = $lstRetorno[0]->mail;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre = '$this->nombre',
            apellido = '$this->apellido',
            dni = '$this->dni',
            mail = '$this->mail',
            telefono = '$this->telefono',
            direccion = '$this->direccion'
            WHERE idcliente=?";
        DB::update($sql, [$this->idcliente]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM cliente WHERE 
            idcliente=?";
        DB::delete($sql, [$this->idalumno]);
    }

    public function insertar() {
        $sql = "INSERT INTO clientes (
                nombre,
                apellido,
                dni,
                mail,
                telefono,
                direccion
            ) VALUES (?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->apellido, 
            $this->dni, 
            $this->mail, 
            $this->telefono,
            $this->direccion
        ]);
       return $this->idcliente = DB::getPdo()->lastInsertId();
    }

}
