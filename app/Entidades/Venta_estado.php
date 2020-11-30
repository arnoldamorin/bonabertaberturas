<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Venta_estado extends Model
{
    protected $table = 'inscripcion_estado';
    public $timestamps = false;

    protected $fillable = [
        'idestado', 'nombre'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idestado = $request->input('id')!="0" ? $request->input('id') : $this->idestado;
        $this->nombre = $request->input('lstNombre');
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  T.idestado,
                  T.nombre
                FROM inscripcion_estado T ORDER BY T.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idestado) {
        $sql = "SELECT
                idestado,
                nombre
                FROM inscripcion_estado WHERE idestado = '$idestado'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idestado = $lstRetorno[0]->idestado;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
          $columns = array(
             0 => 'A.nombre'
              );
          $sql = "SELECT DISTINCT
                      A.idtestimonio,
                      A.nombre
                      FROM inscripcion_estado A
                  WHERE 1=1
                  ";
  
          //Realiza el filtrado
          if (!empty($request['search']['value'])) { 
              $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
/*              $sql.= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%'";
              $sql.= " OR A.video LIKE '%" . $request['search']['value'] . "%')";*/
          }
          $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
  
          $lstRetorno = DB::select($sql);
  
          return $lstRetorno;
      } 
}
