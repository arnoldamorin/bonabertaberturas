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
        'idcurso', 'nombre', 'descripcion', 'precio', 'cupo', 'horario', 'fk_idcategoria'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idmenu = $request->input('id')!="0" ? $request->input('id') : $this->idcurso;
        $this->nombre = $request->input('txtNombre');
        $this->categoria = $request->input('lstCategoria');
        $this->precio = $request->input('txtPrecio') != "" ? $request->input('txtPrecio') : 0;
        $this->cupo = $request->input('nbCupo');
        $this->horario = $request->input('txtHorario');
        $this->descripcion = $request->input('txtDescripcion');
    }

    // public function obtenerFiltrado() {
    //     $request = $_REQUEST;
    //     $columns = array(
    //        0 => 'A.nombre',
    //        1 => 'B.nombre',
    //        2 => 'A.url',
    //        3 => 'A.activo'
    //         );
    //     $sql = "SELECT DISTINCT
    //                 A.idmenu,
    //                 A.nombre,
    //                 B.nombre as padre,
    //                 A.url,
    //                 A.activo
    //                 FROM sistema_menues A
    //                 LEFT JOIN sistema_menues B ON A.id_padre = B.idmenu
    //             WHERE 1=1
    //             ";

    //     //Realiza el filtrado
    //     if (!empty($request['search']['value'])) { 
    //         $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
    //         $sql.=" OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
    //         $sql.=" OR A.url LIKE '%" . $request['search']['value'] . "%' )";
    //     }
    //     $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

    //     $lstRetorno = DB::select($sql);

    //     return $lstRetorno;
    // }

    public function obtenerTodos() {
        $sql = "SELECT 
                  C.idcurso,
                  C.nombre,
                  C.descripcion,
                  C.precio,
                  C.cupo,
                  C.horario,
                  C.fk_idcategoria
                FROM cursos C ORDER BY C.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    //    public function obtenerMenuPadre() {
    //     $sql = "SELECT DISTINCT
    //               A.idmenu,
    //               A.nombre
    //             FROM sistema_menues A
    //             WHERE A.id_padre = 0 ORDER BY A.nombre";
    //     $lstRetorno = DB::select($sql);
    //     return $lstRetorno;
    // }

    // public function obtenerSubMenu($idmenu=null){
    //     if($idmenu){
    //         $sql = "SELECT DISTINCT
    //                   A.idmenu,
    //                   A.nombre
    //                 FROM sistema_menues A
    //                 WHERE A.idmenu <> '$idmenu' ORDER BY A.nombre";
    //         $resultado = DB::select($sql);
    //     } else {
    //         $resultado = $this->obtenerTodos();
    //     }
    //     return $resultado;
    // }

    public function obtenerPorId($idcurso) {
        $sql = "SELECT
                idcurso,
                nombre,
                descripcion,
                precio,
                cupo,
                horario,
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
            $this->fk_idcategoria = $lstRetorno[0]->categoria;
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
            fk_idcategoria= $this->categoria
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
                fk_idcategoria
            ) VALUES (?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion, 
            $this->precio, 
            $this->cupo, 
            $this->horario,
            $this->categoria
        ]);
       return $this->idcurso = DB::getPdo()->lastInsertId();
    }

    // public function obtenerMenuDelGrupo($idGrupo){
    //     $sql = "SELECT DISTINCT
    //     A.idmenu,
    //     A.nombre,
    //     A.id_padre,
    //     A.orden,
    //     A.url,
    //     A.css
    //     FROM sistema_menues A
    //     INNER JOIN sistema_menu_area B ON A.idmenu = B.fk_idmenu
    //     WHERE A.activo = '1' AND B.fk_idarea = $idGrupo ORDER BY A.orden";
    //     $resultado = DB::select($sql);
    //     return $resultado;
    // }

}
