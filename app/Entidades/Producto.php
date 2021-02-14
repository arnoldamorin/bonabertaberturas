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
        'idproducto', 'codigo', 'descripcion', 'fk_idtipo_producto', 'medidas_externas', 'medidas_internas', 'peso', 'precio_costo', 'precio_venta', 'marca', 'ganancia', 'fk_idcoeficiente', 'stock', 'color'
    ];

    protected $hidden = [];

    function cargarDesdeRequest($request)
    {
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->codigo = $request->input('txtCodigo');
        $this->descripcion = $request->input('txtDescripcion');
        $this->fk_idtipo_producto = $request->input('lstTipoProducto');
        $this->medidas_externas = $request->input('txtMedidasExternas');
        $this->medidas_internas = $request->input('txtMedidasInternas');
        $this->peso = $request->input('txtPeso');
        $this->precio_costo = $request->input('txtPrecioCosto');
        $this->marca = $request->input('txtMarca');
        $this->imagen = $request->input('ImagenProducto');
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'P.imagen',
            1 => 'P.codigo',
            2 => 'P.descripcion',
            3 => 'P.medidas_externas',
            4 => 'P.medidas_internas',
            5 => 'P.peso',
            6 => 'P.precio_costo',
            7 => 'P.precio_venta',
            8 => 'P.marca',
            9 => 'P.idproducto'
        );
        $sql = "SELECT DISTINCT
                    P.imagen,
                    P.codigo,
                    P.descripcion,
                    P.fk_idtipo_producto,
                    P.medidas_externas,
                    P.medidas_internas,
                    P.peso,
                    P.precio_costo,
                    P.precio_venta,
                    P.marca,
                    P.idproducto   
                    FROM productos P
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( P.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.precio_costo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.precio_venta LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.marca LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.codigo LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
    public function obtenerFiltradoPalabra($palabra,$tipoProducto)
    {

        $sql = "SELECT DISTINCT                    
                    P.descripcion,                  
                    P.idproducto 
                    FROM productos P
                    WHERE P.descripcion LIKE '%" . $palabra . "%'  and P.fk_idtipo_producto = $tipoProducto;               
                ";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT 
                    P.idproducto,
                    P.codigo,
                    P.descripcion,
                    TP.idtipo_producto, 
                    P.medidas_externas,
                    P.medidas_internas,
                    P.peso,
                    P.precio_costo,
                    P.precio_venta,
                    P.marca,    
                    P.imagen                    
                FROM productos P
                INNER JOIN tipos_productos TP ON P.fk_idtipo_producto = TP.idtipo_producto
                ORDER BY P.descripcion";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerCodigoPorTipo($idTipoProducto)
    {
        $sql = "SELECT 
                    P.codigo, 
                    P.idproducto                                                      
                FROM productos P
                INNER JOIN tipos_productos TP ON P.fk_idtipo_producto = TP.idtipo_producto and $idTipoProducto = TP.idtipo_producto
                ORDER BY P.codigo";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerDescr($id)
    {
        $sql = "SELECT 
                    P.descripcion                                                                         
                FROM productos P
                WHERE P.idproducto = $id";
        $resultado = DB::select($sql);
        $fila = $resultado->fetch_assoc();
        return $fila["descripcion"];
    }
    public function obtenerPorDescr($descripcion)
    {
        $sql = "SELECT
                P.idproducto,
                P.codigo,
                P.precio_venta,
                P.stock   
                FROM productos P 
                WHERE P.descripcion = '$descripcion'";
       $lstRetorno = DB::select($sql);

       if (count($lstRetorno) > 0) {
           $this->idproducto = $lstRetorno[0]->idproducto;
           $this->codigo = $lstRetorno[0]->codigo;                      
           $this->precio_venta = $lstRetorno[0]->precio_venta;
           $this->stock = $lstRetorno[0]->stock;
           return $this;
       }
       return null;     
    }


    public function obtenerPorId($idproducto)
    {
        $sql = "SELECT
                P.idproducto,
                P.codigo,
                P.descripcion,
                P.fk_idtipo_producto,
                P.medidas_externas,
                P.medidas_internas,
                P.peso,
                P.precio_costo,
                P.precio_venta,
                P.marca,    
                P.imagen,
                P.stock                 
                FROM productos P WHERE P.idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->codigo = $lstRetorno[0]->codigo;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->fk_idtipo_producto = $lstRetorno[0]->fk_idtipo_producto;
            $this->medidas_externas = $lstRetorno[0]->medidas_externas;
            $this->medidas_internas = $lstRetorno[0]->medidas_internas;
            $this->peso = $lstRetorno[0]->peso;
            $this->precio_costo = $lstRetorno[0]->precio_costo;
            $this->precio_venta = $lstRetorno[0]->precio_venta;
            $this->marca = $lstRetorno[0]->marca;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->stock = $lstRetorno[0]->stock;
            return $this;
        }
        return null;
    }
    

    public function guardar()
    {
        $sql = "UPDATE productos SET  
            codigo='$this->codigo',     
            descripcion='$this->descripcion',
            fk_idtipo_producto='$this->fk_idtipo_producto',
            precio_costo=$this->precio_costo,
            medidas_externas= $this->medidas_externas,
            medidas_internas= $this->medidas_internas,
            peso='$this->peso',
            imagen='$this->imagen',
            marca='$this->marca'
            WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idproducto]);
    }

    public  function eliminar()
    {
        $sql = "DELETE FROM productos WHERE 
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos ( 
                codigo,               
                descripcion,
                fk_idtipo_producto,
                medidas_externas,
                medidas_internas,
                peso,
                precio_costo,                
                marca,             
                imagen
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->codigo,
            $this->descripcion,
            $this->fk_idtipo_producto,
            $this->medidas_externas,
            $this->medidas_internas,
            $this->peso,
            $this->precio_costo,
            $this->marca,
            $this->imagen
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }
}
