<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Conferencia extends Model
{
    protected $table = 'conferencias';
    public $timestamps = false;

    protected $fillable = [
        'idconferencia', 'nombre', 'descripcion', 'imagen'
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
                    A.descripcion,
                    A.imagen
                    FROM conferencias A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR A.imagen LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    } 

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idconferencia,
                  A.nombre,
                  A.descripcion,
                  A.imagen
                FROM conferencias A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idconferencia) {
        $sql = "SELECT
                    idconferencia,
                    nombre,
                    descripcion,
                    imagen
                FROM conferencias WHERE idconferencia = '$idconferencia'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idconferencia = $lstRetorno[0]->idconferencia;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
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
        $sql = "INSERT INTO conferencias (
                    nombre,
                    descripcion,
                    imagen
            ) VALUES (?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion, 
            $this->imagen
        ]);
       return $this->idconferencia = DB::getPdo()->lastInsertId();
    }

}
