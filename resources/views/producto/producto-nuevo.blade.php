@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($producto->idproducto) && $producto->idproducto > 0 ? $producto->idproducto : 0; ?>';
    <?php $globalId = isset($producto->idproducto) ? $producto->idproducto : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/productos">Productos</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/productos/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-save" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-trash-alt" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-reply" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/admin";
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
    <form id="form1" method="POST" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="form-group col-lg-6">
                <label>Código: *</label>
                <input type="text" id="txtCodigo" name="txtCodigo" class="form-control" required value="{{$producto->codigo or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Descripcion: *</label>
                <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" required value="{{$producto->descripcion or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Tipo de Producto:</label>
                <select id="lstTipoProducto" name="lstTipoProducto" class="form-control">
                    <option disabled selected value="">Seleccionar</option>
                    @for ($i = 0; $i < count($array_TipoProductos); $i++) @if (isset($producto) and $array_TipoProductos[$i]->idtipo_producto == $producto->fk_idtipo_producto)
                        <option selected value="{{ $array_TipoProductos[$i]->idtipo_producto }}">{{ $array_TipoProductos[$i]->nombre }}</option>
                        @else
                        <option value="{{ $array_TipoProductos[$i]->idtipo_producto }}">{{ $array_TipoProductos[$i]->nombre }}</option>
                        @endif
                        @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Medidas Externas: *</label>
                <input class="form-control" type="text" name="txtMedidasExternas" id="txtMedidasExternas" required value="{{$producto->medidas_externas or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Medidas Internas: *</label>
                <input class="form-control" type="text" name="txtMedidasInternas" id="txtMedidasInternas" required value="{{$producto->medidas_internas or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Peso: *</label>
                <input class="form-control" type="text" name="txtPeso" id="txtPeso" required value="{{$producto->peso or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Coeficientes:</label>
                <select id="lstTipoProducto" name="lstTipoProducto" class="form-control">
                    <option disabled selected value="">Seleccionar</option>
                    @for ($i = 0; $i < count($array_Coeficientes); $i++) @if (isset($producto) and $array_Coeficientes[$i]->idcoeficiente == $producto->fk_idcoeficiente)
                        <option selected value="{{ $array_Coeficientes[$i]->idcoeficiente }}">{{ $array_Coeficientes[$i]->nombre }}</option>
                        @else
                        <option value="{{ $array_Coeficientes[$i]->idcoeficiente }}">{{ $array_Coeficientes[$i]->nombre }}</option>
                        @endif
                        @endfor
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Precio Base: *</label>
                <input class="form-control" type="number" name="txtBase" id="txtBase" required value="{{$producto->precio_costo or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Marca: *</label>
                <input class="form-control" type="text" name="txtMarca" id="txtMarca" required value="{{$producto->marca or ''}}">
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" name="imagenProducto" id="imagenProducto">
                <img src="/web/img/puertas/{{ $producto->imagen or '' }}" class="img-thumbnail" width="150px">
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
            url: "{{ asset('admin/productos/eliminar') }}",
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
</script>
@endsection