@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($detalle->iddetalle) && $detalle->iddetalle > 0 ? $detalle->iddetalle : 0; ?>';
    <?php $globalId = isset($detalle->iddetalle) ? $detalle->iddetalle : "0"; ?>
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
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["Producto"] . '")</script>';
}
?>
<div class="panel-body">
    <div id="msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["Producto"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="form-group col-lg-6">
                <label>Id Venta</label>
                <input class="form-control" type="text" id="txtfk_idventa" name="txtfk_idventa" value="{{$detalle->fk_idventa or '$id'}}" readonly>
            </div>
            <div class="form-group col-lg-6">
                <label>Tipo producto</label>
                <select id="lstTipoProducto" name="lstTipoProducto" onclick="fBuscarProducto();" class="form-control">
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
                <select id="lstProducto" onclick="fBuscarDescrProducto();" name="lstProducto" class="form-control">
                    <option selected value="{{$detalle->idproducto or ''}}"></option>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtDescrProducto">Descripcion producto:</label>
                <input class="form-control" type="text" id="txtDescrProducto" name="txtDescrProducto" value="{{$detalle->descrprod or ''}}" readonly>
            </div>
            <div class="form-group col-lg-6">
                <label>Cantidad</label>
                <input class="form-control" type="text" id="txtCantidad" name="txtCantidad" value="{{$detalle->cantidad or ''}}">
            </div>
        </div>
</div>
</form>
</div>
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

    function fBuscarProducto() {
        idtipo_producto = $("#lstTipoProducto option:selected").val();
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarProducto') }}",
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

    function fBuscarDescrProducto() {
        idproducto = $("#lstProducto option:selected").val();
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/detalle/buscarDescrProducto') }}",
            data: {
                id: idproducto
            },
            async: true,
            dataType: "json",
            success: function(respuesta) {        
                $("#txtDescrProducto").val(respuesta);
            }
        });
    }
</script>
@endsection