<?php
$titulo = "productos";
$title = ucfirst($titulo);
$productos = 16;
?>
@extends("web.plantilla")
@section('titulo', "Productos")
@section("contenido")

<div class="container mt-3 mt-sm-4 mx-md-0 px-0">
    <div class="row filtro-top px-2 py-2 mb-4 mx-3 mx-md-4">
        <div class="col-12 col-md-7 px-0">
            <p class="mb-0 mr-2 d-inline"><i class="fas fa-arrow-circle-right mr-1"></i>Categoria</p>
            <p class="mb-0 mr-2 d-inline"><i class="fas fa-arrow-circle-right mr-1"></i>Subcategoria [breadcumb]</p>
        </div>
        <div class="col-6 col-md-5 text-right d-none d-md-inline px-0">
            <label class="m-0 mr-2 mr-md-3">Cantidad de productos:<span id="cant-productos"></span></label>
            <select name="lstOrden" id="lstOrden">
                <option value="1">Menor Precio</option>
                <option value="2">Mayor Precio</option>
                <option value="3">Nombre A - Z</option>
                <option value="4">Nombre Z - A</option>
                <option value="5">Disponibilidad</option>
            </select>
        </div>
    </div>
    <div class="row mx-0 px-0">
        <div class="col-12 col-md-3 col-lg-2 navbar-expand-md text-center px-0 pb-3">
            <div class="div__filtros py-2 py-md-0 mx-3 mx-md-0">
                <button class="navbar-toggler pb-0" type="button" data-toggle="collapse" data-target="#navbarsFiltros" aria-controls="navbarsFiltros" aria-expanded="false" aria-label="Toggle navigation">
                    <p class="mb-0">FILTRAR</p>
                </button>
            </div>
            <div class="collapse navbar-collapse text-left mx-3 mx-md-0" id="navbarsFiltros">
                <div class="row mx-0 ml-md-4 mt-3 mt-md-0">
                    <div class="col-12 px-0 div__categoria mb-2 pb-2 shadow">
                        <label class="d-block lblCategoria pl-2 py-1">Medidas</label>
                        @if (isset($aMedidas))
                            <?php $i = 0; ?>
                            @foreach ($aMedidas as $medida)
                                <input type="checkbox" name="chkMedidas" id="chkMedida_{{ $i }}" value="{{ $medida->medidas_internas }}" class="mx-2" onclick="setFiltro(this);">
                                <p class="d-inline">{{ $medida->medidas_internas }}</p><br>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                        <!-- <input type="checkbox" name="chkMedidas" id="chkMedida1" value="90 x 200" class="mx-2">
                        <p class="d-inline">90 x 200</p><br>
                        <input type="checkbox" name="chkMedidas" id="chkMedida2" value="" class="mx-2">
                        <p class="d-inline">Categoria 2</p><br> -->
                    </div>
                    <div class="col-12 px-0 div__subcategoria my-2 pb-2 shadow">
                        <label class="d-block lblSubcategoria pl-2 py-1">Rango de precios</label>
                        <div class="row justify-content-between mx-0">
                            <div class="col-6 pr-1">
                                <input type="text" class="form-control" id="txtPrecioMin" value="" onkeyup="controlarPrecio(this);" placeholder="Mínimo">
                            </div>
                            <div class="col-6 pl-1">
                                <input type="text" class="form-control" id="txtPrecioMax" value="" onkeyup="controlarPrecio(this);" placeholder="Máximo">
                            </div>
                            <div class="col-12 text-right">
                                <i class="fas fa-chevron-circle-right" style="cursor: pointer;" onclick="aplicarFiltroPrecio($('#txtPrecioMin').val(), $('#txtPrecioMax').val());"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 div__material my-2 pb-2 shadow">
                        <label class="d-block lblMaterial pl-2 py-1">Material</label>
                        <input type="checkbox" name="chkMaterial" id="chkMaterial" value="" class="mx-2">
                        <p class="d-inline">Material 1</p><br>
                        <input type="checkbox" name="chkMaterial" id="chkMaterial" value="" class="mx-2">
                        <p class="d-inline">Material 2</p><br>
                    </div>
                </div>
            </div>
        </div>
        <div id="div-msg" class="row" style="display: none;">
            <div class="col-12">
                <div id="msg" class="alert alert-danger">
                </div>
            </div>
        </div>
        <div id="spinner" class="col-12 col-md-9 col-lg-10 align-self-center">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="spinner-border p-3" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <div id="div-productos" class="row mx-0 px-0 text-center">
            </div>
        </div>
    </div>
