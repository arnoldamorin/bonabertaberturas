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
        'iddetalle', 'fk_idventa', 'fk_codproducto', 'fk_idtipo_producto','cantidad', 'total', 'descrprod'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->iddetalle = $request->input('id')!="0" ? $request->input('id') : $this->iddetalle;
        $this->fk_idtipo_producto = $request->input('txtfk_idtipo_producto');                             
        $this->fk_codproducto = $request->input('lstCodProducto'); 
        $this->cantidad = $request->input('txtCantidad');   
        $this->total = $request->input('txtTotal');   
        $this->descrprod = $request->input('txtDescrProd');   
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fk_idventa',
           1 => 'C.fk_idtipo_producto',
           2 => 'C.fk_codproducto',
           3 => 'C.descrprod',
           4 => 'C.cantidad',
           5 => 'C.total'
          
            );
        $sql = "SELECT DISTINCT
                    C.iddetalle,
                    C.fk_idventa,
                    C.fk_idtipo_producto,
                    C.descrprod,
                    C.cantidad,
                    C.total                                 
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
                  C.fk_codproducto,
                  C.cantidad                 
                FROM detalles C ORDER BY C.iddetalle";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($iddetalle) {
        $sql = "SELECT
                d.iddetalle,
                d.fk_idtipo_producto,                
                d.fk_codproducto,
                d.cantidad,
                (p.precio_venta * d.cantidad) as total                            
                FROM detalles d inner join productos p on d.fk_codproducto=p.idproducto WHERE iddetalle = '$iddetalle'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->iddetalle = $lstRetorno[0]->iddetalle;
            $this->fk_idventa = $lstRetorno[0]->fk_idventa;         
            $this->fk_codproducto = $lstRetorno[0]->fk_codproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;                        
            return $this;
        }
        return null;
    }
    

    public function guardar() {
        $sql = "UPDATE detalles SET
            fk_idventa = '".$this->fk_idventa. " ". $this->hora ."',
            fk_codproducto = '$this->fk_codproducto',
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
                fk_codproducto,
                cantidad                                
            ) VALUES (?, ?, ?)";
       $result = DB::insert($sql, [
            $this->fk_idventa . " " . date("H:i:s"), 
            $this->fk_codproducto,
            $this->cantidad                          
        ]);
       return $this->iddetalle = DB::getPdo()->lastInsertId();
    }  

    
}
