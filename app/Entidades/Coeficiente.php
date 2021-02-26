<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Coeficiente extends Model
{
    protected $table = 'Coeficiente';
    public $timestamps = false;

    protected $fillable = [
        'idcoeficiente', 'nombre', 'valor'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idtipo_producto = $request->input('id')!="0" ? $request->input('id') : $this->idtipo_producto;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');   
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'TP.nombre',
           1 => 'TP.descripcion'     
            );
        $sql = "SELECT DISTINCT
                    TP.idtipo_producto,
                    TP.nombre,
                    TP.descripcion                   
                    FROM tipos_productos TP
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( TP.nombre LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  TP.idtipo_producto,
                  TP.nombre,
                  TP.descripcion
                FROM tipos_productos TP ORDER BY TP.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idtipo_producto) {
        $sql = "SELECT
                idtipo_producto,
                nombre,
                descripcion
                FROM tipos_productos WHERE idtipo_producto = $idtipo_producto";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idtipo_producto = $lstRetorno[0]->idtipo_producto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE tipos_productos SET
            nombre = '$this->nombre',
            descripcion = '$this->descripcion'
            WHERE idtipo_producto=?";
        $affected = DB::update($sql, [$this->idtipo_producto]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM tipos_productos WHERE 
            idtipo_producto=?";
        $affected = DB::delete($sql, [$this->idtipo_producto]);
    }

    public function insertar() {
        $sql = "INSERT INTO tipos_productos (
                nombre,
                descripcion             
            ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion           
        ]);
       return $this->idtipo_producto = DB::getPdo()->lastInsertId();
    }

}
