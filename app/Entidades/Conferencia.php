<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Conferencia extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [
        'idcategoria', 'nombre', 'descripcion', 'imagen'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idconferencia = $request->input('id')!="0" ? $request->input('id') : $this->idconferencia;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->imagen = $request->input('imagen');

    }

     public function obtenerFiltrado() {
      $request = $_REQUEST;
        $columns = array(
           0 => 'A.nombre',
           1 => 'A.descripcion',
           2 => 'A.imagen'
            );
        $sql = "SELECT DISTINCT
                    A.idconferencia,
                    A.nombre,
                    B.nombre as padre,
                    A.url,
                    A.activo
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idmenu
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR A.url LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    } */

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idconferencia,
                  A.nombre,
                  A.decripcion,
                  A.imagen
                FROM conferencias A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idmenu) {
        $sql = "SELECT
                    idconferencia,
                    nombre,
                    decripcion,
                    imagen
                FROM conferencias WHERE idconferencias = '$idconferencias'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idconferencia = $lstRetorno[0]->idconferencia;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->decripcion = $lstRetorno[0]->decripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE conferencias SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            imagen=$this->imagen,
            WHERE idconferencia=?";
        $affected = DB::update($sql, [$this->idconferencia]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM conferencias WHERE 
            idconferencia=?";
        $affected = DB::delete($sql, [$this->idconferencia]);
    }

    public function insertar() {
        $sql = "INSERT INTO conferencia (
                    nombre,
                    decripcion,
                    imagen
            ) VALUES (?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->decripcion, 
            $this->imagen, 
        ]);
       return $this->idconferencia = DB::getPdo()->lastInsertId();
    }

}
