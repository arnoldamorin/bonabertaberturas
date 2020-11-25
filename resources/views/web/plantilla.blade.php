<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('titulo') | {{ env('APP_NAME') }}</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('web/img/favicon.png') }}" rel="icon">
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
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="/">Emilce Charras</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class=@if ($seccion == "Inicio") active @endif><a href="/">Inicio</a></li>
          <li class=@if ($seccion == "Sobre Mi") active @endif><a href="/sobre-mi">Sobre Mi</a></li>
          <li class=@if ($seccion == "Cursos") active @endif><a href="/cursos">Cursos</a></li>
          <li class=@if ($seccion == "Conferencias") active @endif><a href="/conferencias">Conferencias</a></li>
          <li class=@if ($seccion == "Testimonios") active @endif><a href="/testimonios">Testimonios</a></li>
          <li class="drop-down"><a href="">Coaching</a>
            <ul>
              <li><a href="/coaching/sesion-personal">Sesión Personal</a></li>
              <li><a href="/coaching/equipo">De Equipos</a></li>
              <li><a href="/coaching/empresarial">Empresarial</a></li>
              <li><a href="/coaching/deportivo">Deportivo</a></li>
              <li><a href="/coaching/ejecutivo">Ejecutivo</a></li>
            </ul>
          </li>
          <li class=@if ($seccion == "Contacto") active @endif><a href="/contacto">Contacto</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="/cursos" class="get-started-btn">Comienza ahora</a>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade-in">
    @yield('contenido')
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Información útil</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022, United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <!-- <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul> -->
          </div>

          <!-- <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div> -->

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <!-- <div class="copyright">
          &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
        </div> -->
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Template diseñada por <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <!-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <!-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a> -->
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
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