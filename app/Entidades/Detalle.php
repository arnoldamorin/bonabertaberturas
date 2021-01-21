<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Detalle extends Model
{
    protected $table = 'detalles';
    public $timestamps = false;

    protected $fillable = [
        'iddetalle', 'fk_idventa', 'fk_idproducto', 'cantidad'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->iddetalle = $request->input('id')!="0" ? $request->input('id') : $this->iddetalle;
        $this->fk_idventa = $request->input('txtfk_idventa');                             
        $this->fk_idproducto = $request->input('lstDetalle'); 
        $this->cantidad = $request->input('txtcantidad');   
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fk_idventa',
           1 => 'C.fk_idproducto',
           2 => 'C.cantidad'
            );
        $sql = "SELECT DISTINCT
                    C.iddetalle,
                    C.fk_idventa,
                    C.cantidad                                  
                    FROM detalles C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.fk_idventa LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.iddetalle,
                  C.fk_idventa,
                  C.fk_idproducto,
                  C.cantidad                 
                FROM detalles C ORDER BY C.iddetalle";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($iddetalle) {
        $sql = "SELECT
                iddetalle,
                DATE(fk_idventa) AS fk_idventa,
                TIME(fk_idventa) AS hora,
                fk_idproducto,
                cantidad                            
                FROM detalles WHERE iddetalle = '$iddetalle'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->iddetalle = $lstRetorno[0]->iddetalle;
            $this->fk_idventa = $lstRetorno[0]->fk_idventa;         
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;            
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE detalles SET
            fk_idventa = '".$this->fk_idventa. " ". $this->hora ."',
            fk_idproducto = '$this->fk_idproducto',
            cantidad = '$this->cantidad',           
            WHERE iddetalle=?";
        $affected = DB::update($sql, [$this->iddetalle]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM detalles WHERE 
            iddetalle=?";
        $affected = DB::delete($sql, [$this->iddetalle]);
    }

    public function insertar() {
        $sql = "INSERT INTO detalles (
                fk_idventa,
                fk_idproducto,
                cantidad                                
            ) VALUES (?, ?, ?)";
       $result = DB::insert($sql, [
            $this->fk_idventa . " " . date("H:i:s"), 
            $this->fk_idproducto,
            $this->cantidad                          
        ]);
       return $this->iddetalle = DB::getPdo()->lastInsertId();
    }  

    
}
