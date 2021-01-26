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
        <div class="col-12 col-md-8 px-0">
            <p class="mb-0 mr-2 d-inline"><i class="fas fa-arrow-circle-right mr-1"></i>Categoria</p>
            <p class="mb-0 mr-2 d-inline"><i class="fas fa-arrow-circle-right mr-1"></i>Subcategoria [breadcumb]</p>
        </div>
        <div class="col-6 col-md-4 text-right d-none d-md-inline px-0">
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
                        <label class="d-block lblCategoria pl-2 py-1">Categoria</label>
                        <input type="checkbox" name="chkCategoria" id="chkCategoria" value="" class="mx-2">
                        <p class="d-inline">Categoria 1</p><br>
                        <input type="checkbox" name="chkCategoria" id="chkCategoria" value="" class="mx-2">
                        <p class="d-inline">Categoria 2</p><br>
                    </div>
                    <div class="col-12 px-0 div__subcategoria my-2 pb-2 shadow">
                        <label class="d-block lblSubcategoria pl-2 py-1">Subcategoria</label>
                        <input type="checkbox" name="chkSubcategoria" id="chkSubcategoria" value="" class="mx-2">
                        <p class="d-inline">Subcategoria 1</p><br>
                        <input type="checkbox" name="chkSubcategoria" id="chkSubcategoria" value="" class="mx-2">
                        <p class="d-inline">Subcategoria 2</p><br>
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
        <div class="col-12 col-md-9 col-lg-10">
            <div class="row mx-0 px-0 text-center">
                <?php for ($i = 0; $i < $productos; $i++) { ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card mb-4">
                            <a href="producto.php" target="_blank" rel="sponsored">
                                <img src="img/producto-3.png" class="img img-fluid" alt="producto">
                                <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                            </a>
                            <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                            <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@endsection