@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script>
    globalId = '<?php echo isset($detalle->iddetalle) && $detalle->iddetalle > 0 ? $detalle->iddetalle : 0; ?>';
    <?php $globalId = isset($detalle->iddetalle) ? $detalle->iddetalle : "0"; 
    $idVenta = $_GET["idVenta"];
    ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/ventas">Detalles</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-save" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    <li class="btn-item"><a title="Eliminar" href="#" class="fas fa-trash-alt" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-reply" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/sistema/menu";
    }
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
    <div id="msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="form-group col-lg-6">
                <label>Id Venta</label>
                <input class="form-control" type="text" id="txtfk_idventa" name="txtfk_idventa" value="{{ $idVenta or '' }}" readonly>
            </div>
            <div class="form-group col-lg-6">
                <label>Tipo producto</label>
                <select id="lstTipoProducto" name="lstTipoProducto" onclick="fBuscarProductos();" class="form-control">
                    <option disabled selected value="">Seleccionar</option>
                    @for ($i = 0; $i < count($array_TipoProducto); $i++) @if (isset($detalle) and $array_TipoProducto[$i]->idtipo_producto ==
                        $detalle->fk_idtipo_producto)
                        <option selected value="{{ $array_TipoProducto[$i]->idtipo_producto}}">{{ $array_TipoProducto[$i]->nombre }}</option>
                        @else
                        <option value="{{ $array_TipoProducto[$i]->idtipo_producto}}">{{ $array_TipoProducto[$i]->nombre }}</option>
                        @endif
                        @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="lstProducto">Codigo Producto:</label>
                <select id="lstProducto" onchange="fBuscarDescrProducto();fBuscarPrecioUnitario();" name="lstProducto" class="form-control">
                    <option selected value="{{$detalle->fk_codproducto or ''}}"></option>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtDescrProducto">Descripcion producto:</label>
                <input autocomplete="off" onkeyup="autocompletar();" onchange="fBuscarCodProducto();" class="form-control" type="text" id="txtDescrProducto" name="txtDescrProducto" list="lista_descr" value="{{$detalle->descrprod or ''}}">
                <datalist id="lista_descr"></datalist>
            </div>
            <div class="form-group col-lg-6">
                <label>Cantidad</label>
                <input class="form-control" type="text" id="txtCantidad" name="txtCantidad" onchange="fCalcularTotal();" value="{{$detalle->cantidad or ''}}">
                <!---->
                <span id="msgStock" class="text-danger" style="display:none;">No hay stock suficiente</span>
            </div>
            <div class="form-group col-lg-6">
                <label>Precio Unitario</label>
                <input class="form-control" type="text" id="txtPrecioUnitario" name="txtPrecioUnitario" readonly value="{{$detalle->preciounitario or ''}}">
                <!---->
            </div>
            <div class="form-group col-lg-6">
                <label>Total</label>
                <input class="form-control" type="text" id="txtTotal" name="txtTotal" value="{{$detalle->total or ''}}" readonly>
            </div>
        </div>
</div>

<table id="grilla" class="display">
    <thead>
        <tr>
            <th>Id Venta</th>
            <th>Tipo Producto</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>Editar</th>
        </tr>
    </thead>
</table>
</form>

<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">¿Deseas eliminar el registro actual?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
            </div>
        </div>
    </div>
