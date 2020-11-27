@extends('web.plantilla')
@section('titulo', "Coaching Empresarial")
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
      <h2>Empresarial</h2>
    </div>
  </div><!-- End Breadcrumbs -->

 <!-- ======= Section ======= -->
    <section id="coaching" class="coaching">
      <div class="container" data-aos="fade-up">

        <div class="row mt-5">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src=" {{ asset('web/img/diferencia-tu.conferencia.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">

            <p class="font-italic text-sm-left text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet a perferendis labore quaerat eaque provident minus accusantium aperiam laboriosam! Obcaecati ad autem error eveniet cumque voluptates odit aliquam optio amet..</p>

          </div>
        </div>
        <div clas="row">
          <div class="col-12 ml-5 text-left">
            <a href="https://api.whatsapp.com/send?phone=" target="_blank" title="Whatsapp" class="get-started-btn">Agendar sesión</a>
          </div>

        </div>

      </div>
    </section>
    <!-- End Section -->
</body>

</html>

@endsection