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
        $this->idcategoria = $request->input('id')!="0" ? $request->input('id') : $this->idcategoria;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->imagen = $request->input('imagen');

    }

 /*  public function obtenerFiltrado() {
      $request = $_REQUEST;
        $columns = array(
           0 => 'A.nombre',
           1 => 'B.nombre',
           2 => 'A.url',
           3 => 'A.activo'
            );
        $sql = "SELECT DISTINCT
                    A.idmenu,
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
                  A.idcategoria,
                  A.nombre,
                  A.decripcion,
                  A.imagen
                FROM categorias A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idmenu) {
        $sql = "SELECT
                    idcategoria,
                    nombre,
                    decripcion,
                    imagen
                FROM categorias WHERE idcategoria = '$idcategoria'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->decripcion = $lstRetorno[0]->decripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE categorias SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            imagen=$this->imagen,
            WHERE idcategoria=?";
        $affected = DB::update($sql, [$this->idcategoria]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM categorias WHERE 
            idcategoria=?";
        $affected = DB::delete($sql, [$this->idcategoria]);
    }

    public function insertar() {
        $sql = "INSERT INTO categorias (
                    nombre,
                    decripcion,
                    imagen
            ) VALUES (?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->decripcion, 
            $this->imagen, 
        ]);
       return $this->idmenu = DB::getPdo()->lastInsertId();
    }

}
