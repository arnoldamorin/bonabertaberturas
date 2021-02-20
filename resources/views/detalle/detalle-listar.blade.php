@extends('plantilla')

@section('titulo', "Listado de Detalle")

@section('scripts')
<script>
    globalId = '<?php
    echo isset($detalle->fk_idventa) && $detalle->fk_idventa > 0 ? $detalle->fk_idventa : 0; ?>';
    <?php $globalId = isset($detalle->fk_idventa) ? $detalle->fk_idventa : "0"; 
    ?>
</script>
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
    <li class="breadcrumb-item active">Listado</a></li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/detalle/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Recargar" href="#" class="fas fa-redo-alt" aria-hidden="true" onclick='window.location.replace("/admin/detalles");'><span>Recargar</span></a></li>
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-reply" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir(){
    location.href ="/admin";
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
        </tr>
    </thead>
</table> 
<script>
    var id = globalId;
	var dataTable = $('#grilla').DataTable({
	    "processing": true,
        "serverSide": true,
	    "bFilter": true,
	    "bInfo": true,
	    "bSearchable": true,
        "pageLength": 25,
        "order": [[ 0, "asc" ]],
	    "ajax": "{{ route('detalle.cargarGrilla') }}" + id
    });
</script>
@endsection