</div>
<script>

    var aMedidasFiltro = [];
    var precioMin = <?php echo $precioMin; ?>;
    var precioMax = <?php echo $precioMax; ?>;

    function controlarPrecio(precio) {
        //comprueba que sea un valor numerico
        if (isNaN(precio.value)) {
            //comprueba que no se incluyan comas
            precio.value = precio.value.slice(0, precio.value.length - 1);
        }
    }

    function aplicarFiltroPrecio(precioMinFiltro, precioMaxFiltro) {
        let divProductos = document.getElementById('div-productos');
        while (divProductos.firstChild) {
            divProductos.removeChild(divProductos.firstChild);
        }
        
        $('#spinner').show();

        if (precioMinFiltro != '' || precioMaxFiltro != '') {
            precioMin = precioMinFiltro;
            precioMax = precioMaxFiltro;
            obtenerProductos('/productos/filtro/');
        } else {
            if (aMedidasFiltro.length > 0) {
                precioMin = <?php echo $precioMin; ?>;
                precioMax = <?php echo $precioMax; ?>;
                obtenerProductos('/productos/filtro/');
            } else {
                obtenerProductos('/productos/obtenerTodos/');
            }
        }
    }

    $(document).ready(function () {
        $('#spinner').show();
        obtenerProductos('/productos/obtenerTodos/');
    });

    function setFiltro(filtro) {
        if (!filtro.checked) {
            aMedidasFiltro.forEach(function(valor, index) {
                if (valor.idFiltro == filtro.id) {
                    aMedidasFiltro.splice(index, 1);
                }
            });
        } else {
            aMedidasFiltro.push({filtro: filtro.value, idFiltro: filtro.id});
        }

        let divProductos = document.getElementById('div-productos');
        while (divProductos.firstChild) {
            divProductos.removeChild(divProductos.firstChild);
        }

        $('#spinner').show();

        if (aMedidasFiltro.length) {
            url = '/productos/filtro/';
        } else {
            if ($('#txtPrecioMin').val() != '' || $('#txtPrecioMax').val() != '') {
                precioMin = $('#txtPrecioMin').val();
                precioMax = $('#txtPrecioMax').val();
                url = '/productos/filtro/';
            } else {
                url = '/productos/obtenerTodos/';
            }
        }

        obtenerProductos(url);
    }

    function obtenerProductos(url) {
        $('#div-msg').hide();
        $('input[type=checkbox]').each(function() {
            this.setAttribute('disabled', 'true');
        });
        let divProductos = document.getElementById('div-productos');
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: url,
            async: true,
            data: {
                filtro: aMedidasFiltro,
                precioMin: precioMin,
                precioMax: precioMax
            },
            success: function(data) {
                if (data.error == 0) {
                    $('#spinner').hide();
                    document.getElementById('cant-productos').innerText = ' ' + data.productos.length;
                    data.productos.forEach(function(valor) {
                        let col = document.createElement('div');
                        col.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3');

                        let card = document.createElement('div');
                        card.classList.add('card', 'mb-4');

                        let linkProducto = document.createElement('a');
                        
                        let imgProducto = document.createElement('img');
                        imgProducto.classList.add('img', 'img-fluid');

                        if (valor.imagen != '') {
                            imgProducto.src = 'web/img/puertas/' + valor.imagen;
                        } else {
                            imgProducto.src = 'img/producto-3.png';
                        }

                        imgProducto.alt = 'producto';

                        let descrProducto = document.createElement('p');
                        descrProducto.classList.add('text-center', 'my-0', 'py-2');
                        descrProducto.innerHTML = valor.descripcion;

                        linkProducto.appendChild(imgProducto);
                        linkProducto.appendChild(descrProducto);

                        linkProducto.href = 'producto.php';
                        linkProducto.target = '_blank';

                        let precio = document.createElement('p');
                        precio.classList.add('text-center', 'my-0', 'pb-2', 'precio');
                        precio.innerHTML = Intl.NumberFormat('es-AR', {style: 'currency', currency: 'ARS'}).format(valor.precio_venta);

                        let botonCompra = document.createElement('button');
                        botonCompra.classList.add('btn');
                        botonCompra.innerHTML = 'COMPRAR ';

                        let iconoCarrito = document.createElement('i');
                        iconoCarrito.classList.add('fas', 'fa-shopping-cart');

                        botonCompra.appendChild(iconoCarrito);

                        card.appendChild(linkProducto);
                        card.appendChild(precio);
                        card.appendChild(botonCompra);

                        col.appendChild(card);

                        divProductos.appendChild(col);
                    });
                } else {
                    document.getElementById('cant-productos').innerText = ' ' + 0;
                    if (data.mensaje != '') {
                        $('#spinner').hide();
                        $('#div-msg').show();
                        let msg = document.getElementById('msg');
                        msg.innerHTML = data.mensaje;
                    }
                }
                $('input[type=checkbox]').each(function() {
                    this.removeAttribute('disabled');
                });
            }
        });
    }

</script>
@endsection