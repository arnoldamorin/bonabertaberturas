<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [
        'idcategoria', 'nombre', 'descripcion'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idcategoria = $request->input('id')!="0" ? $request->input('id') : $this->idcategoria;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');   
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.nombre',
           1 => 'C.descripcion'     
            );
        $sql = "SELECT DISTINCT
                    C.idcategoria,
                    C.nombre,
                    C.descripcion                   
                    FROM categorias C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.nombre LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idcategoria,
                  C.nombre,
                  C.descripcion
                FROM categorias C ORDER BY C.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcategoria) {
        $sql = "SELECT
                idcategoria,
                nombre,
                descripcion
                FROM categorias WHERE idcategoria = '$idcategoria'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE categorias SET
            nombre = '$this->nombre',
            descripcion = '$this->descripcion'
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
                descripcion             
            ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion,           
        ]);
       return $this->idcategoria = DB::getPdo()->lastInsertId();
    }

}
