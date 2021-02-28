<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class IngresoStock extends Model
{
    protected $table = 'Inbreso_Stock';
    public $timestamps = false;

    protected $fillable = [
        'idingreso', 'fk_idtipo_producto', 'fk_codproducto', 'cantidad', 'fecha_ingreso'
    ];

    protected $hidden = [];

    function cargarDesdeRequest($request)
    {
        $this->idingreso = $request->input('id') != "0" ? $request->input('id') : $this->idingreso;
        $this->fk_idtipo_producto = $request->input('lstTipoProducto');
        $this->fk_codproducto = $request->input('lstProducto');
        $this->cantidad = $request->input('txtCantidad');
        $this->fecha_ingreso = $request->input('txtFechaIngreso');
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'I.fk_idtipo_producto',
            1 => 'I.fk_codproducto',
            2 => 'I.cantidad',
            3 => 'I.fecha_ingreso',
            4 => 'I.idingreso'
        );
        $sql = "SELECT DISTINCT
                    I.fk_idtipo_producto,                    
                    I.fk_codproducto,
                    I.cantidad,
                    I.fecha_ingreso,
                    I.idingreso                   
                    FROM ingreso_stock I
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( I.fk_codproducto LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT 
                  I.fk_idtipo_producto,                    
                  I.fk_codproducto,
                  I.idingreso,                  
                  I.cantidad,
                  I.fecha_ingreso
                FROM ingreso_stock I ORDER BY I.fk_codproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idingreso)
    {
        $sql = "SELECT
                I.fk_idtipo_producto,                    
                I.fk_codproducto,
                idingreso,                
                cantidad,
                fecha_ingreso
                FROM ingreso_stock WHERE idingreso = $idingreso";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idingreso = $lstRetorno[0]->fk_idtipo_producto;            
            $this->fk_codproducto = $lstRetorno[0]->fk_codproducto;
            $this->idingreso = $lstRetorno[0]->idingreso;            
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->cantidad = $lstRetorno[0]->fecha_ingreso;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE ingreso_stock SET
            fk_idtipo_producto = '$this->fk_idtipo_producto',
            fk_codproducto = '$this->fk_codproducto',            
            cantidad = '$this->cantidad',
            fecha_ingreso = '$this->fecha_ingreso'
            WHERE idingreso=?";
        $affected = DB::update($sql, [$this->idingreso]);
    }

    public  function eliminar()
    {
        $sql = "DELETE FROM ingreso_stock WHERE 
            idingreso=?";
        $affected = DB::delete($sql, [$this->idingreso]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO ingreso_stock (
                fk_idtipo_producto,
                fk_codproducto,
                cantidad,
                fecha_ingreso             
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_codproducto,
            $this->cantidad
        ]);
        return $this->idingreso = DB::geIdo()->lastInsertId();
    }
}

