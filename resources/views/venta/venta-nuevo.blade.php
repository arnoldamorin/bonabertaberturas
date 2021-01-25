@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($venta->idventa) && $venta->idventa > 0 ? $venta->idventa : 0; ?>';
    <?php $globalId = isset($venta->idventa) ? $venta->idventa : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/ventas">Ventas</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/venta/nueva" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
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
                <label>Fecha: *</label>
                <input type="date" id="txtFecha" name="txtFecha" class="form-control" required value="{{ $venta->fecha or ''}}">
                <!-- LO HICE PARA NO PERDER LA HORA DE LA COMPRA, DE LO CONTRARIO SE COMPLICABA MUCHO PODER GUARDARLA -->
                <input type="time" id="txtHora" name="txtHora" class="form-control d-none" required value="{{ $venta->hora or date('H:i:s')}}">
                <!-- ================================================================================================ -->
            </div>
            <div class="form-group col-lg-6">
                <label>Telefono:</label>
                <input class="form-control" type="tel" id="txtTelefono" name="txtTelefono" value="{{$venta->telefono or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Correo:</label>
                <input class="form-control" type="mail" id="txtCorreo" name="txtCorreo" value="{{$venta->correo or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Nombre del Comprador:</label>
                <input class="form-control" type="text" id="txtNombreComprador" name="txtNombreComprador" value="{{$venta->nombre_comprador or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Apellido del Comprador:</label>
                <input class="form-control" type="text" id="txtApellidoComprador" name="txtApellidoComprador" value="{{$venta->apellido_comprador or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Estado:</label>
                <select id="lstEstado" name="lstEstado" class="form-control">
                    @for ($i = 0; $i < count($array_estado); $i++) @if (isset($venta) and $array_estado[$i]->idestado ==
                        $venta->fk_idestado)
                        <option selected value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}
                        </option>
                        @else
                        @if ($array_estado[$i]->idestado == 1 and !isset($venta))
                        <option selected value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}
                        </option>
                        @else
                        <option value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}</option>
                        @endif
                        @endif
                        @endfor
                </select>
            </div>

        </div>
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Detalle
                    <div class="pull-right">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalDetalle">Agregar</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="grilla_wrapper" class="dataTables_wrapper no-footer">
                        <div id="grilla_processing" class="dataTables_processing" style="display: none;">Processing...
                        </div>
                        <table id="grilla" class="display dataTable no-footer" style="width: 98%;" role="grid" aria-describedby="grilla_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="grilla" rowspan="1" colspan="1" aria-label="TipoProducto: activate to sort column descending" aria-sort="ascending" style="width: 252px;">Tipo Producto</th>                                   
                                    <th class="sorting" tabindex="0" aria-controls="grilla" rowspan="1" colspan="1" aria-label="Producto: activate to sort column ascending" style="width: 398px;">Producto</th>
                                    <th class="sorting" tabindex="0" aria-controls="grilla" rowspan="1" colspan="1" aria-label="Cantidad: activate to sort column ascending" style="width: 398px;">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td valign="top" colspan="4" class="dataTables_empty">No data available in table
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="grilla_info" role="status" aria-live="polite">Showing 0 to 0 of
                            0 entries</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetalleLabel">Detalle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Tipo Producto:</label>                                
                                <select id="lstTipoProducto" name="lstTipoProducto" onchange="fBuscarProducto();" class="form-control">
                                <option disabled selected value="">Seleccionar</option>
                                    @for ($i = 0; $i < count($array_TipoProducto); $i++) @if (isset($detalle) and $array_TipoProducto[$i]->idtipo_producto == $detalle->fk_idtipo_producto)
                                        <option selected value="{{ $array_TipoProducto[$i]->idtipo_producto }}">{{ $array_TipoProducto[$i]->nombre }}</option>
                                        @else
                                        <option value="{{ $array_TipoProducto[$i]->idtipo_producto }}">{{ $array_TipoProducto[$i]->nombre }}</option>
                                        @endif
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">                             
                                <label for="lstroducto">Producto:</label>
                                <select name="lstProducto" id="lstProducto" class="form-control">
                                    <option value="" disabled selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="txtCantidad">Cantidad:</label>
                                <input type="text" name="txtCantidad" id="txtCantidad" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="fAgregarDetalle()">Agregar</button>
                    </div>
                </div>
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
            url: "{{ asset('admin/ventas/eliminar') }}",
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
<script>
var dataTable = $('#grilla').DataTable({
	    "processing": true,
        "serverSide": true,
	    "bFilter": true,
	    "bInfo": true,
	    "bSearchable": true,
        "pageLength": 25,
        "order": [[ 0, "asc" ]],
	    "ajax": "{{ route('ventas.cargarGrilla') }}"
	});
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
                        descripcion,
                        idproducto
                    } = valor;
                    return acumulador + `<option value="${idproducto}">${descripcion}</option>`;
                }, opciones);
                $("#lstProducto").empty().append(resultado);
            }
        });
    }

    function fAgregarDetalle(){
            var grilla = $('#grilla').DataTable();
            grilla.row.add([
                $("#lstTipoProducto option:selected").text() + "<input type='hidden' name='txtTipoProducto[]' value='"+ $("#lstTipoProducto option:selected").val() +"'>",
                $("#lstProducto option:selected").text() + "<input type='hidden' name='txtProducto[]' value='"+ $("#lstProducto option:selected").val() +"'>",                
                $("#txtCantidad").val() + "<input type='hidden' name='txtCantidad[]' value='"+$("#txtCantidad").val()+"'>"
            ]).draw();
            $('#modalDetalle').modal('toggle');
            limpiarFormulario();
        }

        function limpiarFormulario(){
            $("#lstTipoProducto").val("");
            $("#lstProducto").val("");            
            $("#txtCantidad").val("");
        }
</script>
@endsection