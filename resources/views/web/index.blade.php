<?php
$titulo = "inicio";
$title = ucfirst($titulo);
$productos = 10;
?>

@extends("web.plantilla")
@section('titulo', "Inicio")
@section("contenido")
<div class="row mb-4 mx-0">
  <div class="col-12 text-center px-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner justify-content-between">
        <div class="carousel-item active">
          <img src="img/banner.png" alt="banner aberturas bonabert">
        </div>
        <div class="carousel-item">
          <img src="img/banner.png" alt="banner aberturas bonabert">
        </div>
        <div class="carousel-item">
          <img src="img/banner.png" alt="banner aberturas bonabert">
        </div>
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
</div>
<div class="destacados">
  <div class="row mb-4 mx-0">
    <div class="col-12 col-md-6 px-0">
      <div>
        <h2 class="d-inline-block my-0">PRODUCTOS DESTACADOS</h2>
      </div>
    </div>
  </div>
  <div class="row justify-content-between mx-0">
    <div class="col-12 div-card px-0 d-none d-sm-none d-md-inline">
      <div id="carouselExampleIndicators1" class="carousel slide pb-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <?php for ($i = 0; $i < 5; $i++) { ?>
              <div class="card mb-4">
                <a href="producto.php">
                  <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                  <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                </a>
                <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
              </div>
            <?php } ?>
          </div>
          <div class="carousel-item">
            <?php for ($i = 5; $i < $productos; $i++) { ?>
              <div class="card mb-4">
                <a href="producto.php">
                  <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                  <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                </a>
                <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
              </div>
            <?php } ?>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
      </div>
    </div>
    <div class="col-12 div-card px-0 d-md-none">
      <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php for ($i = 0; $i < $productos; $i++) {
            if ($i == 0) { ?>
              <div class="carousel-item active">
                <div class="card mb-4">
                  <a href="producto.php">
                    <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                    <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                  </a>
                  <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                  <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                </div>
              </div>
            <?php } else { ?>
              <div class="carousel-item">
                <div class="card mb-4">
                  <a href="producto.php">
                    <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                    <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                  </a>
                  <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                  <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
        <ol class="carousel-indicators d-none d-md-inline">
          <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="nuevos">
  <div class="row mb-4 mx-0">
    <div class="col-12 col-md-6 px-0">
      <div>
        <h2 class="d-inline-block my-0">ULTIMOS INGRESOS</h2>
      </div>
    </div>
  </div>
  <div class="row justify-content-between mx-0">
    <div class="col-12 div-card px-0 d-none d-sm-none d-md-inline">
      <div id="carouselExampleIndicators2" class="carousel slide pb-4" data-ride="carousel">

        <div class="carousel-inner">
          <div class="carousel-item active">
            <?php for ($i = 0; $i < 5; $i++) { ?>
              <div class="card mb-4">
                <a href="producto.php">
                  <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                  <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                </a>
                <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
              </div>
            <?php } ?>
          </div>
          <div class="carousel-item">
            <?php for ($i = 5; $i < 10; $i++) { ?>
              <div class="card mb-4">
                <a href="producto.php">
                  <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                  <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                </a>
                <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
              </div>
            <?php } ?>
          </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
        </ol>
      </div>
    </div>
    <div class="col-12 div-card px-0 d-md-none">
      <div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php for ($i = 0; $i < $productos; $i++) {
            if ($i == 0) { ?>
              <div class="carousel-item active">
                <div class="card mb-4">
                  <a href="producto.php">
                    <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                    <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                  </a>
                  <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                  <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                </div>
              </div>
            <?php } else { ?>
              <div class="carousel-item">
                <div class="card mb-4">
                  <a href="producto.php">
                    <img class="img img-fluid" src="img/producto-3.png" alt="Puerta Pavir Negra">
                    <p class="text-center my-0 py-2">Puerta Pavir Negra</p>
                  </a>
                  <p class="text-center my-0 pb-2 precio">$17,999.00</p>
                  <button class="btn">COMPRAR <i class="fas fa-shopping-cart"></i></button>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
        <ol class="carousel-indicators d-none d-md-inline">
          <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
        </ol>
      </div>
    </div>

  </div>
  @endsection