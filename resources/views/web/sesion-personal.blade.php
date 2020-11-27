@extends('web.plantilla')
@section('titulo', "Sesion Personal")
@section('contenido')
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Coaching</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v2.1.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="container">
      <h2>Coaching</h2>
    </div>
  </div><!-- End Breadcrumbs -->

 <!-- ======= Section ======= -->
    <section id="coaching" class="coaching">
      <div class="container" data-aos="fade-up">

        <div class="row mt-5">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src=" {{ asset('web/img/emilce-sobre-mi.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3 class="ml-5 mb-3">Mi nombre es Emilce Charras</h3>
            <p class="font-italic text-sm-left text-center">Hace varios años soy Senior Coach Ontológico Profesional, avalada por la AACOP y la FICOP.</p>

            <div class="row mb-3 ">
              <div class="col-sm-6 col-12 text-sm-left text-center">
                <img src=" {{ asset('web/img/logos/ficop.jpg') }}" style="height: 80px;" alt="">
              </div>
              <div class="col-sm-6 col-12 text-sm-left text-center pl-sm-0 pl-5">
                <img src="{{ asset('web/img/logos/scop.jpg') }}" style="height: 80px;" alt="">
              </div>
            </div>

            <p class="font-italic text-sm-left text-center">Mi pasión es inspirar a las personas a disfrutar la vida, lo que eligen y hacen día a día y creer en la posibilidad de cambios personales para alcanzar resultados extraordinarios, motivándolos a conquistar las oportunidades para su crecimiento y bienestar.</p>

          </div>
        </div>
        <div clas="row">
          <div class="col-12 ml-5">
            <a href="/coaching/sesion-personal" class="get-started-btn">¡Quiero una sesión con vos!</a>
          </div>

        </div>

      </div>
    </section>
    <!-- End About Section -->
</body>

</html>

@endsection