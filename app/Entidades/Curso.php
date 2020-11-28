<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Curso extends Model
{
    protected $table = 'cursos';
    public $timestamps = false;

    protected $fillable = [
        'idcurso', 'nombre', 'descripcion', 'precio', 'cupo', 'horario', 'imagen', 'fk_idcategoria'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idcurso = $request->input('id')!="0" ? $request->input('id') : $this->idcurso;
        $this->nombre = $request->input('txtNombre');
        $this->categoria = $request->input('lstCategoria');
        $this->precio = $request->input('txtPrecio') != "" ? $request->input('txtPrecio') : 0;
        $this->cupo = $request->input('nbCupo');
        $this->horario = $request->input('txtHorario');
        $this->descripcion = $request->input('txtDescripcion');
        $this->imagen = $request->input('imagenCurso');
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'C.nombre',
           1 => 'C.descripcion',
           2 => 'C.precio',
           3 => 'C.cupo,',
           4 => 'C.horario',
           5 => 'C.imagen',
           6 => 'C.fk_idcategoria'
            );
        $sql = "SELECT DISTINCT
                    C.idcurso,
                    C.nombre,
                    C.descripcion,
                    C.precio,
                    C.cupo,
                    C.horario,
                    C.imagen,
                    C.fk_idcategoria
                    FROM cursos C
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( C.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR C.precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR C.cupo LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR C.horario LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idcurso,
                  C.nombre,
                  C.descripcion,
                  C.precio,
                  C.cupo,
                  C.horario,
                  C.imagen,
                  C.fk_idcategoria,
                  CA.nombre AS categoria
                FROM cursos C
                INNER JOIN categorias CA ON C.fk_idcategoria = CA.idcategoria
                ORDER BY C.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcurso) {
        $sql = "SELECT
                idcurso,
                nombre,
                descripcion,
                precio,
                cupo,
                horario,
                imagen,
                fk_idcategoria
                FROM cursos WHERE idcurso = $idcurso";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcurso = $lstRetorno[0]->idcurso;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->precio = $lstRetorno[0]->precio;
            $this->cupo = $lstRetorno[0]->cupo;
            $this->horario = $lstRetorno[0]->horario;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->categoria = $lstRetorno[0]->fk_idcategoria;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE cursos SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            precio=$this->precio,
            cupo= $this->cupo,
            horario='$this->horario',
            imagen='$this->imagen',
            fk_idcategoria= '$this->categoria'
            WHERE idcurso=?";
        $affected = DB::update($sql, [$this->idcurso]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM cursos WHERE 
            idcurso=?";
        $affected = DB::delete($sql, [$this->idcurso]);
    }

    public function insertar() {
        $sql = "INSERT INTO cursos (
                nombre,
                descripcion,
                precio,
                cupo,
                horario,
                imagen,
                fk_idcategoria
            ) VALUES (?, ?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion, 
            $this->precio, 
            $this->cupo, 
            $this->horario,
            $this->imagen,
            $this->categoria
        ]);
       return $this->idcurso = DB::getPdo()->lastInsertId();
    }

}
