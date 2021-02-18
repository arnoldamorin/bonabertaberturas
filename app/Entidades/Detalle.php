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
        'iddetalle', 'fk_idventa', 'fk_idtipo_producto', 'fk_codproducto', 'descrprod','cantidad', 'preciounitario', 'total'
    ];

    protected $hidden = [];

    function cargarDesdeRequest($request)
    {
        $this->iddetalle = $request->input('id') != "0" ? $request->input('id') : $this->iddetalle;
        $this->fk_idventa = $request->input('txtfk_idventa');
        $this->fk_idtipo_producto = $request->input('lstTipoProducto');
        $this->fk_codproducto = $request->input('lstProducto');
        $this->descrprod = $request->input('txtDescrProducto');
        $this->cantidad = $request->input('txtCantidad');
        $this->preciounitario = $request->input('txtPrecioUnitario');        
        $this->total = $request->input('txtTotal');
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'C.fk_idventa',
            1 => 'C.fk_idtipo_producto',
            2 => 'C.fk_codproducto',
            3 => 'C.descrprod',
            4 => 'C.preciounitario',
            5 => 'C.cantidad',
            6 => 'C.total'

        );
        $sql = "SELECT DISTINCT
                    C.iddetalle,
                    C.fk_idventa,
                    C.fk_idtipo_producto,
                    C.descrprod,
                    C.preciounitario,
                    C.cantidad,
                    C.total                                 
                    FROM detalles C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( C.fk_idventa LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    

    public function obtenerTodos()
    {
        $sql = "SELECT 
                  C.iddetalle,
                  C.fk_idventa,
                  C.fk_idtipo_producto,
                  C.descrprod,
                  C.preciounitario,
                  C.cantidad,
                  C.total                           
                FROM detalles C ORDER BY C.iddetalle";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT
                C.iddetalle,
                C.fk_idventa,
                C.fk_idtipo_producto,
                C.descrprod,
                C.preciounitario,
                C.cantidad,
                C.total                           
                FROM detalles C WHERE iddetalle = '$id'";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->iddetalle = $lstRetorno[0]->iddetalle;
            $this->fk_idventa = $lstRetorno[0]->fk_idventa;
            $this->fk_idtipo_producto = $lstRetorno[0]->fk_idtipo_producto;
            $this->fk_codproducto = $lstRetorno[0]->fk_codproducto;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->preciounitario = $lstRetorno[0]->preciounitario;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->total = $lstRetorno[0]->total;
            return $this;
        }
        return null;
    }


    public function guardar()
    {
        $sql = "UPDATE detalles SET
            fk_idventa = '$this->fk_idventa',
            fk_idtipo_producto = '$this->fk_idtipo_producto',
            fk_codproducto = '$this->fk_codproducto',
            descrprod = '$this->descrprod',
            preciounitario = '$this->preciounitario',            
            cantidad = '$this->cantidad',           
            total = '$this->total',           
            WHERE iddetalle=?";
        $affected = DB::update($sql, [$this->iddetalle]);
    }

    public  function eliminar()
    {
        $sql = "DELETE FROM detalles WHERE 
            iddetalle=?";
        $affected = DB::delete($sql, [$this->iddetalle]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO detalles (
                fk_idventa,
                fk_idtipo_producto,
                fk_codproducto,              
                descrprod,
                preciounitario,
                cantidad,
                total                              
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->fk_idventa,
            $this->fk_idtipo_producto,            
            $this->fk_codproducto,
            $this->descrprod,
            $this->preciounitario,            
            $this->cantidad,
            $this->total
        ]);
        return $this->iddetalle = DB::getPdo()->lastInsertId();
    }
}