</div>
<script>
    
    window.onload = function() {
        var dataTable = $('#grilla').DataTable({        
            "processing": true,
            "serverSide": true,
            "bFilter": true,
            "bInfo": true,
            "bSearchable": true,
            "pageLength": 25,
            "order": [
                [0, "asc"]
            ],        
            "ajax": "{{ route('detalle.cargarGrilla',['id' => $idVenta])}}"       
        })
    };

    $("#form1").validate();

    function guardar() {
        if ($("#form1").valid()) {
            modificado = false;
            form1.submit();
        } else {
            $("#modalGuardar").modal('toggle');
            msgShow("Corrija los errores e intente nuevamente.", "danger");
            return false;
        }
    }

    function eliminar() {
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/eliminar') }}",
            data: {
                id: globalId
            },
            async: true,
            dataType: "json",
            success: function(data) {
                if (data.err = "0") {
                    msgShow("Registro eliminado exitosamente.", "success");
                    $("#btnEnviar").hide();
                    $("#btnEliminar").hide();
                    $('#mdlEliminar').modal('toggle');
                } else {
                    msgShow("Error al eliminar", "success");
                }
            }
        });
    }

    function fBuscarProductos() {
        idtipo_producto = $("#lstTipoProducto option:selected").val();
        if ($("#txtDescrProducto").val() == "") {
            $.ajax({
                type: "GET",
                url: "{{ asset('admin/detalle/buscarProductos') }}",
                data: {
                    id: idtipo_producto
                },
                async: true,
                dataType: "json",
                success: function(respuesta) {
                    let opciones = "<option value='0' disabled selected>Seleccionar</option>";
                    const resultado = respuesta.reduce(function(acumulador, valor) {
                        const {
                            codigo,
                            idproducto
                        } = valor;
                        return acumulador + `<option value="${idproducto}">${codigo}</option>`;
                    }, opciones);
                    $("#lstProducto").empty().append(resultado);

                }
            });
        }
    }

    function fBuscarDescrProducto() {

        idProducto = $("#lstProducto").val();
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarProducto') }}",
            data: {
                id: idProducto
            },
            async: true,
            dataType: "json",
            success: function(respuesta) {
                $("#txtDescrProducto").val(respuesta.descripcion);
            }
        });
    }

    function fBuscarCodProducto() {
        descripcion = $("#txtDescrProducto").val();
        $("#lstProducto").val("");
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarCodProducto') }}",
            data: {
                descripcion: descripcion
            },
            async: true,
            dataType: "json",
            success: function(respuesta) {
                $('#lstProducto').val(respuesta.idproducto);
                $("#txtPrecioUnitario").val(respuesta.precio);
            }
        });
    }

    function fBuscarPrecioUnitario() {
        idProducto = $("#lstProducto").val();
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarProducto') }}",
            data: {
                id: idProducto
            },
            async: true,
            dataType: "json",
            success: function(respuesta) {
                $("#txtPrecioUnitario").val(respuesta.precio);
            }
        });
    }

    function fCalcularTotal() {
        var idProducto = $("#lstProducto").val();
        var cantidad = $("#txtCantidad").val();
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarProducto') }}",
            data: {
                id: idProducto
            },
            async: true,
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.cantidad >= cantidad) {
                    let resultado = respuesta.precio * cantidad;
                    $("#txtTotal").val(resultado);
                    $("#msgStock").hide();
                } else {
                    $("#msgStock").show();
                }
            }
        });
    }

    function autocompletar() {
        var minimo_letras = 0; // minimo letras visibles en el autocompletar
        var palabra = $('#txtDescrProducto').val();
        var tipoProducto = $('#lstTipoProducto').val();
        //Contamos el valor del input mediante una condicional
        if ($('#lstTipoProducto option:selected').val() != "") {
            if (palabra.length >= minimo_letras) {
                $.ajax({
                    url: "{{ asset('admin/detalle/autocompletar') }}",
                    type: 'GET',
                    data: {
                        palabra: palabra,
                        tipoProducto: tipoProducto
                    },
                    async: true,
                    dataType: "json",
                    success: function(respuesta) {
                        //$('#lista_descr').show();
                        let opciones = "<option value='0' disabled selected>Seleccionar</option>";
                        const resultado = respuesta.reduce(function(acumulador, valor) {
                            const {
                                descripcion,
                                idproducto
                            } = valor;
                            return acumulador + `<option value="${descripcion}"></option>`;
                        }, opciones);
                        $("#lista_descr").empty().append(resultado);
                    }
                });
            } else {
                //ocultamos la lista
                $('#lista_descr').hide();
            }
        }
    }
</script>
@endsection