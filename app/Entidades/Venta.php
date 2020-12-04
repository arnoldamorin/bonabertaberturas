<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Venta extends Model
{
    protected $table = 'inscripciones';
    public $timestamps = false;

    protected $fillable = [
        'idinscripcion', 'fecha', 'fk_idcurso', 'telefono', 'correo', 'nombre_comprador', 'apellido_comprador', 'fk_idestado'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idinscripcion = $request->input('id')!="0" ? $request->input('id') : $this->idinscripcion;
        $this->fecha = $request->input('txtFecha');
        $this->hora = $request->input('txtHora');
        $this->fk_idcurso = $request->input('lstCurso');
        $this->telefono = $request->input('txtTelefono');
        $this->correo = $request->input('txtCorreo'); 
        $this->nombre_comprador = $request->input('txtNombreComprador');
        $this->apellido_comprador = $request->input('txtApellidoComprador');
        $this->fk_idestado = $request->input('lstEstado');  
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fecha',
           1 => 'C.fk_idcurso',
           2 => 'C.telefono',
           3 => 'C.correo',
           4 => 'C.nombre_comprador',
           5 => 'C.apellido_comprador',
           6 => 'C.fk_idestado'
            );
        $sql = "SELECT DISTINCT
                    C.idinscripcion,
                    C.fecha,
                    C.telefono,
                    C.correo                   
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
                  C.fk_idcurso,
                  C.telefono,
                  C.correo,
                  C.nombre_comprador,
                  C.apellido_comprador,
                  C.fk_idestado
                FROM inscripciones C ORDER BY C.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idinscripcion) {
        $sql = "SELECT
                idinscripcion,
                DATE(fecha) AS fecha,
                TIME(fecha) AS hora,
                fk_idcurso,
                telefono,
                correo,
                nombre_comprador,
                apellido_comprador,
                fk_idestado                
                FROM inscripciones WHERE idinscripcion = '$idinscripcion'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idinscripcion = $lstRetorno[0]->idinscripcion;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->hora = $lstRetorno[0]->hora;
            $this->fk_idcurso = $lstRetorno[0]->fk_idcurso;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            $this->nombre_comprador = $lstRetorno[0]->nombre_comprador;
            $this->apellido_comprador = $lstRetorno[0]->apellido_comprador;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;     
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE inscripciones SET
            fecha = '".$this->fecha. " ". $this->hora ."',
            fk_idcurso = '$this->fk_idcurso',
            telefono = '$this->telefono',
            correo = '$this->correo',
            nombre_comprador = '$this->nombre_comprador',
            apellido_comprador = '$this->apellido_comprador',
            fk_idestado = '$this->fk_idestado'
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
                fk_idcurso,
                telefono,
                correo, 
                nombre_comprador,
                apellido_comprador,                
                fk_idestado                        
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
       $result = DB::insert($sql, [
            $this->fecha . " " . date("H:i:s"), 
            $this->fk_idcurso,
            $this->telefono,
            $this->correo,
            $this->nombre_comprador,
            $this->apellido_comprador,
            $this->fk_idestado                      
        ]);
       return $this->idinscripcion = DB::getPdo()->lastInsertId();
    }

    public function insertarDatosCompra(){
        $sql = "INSERT INTO inscripciones (fecha, fk_idcurso, telefono, correo, nombre_comprador, apellido_comprador, fk_idestado)
        VALUES (?,?,?,?,?,?,?)";
        $result = DB::insert($sql, [
            $this->fecha . " " . date("H:i:s"),
            $this->fk_idcurso,
            $this->telefono_comprador,
            $this->correo_comprador,
            $this->nombre_comprador,
            $this->apellido_comprador,
            $this->estado
        ]);
        return $this->idinscripcion = DB::getPdo()->lastInsertId();
    }

    public function estado($idventa,$estado){
        $sql = "UPDATE inscripciones SET 
        estado = $estado
        WHERE idinscripcion = $idventa";
        $affected = DB::update($sql, [$this->idinscripcion]);    
    }
}
