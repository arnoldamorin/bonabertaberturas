@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($venta->idinscripcion) && $venta->idinscripcion > 0 ? $venta->idinscripcion : 0; ?>';
    <?php $globalId = isset($venta->idinscripcion) ? $venta->idinscripcion : "0"; ?>

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
function fsalir(){
    location.href ="/sistema/menu";
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
        <div id = "msg"></div>
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
                    <label>Fecha: *</label>
                    <input type="date" id="txtFecha" name="txtFecha" class="form-control" required value="{{$venta->fecha or ''}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Curso:</label>
                    <select id="lstCurso" name="lstCurso" class="form-control">
                        @for ($i = 0; $i < count($array_curso); $i++)
                            @if (isset($venta) and $array_curso[$i]->idcurso == $venta->fk_idcurso)
                                <option selected value="{{ $array_curso[$i]->idcurso }}">{{ $array_curso[$i]->nombre }}</option>
                            @else
                                <option value="{{ $array_curso[$i]->idcurso }}">{{ $array_curso[$i]->nombre }}</option>
                            @endif
                        @endfor
                    </select>
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
                    <label>Estado:</label>
                    <select id="lstEstado" name="lstEstado" class="form-control">
                        @for ($i = 0; $i < count($array_estado); $i++)
                            @if (isset($venta) and $array_estado[$i]->idestado == $venta->fk_idestado)
                                <option selected value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}</option>
                            @else
                                @if ($array_estado[$i]->idestado == 1 and !isset($venta))
                                    <option selected value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}</option>
                                @else  
                                    <option value="{{ $array_estado[$i]->idestado }}">{{ $array_estado[$i]->nombre }}</option>
                                @endif    
                            @endif
                        @endfor
                    </select>
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
            data: { id:globalId },
            async: true,
            dataType: "json",
            success: function (data) {
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