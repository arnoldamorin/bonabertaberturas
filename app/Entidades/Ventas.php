<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Ventas extends Model
{
    protected $table = 'inscripciones';
    public $timestamps = false;

    protected $fillable = [
        'idinscripcion', 'fecha', 'importe'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idinscripcion = $request->input('id')!="0" ? $request->input('id') : $this->idinscripcion;
        $this->fecha = $request->input('txtFecha');
        $this->importe = $request->input('txtImporte');   
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fecha',
           1 => 'C.importe'     
            );
        $sql = "SELECT DISTINCT
                    C.idinscripcion,
                    C.fecha,
                    C.importe                   
                    FROM inscripciones C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.fecha LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idinscripcion,
                  C.fecha,
                  C.importe
                FROM inscripciones C ORDER BY C.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idinscripcion) {
        $sql = "SELECT
                idinscripcion,
                fecha,
                importe
                FROM inscripciones WHERE idinscripciones = '$idinscripcion'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idinscripcion = $lstRetorno[0]->idinscripcion;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->importe = $lstRetorno[0]->importe;      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE inscripciones SET
            fecha = '$this->fecha',
            importe = '$this->importe'
            WHERE idinscripcion=?";
        $affected = DB::update($sql, [$this->idinscripcion]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM inscripciones WHERE 
            idinscripcion=?";
        $affected = DB::delete($sql, [$this->idinscripcion]);
    }

    public function insertar() {
        $sql = "INSERT INTO inscripciones (
                fecha,
                importe             
            ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->fecha, 
            $this->importe           
        ]);
       return $this->idinscripcion = DB::getPdo()->lastInsertId();
    }

}
