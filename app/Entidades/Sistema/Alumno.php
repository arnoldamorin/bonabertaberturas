<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Alumno extends Model
{
    protected $table = 'alumnos';
    public $timestamps = false;

    protected $fillable = [
        'idalumno', 'nombre', 'apellido', 'dni', 'mail', 'telefono'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idalumno = $request->input('id')!="0" ? $request->input('id') : $this->idalumno;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->dni = $request->input('txtDni');
        $this->mail = $request->input('txtCorreo');
        $this->telefono = $request->input('txtTelefono');
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'A.nombre',
           1 => 'A.apellido',
           2 => 'A.dni',
           3 => 'A.mail',
           4 => 'A.telefono'
            );
        $sql = "SELECT DISTINCT
                    A.idalumno,
                    A.nombre,
                    A.apellido,
                    A.dni,
                    A.mail,
                    A.telefono
                    FROM alumnos A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idalumno,
                  A.nombre,
                  A.apellido,
                  A.dni,
                  A.mail,
                  A.telefono
                FROM alumnos A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idalumno) {
        $sql = "SELECT
                idalumno,
                nombre,
                apellido,
                dni,
                mail,
                telefono
                FROM alumnos WHERE idalumno = '$idalumno'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idalumno = $lstRetorno[0]->idalumno;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->dni = $lstRetorno[0]->dni;
            $this->mail = $lstRetorno[0]->mail;
            $this->telefono = $lstRetorno[0]->telefono;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE alumnos SET
            nombre = '$this->nombre',
            apellido = '$this->apellido',
            dni = '$this->dni',
            mail = '$this->mail',
            telefono = '$this->telefono'
            WHERE idalumno=?";
        $affected = DB::update($sql, [$this->idalumno]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM sistema_menues WHERE 
            idmenu=?";
        $affected = DB::delete($sql, [$this->idmenu]);
    }

    public function insertar() {
        $sql = "INSERT INTO alumnos (
                nombre,
                apellido,
                dni,
                mail,
                telefono
            ) VALUES (?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->apellido, 
            $this->dni, 
            $this->mail, 
            $this->telefono,
        ]);
       return $this->idalumno = DB::getPdo()->lastInsertId();
    }

    public function obtenerMenuDelGrupo($idGrupo){
        $sql = "SELECT DISTINCT
        A.idmenu,
        A.nombre,
        A.id_padre,
        A.orden,
        A.url,
        A.css
        FROM sistema_menues A
        INNER JOIN sistema_menu_area B ON A.idmenu = B.fk_idmenu
        WHERE A.activo = '1' AND B.fk_idarea = $idGrupo ORDER BY A.orden";
        $resultado = DB::select($sql);
        return $resultado;
    }

}
