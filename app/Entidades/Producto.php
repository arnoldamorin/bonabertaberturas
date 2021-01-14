<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto','codigo', 'descripcion', 'medidas_externas', 'medidas_internas', 'peso', 'precio_costo', 'precio_venta', 'marca', 'ganancia', 'fk_idcoeficiente', 'fk_idtipo_producto'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idproducto = $request->input('id')!="0" ? $request->input('id') : $this->idproducto;
        $this->codigo = $request->input('txtCodigo');
        $this->descripcion = $request->input('txtDescripcion');
        $this->medidas_externas = $request->input('txtMedidasExternas');
        $this->medidas_internas = $request->input('txtMedidasInternas');
        $this->peso = $request->input('txtPeso');
        $this->precio_costo = $request->input('txtPrecioCosto');
        $this->marca = $request->input('txtMarca');    
        $this->imagen = $request->input('archImagen');          
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'P.codigo',  
           1 => 'P.descripcion',
           2 => 'P.medidas_externas',
           3 => 'P.medidas_internas',
           4 => 'P.peso',
           5 => 'P.precio_costo',
           6 => 'P.precio_venta',
           7 => 'P.marca',          
            );
        $sql = "SELECT DISTINCT
                    P.codigo,
                    P.descripcion,
                    P.medidas_externas,
                    P.medidas_internas,
                    P.peso,
                    P.precio_costo,
                    P.precio_venta,
                    P.marca,                                  
                    FROM productos P
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( P.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR P.precio_costo LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR P.precio_venta LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR P.marca LIKE '%" . $request['search']['value'] . "%' ";  
            $sql.=" OR P.codigo LIKE '%" . $request['search']['value'] . "%' ";                     
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                    P.codigo,
                    P.descripcion,
                    P.medidas_externas,
                    P.medidas_internas,
                    P.peso,
                    P.precio_costo,
                    P.precio_venta,
                    P.marca,    
                    P.imagen,                          
                    TP.idtipo_producto 
                FROM productos P
                INNER JOIN tipo_productos TP ON P.fk_idtipo_producto = TP.idtipo_producto
                ORDER BY P.descripcion";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idproducto) {
        $sql = "SELECT
                P.codigo,
                P.descripcion,
                P.medidas_externas,
                P.medidas_internas,
                P.peso,
                P.precio_costo,
                P.precio_venta,
                P.marca,    
                P.imagen                 
                FROM productos P WHERE P.idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->codigo = $lstRetorno[0]->idcodigo;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->medidas_externas = $lstRetorno[0]->medidas_externas;
            $this->medidas_internas = $lstRetorno[0]->medidas_internas;
            $this->peso = $lstRetorno[0]->peso;
            $this->precio_costo = $lstRetorno[0]->precio_costo;
            $this->precio_venta = $lstRetorno[0]->precio_venta;
            $this->marca = $lstRetorno[0]->marca;
            $this->imagen = $lstRetorno[0]->imagen;            
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE productos SET  
            codigo='$this->codigo',     
            descripcion='$this->descripcion',
            precio_costo=$this->precio_costo,
            medidas_externas= $this->medidas_externas,
            medidas_internas= $this->medidas_internas,
            peso='$this->peso',
            imagen='$this->imagen',
            marca='$this->marca',
            WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idcurso]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM productos WHERE 
            idproducto=?";
        $affected = DB::delete($sql, [$this->idcurso]);
    }

    public function insertar() {
        $sql = "INSERT INTO productos ( 
                codigo,               
                descripcion,
                medidas_externas,
                medidas_internas,
                peso,
                precio_costo,                
                marca,
                fk_idcoeficiente,
                fk_idtipo_producto,
                imagen
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [   
            $this->codigo,        
            $this->descripcion, 
            $this->medidas_externas, 
            $this->medidas_internas, 
            $this->peso,
            $this->precio_costo,
            $this->marca,
            $this->fk_idcoeficiente,
            $this->fk_idtipo_producto
        ]);
       return $this->idproducto = DB::getPdo()->lastInsertId();
    }

}
