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
        'idinscripcion', 'fecha', 'importe','fk_idcurso','fk_idalumno','fk_idestado','telefono','correo'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idinscripcion = $request->input('id')!="0" ? $request->input('id') : $this->idinscripcion;
        $this->fecha = $request->input('txtFecha');
        $this->importe = $request->input('txtImporte');
        $this->fk_idcurso = $request->input('lstCurso');
        $this->fk_idalumno = $request->input('lstAlumno'); 
        $this->telefono = $request->input('txtTelefono');
        $this->correo = $request->input('txtCorreo'); 
        $this->fk_idestado = $request->input('lstEstado');  
    }

  public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.fecha',
           1 => 'C.importe',
           2 => 'C.fk_idcurso',
           3 => 'C.fk_idalumno',
           4 => 'C.fk_idestado',
           5 => 'C.telefono',
           6 => 'C.correo'    
            );
        $sql = "SELECT DISTINCT
                    C.idinscripcion,
                    C.fecha,
                    C.importe,
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
                  C.importe,
                  C.fk_idcurso,
                  C.fk_idalumno,
                  C.fk_idestado,
                  C.telefono,
                  C.correo
                FROM inscripciones C ORDER BY C.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idinscripcion) {
        $sql = "SELECT
                idinscripcion,
                fecha,
                importe,
                fk_idcurso,
                fk_idalumno,
                fk_idestado,
                telefono,
                correo
                FROM inscripciones WHERE idinscripcion = '$idinscripcion'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idinscripcion = $lstRetorno[0]->idinscripcion;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->importe = $lstRetorno[0]->importe;
            $this->fk_idcurso = $lstRetorno[0]->fk_idcurso;
            $this->fk_idalumno = $lstRetorno[0]->fk_idalumno; 
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;     
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE inscripciones SET
            fecha = '$this->fecha',
            importe = $this->importe,
            curso = '$this->fk_idcurso',
            alumno = '$this->fk_idalumno',
            estado = '$this->fk_idestado',
            telefono = '$this->telefono',
            correo = '$this->correo'
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
                importe,
                fk_idcurso,
                fk_idalumno,
                fk_idestado,
                telefono,
                correo             
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
       $result = DB::insert($sql, [
            $this->fecha, 
            $this->importe,
            $this->fk_idcurso,
            $this->fk_idalumno,
            $this->fk_idestado,
            $this->telefono,
            $this->correo          
        ]);
       return $this->idinscripcion = DB::getPdo()->lastInsertId();
    }

}
