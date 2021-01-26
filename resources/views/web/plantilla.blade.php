<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,minimal-ui" name="viewport">
    <title>@yield('titulo') | {{ env('APP_NAME') }}</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('web/img/holding-hands.png') }}" rel="icon">
    <link href="{{ asset('web/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('web/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/vendor/aos/aos.css') }}" rel="stylesheet">

    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,40;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,40;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css">

  
</head>

<body id=<?php echo " $titulo " ?> class="container px-0 hidden shadow-md">
    <div class="centrado" id="onload">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand-md px-0">
            <button class="navbar-toggler pb-0" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <div class="d-inline">
                    <i class="fa fa-bars" style="font-size: 30px;"></i>
                </div>
                <div class="d-inline">
                    <img src="img/logo.svg" alt="logo aberturas bonabert mobile" srcset="" style="width: 125px; height: auto; margin-bottom: 10px;">
                </div>
            </button>
            <div class="mr-3 iconos-mobile d-md-none">
                <a href="#" target="_self" class="d-md-none mr-2"><i class="fa fa-user" style="font-size: 20px;"></i></a>
                <a href="#" target="_self" class="d-md-none"><i class="fas fa-shopping-cart" style="font-size: 20px;"></i></a>
            </div>
            <div class="row collapse navbar-collapse m-0 m-sm-2 px-0" id="navbarsExampleDefault">
                <div class="col-md-3 d-none d-md-inline">
                    <a href="index.php"><img class="img img-fluid logo" src="img/logo.svg" alt="logo aberturas bonabert"></a>
                </div>
                <div class="col-12 col-md-7 pl-3 pl-sm-1 pl-md-3">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $titulo == "inicio" ? "active" : ""; ?>" href="/">INICIO</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle <?php echo $titulo == "productos" ? "active" : ""; ?>" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRODUCTOS</a>
                            <ul class="dropdown">
                                <div class="dropdown-menu py-0 py-md-3" aria-labelledby="dropdownMenuLink">
                                    <div class="row subitem ml-0 ml-md-2">
                                        <div class="col-12 col-sm-4 px-0 pb-2">
                                            <ol>
                                                <li class="dropdown-item titcate px-3"><a href="/producto">Cielorraso</a></li>
                                                <!--<li class="dropdown-item"><a href="#">Metal</a></li>
                                                    <li class="dropdown-item"><a href="#">Madera</a></li>
                                                    <li class="dropdown-item"><a href="#">Corrediza</a></li>-->
                                            </ol>
                                        </div>
                                        <div class="col-12 col-sm-4 px-0 pb-2">
                                            <ol>
                                                <li class="dropdown-item titcate px-3"><a href="/productos">Herrajes</a></li>
                                                <!--<li class="dropdown-item"><a href="#">Exterior</a></li>
                                                    <li class="dropdown-item"><a href="#">Interior</a></li>-->
                                            </ol>
                                        </div>
                                        <div class="col-12 col-sm-4 px-0 pb-2">
                                            <ol>
                                                <li class="dropdown-item titcate px-3"><a href="#">Piso Flotante</a></li>
                                                <!--<li class="dropdown-item"><a href="#">Adornos</a></li>
                                                    <li class="dropdown-item"><a href="#">Manijas</a></li>-->
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="row subitem ml-0 ml-md-2">
                                        <div class="col-12 col-sm-4 px-0 pb-2">
                                            <ol>
                                                <li class="dropdown-item titcate pb-0 px-3"><a href="#">Puertas</a></li>
                                                <li class="dropdown-item py-0 px-3"><a href="#">- Metal</a></li>
                                                <li class="dropdown-item py-0 px-3"><a href="#">- Madera</a></li>
                                                <li class="dropdown-item py-0 px-3"><a href="#">- Corrediza</a></li>
                                            </ol>
                                        </div>
                                        <div class="col-12 col-sm-4 px-0 pb-2">
                                            <ol class="my-0">
                                                <li class="dropdown-item titcate px-3"><a href="#">Revest. de pared</a></li>
                                                <!--<li class="dropdown-item"><a href="#">Exterior</a></li>
                                                    <li class="dropdown-item"><a href="#">Interior</a></li>-->
                                            </ol>
                                        </div>
                                        <div class="col-12 col-sm-4 px-0">
                                            <ol>
                                                <li class="dropdown-item titcate px-3"><a href="#">Ventanas</a></li>
                                                <!--<li class="dropdown-item"><a href="#">Adornos</a></li>
                                                    <li class="dropdown-item"><a href="#">Manijas</a></li>-->
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $titulo == "empresa" ? "active" : ""; ?>" href="/empresa">LA EMPRESA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $titulo == "contacto" ? "active" : ""; ?>" href="/contacto">CONTACTO</a>
                        </li>
                    </ul>
                </div>
                <div class="col-2 pr-3 text-right d-none d-md-inline">
                    <a href="#" target="_self"><i class="fas fa-shopping-cart icono-carrito"></i></a>
                    <p class="d-inline carrito-nro-items">0</p>
                </div>
            </div>
        </nav>
    </header>

    <main id="main" data-aos="fade-in">
        @yield('contenido')
    </main>

    <!-- ======= Footer ======= -->
    <footer>
        <div class="row py-3 align-items-md-center text-center mx-0">
            <div class="col-12 col-md-3 mb-3 mb-sm-0 text-md-left">
                <a href="index.php"><img class="img img-fluid logo pl-md-4" src="img/logo.svg" alt="logo aberturas bonabert"></a>
            </div>
            <div class="col-12 col-md-9 d-md-flex justify-content-md-around">
                <div class="d-md-inline-block text-md-center mb-2">
                    <i class="fab fa-whatsapp iconos mb-2"></i>
                    <p class="mb-0 d-md-block">+54 9 2323 58-4614</p>
                </div>
                <div class="d-md-inline-block text-md-center mb-2">
                    <i class="fas fa-map-marker-alt iconos mb-2"></i>
                    <p class="mb-0 d-md-block">J. Balleto 1104, Lujan, Buenos Aires</p>
                </div>
                <div class="d-md-inline-block text-md-center">
                    <i class="fas fa-envelope iconos mb-2"></i>
                    <p class="mb-0 d-md-block">aberturasbonabert@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="js/codigo.js"></script>
    <script src="{{ asset('web/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('web/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('web/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('web/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('web/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('web/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/vendor/aos/aos.js') }}"></script>

    <!-- Template Main JS File -->
    
    <script src="{{ asset('web/js/main.js') }}"></script>
    

</body>

</html>