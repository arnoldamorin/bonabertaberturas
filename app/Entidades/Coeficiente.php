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
        $this->idcoeficiente = $request->input('id')!="0" ? $request->input('id') : $this->idcoeficiente;
        $this->nombre = $request->input('txtNombre');
        $this->valor = $request->input('txtValor');   
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.nombre',
           1 => 'C.valor'     
            );
        $sql = "SELECT DISTINCT
                    C.idcoeficiente,
                    C.nombre,
                    C.valor                   
                    FROM coeficientes C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.nombre LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idcoeficiente,
                  C.nombre,
                  C.valor
                FROM coeficientes C ORDER BY C.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcoeficiente) {
        $sql = "SELECT              
                nombre,
                valor
                FROM coeficientes WHERE idcoeficiente = $idcoeficiente";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcoeficiente = $lstRetorno[0]->idcoeficiente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->valor = $lstRetorno[0]->valor;      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE coeficientes SET
            nombre = '$this->nombre',
            valor = '$this->valor'
            WHERE idcoeficiente=?";
        $affected = DB::update($sql, [$this->idcoeficiente]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM coeficientes WHERE 
            idcoeficiente=?";
        $affected = DB::delete($sql, [$this->idcoeficiente]);
    }

    public function insertar() {
        $sql = "INSERT INTO coeficientes (
                nombre,
                valor             
            ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->valor           
        ]);
       return $this->idcoeficiente = DB::geCdo()->lastInsertId();
    }

}
