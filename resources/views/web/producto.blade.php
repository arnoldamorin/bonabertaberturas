<?php
$titulo = "producto";
$title = ucfirst($titulo);
$productos = 3;
?>
@extends("web.plantilla")
@section('titulo', "Producto")
@section("contenido")
<div class="container-fluid mt-4">
    <div class="row mx-0 mb-3">
        <div class="col-12">
            <div class="div-h1 p-2">
                <h1 class="pl-0 mb-0">Puerta Oblak Eterna 1183 Cedro 80x200 cm</h1>
            </div>
        </div>
    </div>
    <div class="row mx-0">
        <div class="col-12 col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide pointer-event" data-ride="carousel">
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < $productos; $i++) {
                        if ($i == 0) { ?>
                            <div class="carousel-item active shadow">
                                <img src="img/producto.png" alt="producto nombre">
                            </div>
                        <?php } else { ?>
                            <div class="carousel-item shadow">
                                <img src="img/producto.png" alt="producto nombre">
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-6 div-comprar text-center my-3">
            <p class="precio">$17,565.99</p>
            <div class="p-md-2 text-md-left">
                <div class="d-flex d-md-inline justify-content-between align-items-center px-2 pb-1 pt-2">
                    <button class="btn px-md-3"><i class="fas fa-minus"></i></button>
                    <p class="d-inline mb-0 px-md-2 px-lg-5">1</p>
                    <button class="btn px-md-3"><i class="fas fa-plus"></i></button>
                </div>
                <div class="d-md-inline px-2 pt-1 pb-2">
                    <button class="btn comprar">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-0 mt-3 mt-md-5">
        <div class="col-12">
            <div class="div-specs p-2">
                <h2 class="pl-0 mb-0">Especificaciones</h2>
            </div>
        </div>
    </div>
    <div class="row mx-0 mb-2">
        <div class="col-12">
            <div class="p-2 div-specs-text">
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse atque numquam similique accusamus placeat. Voluptatibus distinctio, deleniti nam consequuntur suscipit debitis fuga officiis consequatur, accusantium magnam quos, quidem esse quas?</p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse atque numquam similique accusamus placeat. Voluptatibus distinctio, deleniti nam consequuntur suscipit debitis fuga officiis consequatur, accusantium magnam quos, quidem esse quas?</p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse atque numquam similique accusamus placeat. Voluptatibus distinctio, deleniti nam consequuntur suscipit debitis fuga officiis consequatur, accusantium magnam quos, quidem esse quas?</p>
            </div>
        </div>
    </div>
</div>
@endsection