<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Venta extends Model
{
    protected $table = 'ventas';
    public $timestamps = false;

    protected $fillable = [
        'idventa', 'fecha', 'telefono', 'correo', 'nombre_comprador', 'apellido_comprador', 'fk_idventas_estados'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idventa = $request->input('id')!="0" ? $request->input('id') : $this->idventa;
        $this->fecha = $request->input('txtFecha');
        $this->hora = $request->input('txtHora');       
        $this->telefono = $request->input('txtTelefono');
        $this->correo = $request->input('txtCorreo'); 
        $this->nombre_comprador = $request->input('txtNombreComprador');
        $this->apellido_comprador = $request->input('txtApellidoComprador');
        $this->fk_idventas_estados = $request->input('lstEstado');        
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fecha',           
           1 => 'C.telefono',
           2 => 'C.correo',
           3 => 'C.nombre_comprador',
           4 => 'C.apellido_comprador',
           5 => 'C.fk_idventas_estados',
           6 => 'C.idventa'
            );
        $sql = "SELECT DISTINCT
                    C.fecha,
                    C.telefono,
                    C.correo,                   
                    C.nombre_comprador,
                    C.apellido_comprador,
                    C.fk_idventa_estados,
                    C.idventa
                    FROM ventas C
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.nombre_comprador LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.apellido_comprador LIKE '%" . $request['search']['value'] . "%' ";            
            $sql .= " OR C.idventa LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idventa,
                  C.fecha,
                  C.fk_iddetalle,
                  C.telefono,
                  C.correo,
                  C.nombre_comprador,
                  C.apellido_comprador,
                  C.fk_idventas_estados
                FROM ventas C ORDER BY C.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idventa) {
        $sql = "SELECT
                idventa,
                DATE(fecha) AS fecha,
                TIME(fecha) AS hora,
                fk_iddetalle,
                telefono,
                correo,
                nombre_comprador,
                apellido_comprador,
                fk_idventas_estados                
                FROM ventas WHERE idventa = '$idventa'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idventa = $lstRetorno[0]->idventa;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->hora = $lstRetorno[0]->hora;
            $this->fk_iddetalle = $lstRetorno[0]->fk_iddetalle;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            $this->nombre_comprador = $lstRetorno[0]->nombre_comprador;
            $this->apellido_comprador = $lstRetorno[0]->apellido_comprador;
            $this->fk_idventas_estados = $lstRetorno[0]->fk_idventas_estados;     
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE ventas SET
            fecha = '".$this->fecha. " ". $this->hora ."',
            fk_iddetalle = '$this->fk_iddetalle',
            telefono = '$this->telefono',
            correo = '$this->correo',
            nombre_comprador = '$this->nombre_comprador',
            apellido_comprador = '$this->apellido_comprador',
            fk_idventas_estados = '$this->fk_idventas_estados'
            WHERE idventa=?";
        $affected = DB::update($sql, [$this->idventa]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM ventas WHERE 
            idventa=?";
        $affected = DB::delete($sql, [$this->idventa]);
    }

    public function insertar() {
        $sql = "INSERT INTO ventas (
                fecha,
                fk_iddetalle,
                telefono,
                correo, 
                nombre_comprador,
                apellido_comprador,                
                fk_idventas_estados                        
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
       $result = DB::insert($sql, [
            $this->fecha . " " . date("H:i:s"), 
            $this->fk_iddetalle,
            $this->telefono,
            $this->correo,
            $this->nombre_comprador,
            $this->apellido_comprador,
            $this->fk_idventas_estados                      
        ]);
       return $this->idventa = DB::getPdo()->lastInsertId();
    }

    public function insertarDatosCompra(){
        $sql = "INSERT INTO ventas (fecha, fk_iddetalle, telefono, correo, nombre_comprador, apellido_comprador, fk_idventas_estados)
        VALUES (?,?,?,?,?,?,?)";
        $result = DB::insert($sql, [
            $this->fecha . " " . date("H:i:s"),
            $this->fk_iddetalle,
            $this->telefono_comprador,
            $this->correo_comprador,
            $this->nombre_comprador,
            $this->apellido_comprador,
            $this->estado
        ]);
        return $this->idventa = DB::getPdo()->lastInsertId();
    }

    public function estado($idventa,$estado){
        $sql = "UPDATE ventas SET 
        estado = $estado
        WHERE idventa = $idventa";
        $affected = DB::update($sql, [$this->idventa]);    
    }
}
