<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Testimonio extends Model
{
    protected $table = 'testimonios';
    public $timestamps = false;

    protected $fillable = [
        'idtestimonio', 'nombre', 'descripcion', 'video'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idtestimonio = $request->input('id')!="0" ? $request->input('id') : $this->idtestimonio;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->video = $request->input('txtVideo') != "" ? $request->input('txtVideo') : 0;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  T.idtestimonio,
                  T.nombre,
                  T.descripcion,
                  T.video
                FROM testimonios T ORDER BY T.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idtestimonio) {
        $sql = "SELECT
                idtestimonio,
                nombre,
                descripcion,
                video
                FROM testimonios WHERE idtestimonio = '$idtestimonio'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idtestimonio = $lstRetorno[0]->idtestimonio;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->video = $lstRetorno[0]->video;
            return $this;
        }
        return null;
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
          $columns = array(
             0 => 'A.nombre',
             1 => 'A.descripcion',
             2 => 'A.video'
              );
          $sql = "SELECT DISTINCT
                      A.idtestimonio,
                      A.nombre,
                      A.descripcion,
                      A.video
                      FROM testimonios A
                  WHERE 1=1
                  ";
  
          //Realiza el filtrado
          if (!empty($request['search']['value'])) { 
              $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
              $sql.=" OR A.nombre LIKE '%" . $request['search']['value'] . "%' ";
              $sql.=" OR A.url LIKE '%" . $request['search']['value'] . "%' )";
          }
          $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
  
          $lstRetorno = DB::select($sql);
  
          return $lstRetorno;
      } 

    public function guardar() {
        $sql = "UPDATE testimonios SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            video='$this->orden',
            WHERE idtestimonio=?";
        $affected = DB::update($sql, [$this->idtestimonio]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM testimonios WHERE 
            idtestimonio=?";
        $affected = DB::delete($sql, [$this->idtestimonio]);
    }

    public function insertar() {
        $sql = "INSERT INTO testimonios (
                nombre,
                descripcion,
                video
            ) VALUES (?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->idescripcion, 
            $this->video, 
        ]);
       return $this->idtestimonio = DB::getPdo()->lastInsertId();
    }
}
