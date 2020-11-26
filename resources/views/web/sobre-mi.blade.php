@extends('web.plantilla')

@section('titulo', "Sobre mí")

@section('contenido')
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sobre mí</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

 <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row mt-5">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="https://www.webretail.com.ar/v2/wp-content/uploads/2020/10/Mujeres-Liderazgo.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3 class="ml-5 mb-3">Mi nombre es Emilce Charras</h3>
            <p class="font-italic text-sm-left text-center">Hace varios años soy Senior Coach ontológico profesional, avalada por la AACOP y la FICOP.</p>

            <div class="row mb-3 ">
              <div class="col-sm-6 col-12 text-sm-left text-center">
                <img src="../web/img/logos/ficop.jpg" style="height: 80px;" alt="">
              </div>
              <div class="col-sm-6 col-12 text-sm-left text-center pl-sm-0 pl-5">
                <img src="../web/img/logos/scop.jpg" style="height: 80px;" alt="">
              </div>
            </div>

            <p class="font-italic text-sm-left text-center">Mi pasión es inspirar a las personas a disfrutar la vida, lo que eligen y hacen día a día y creer en la posibilidad de cambios personales para alcanzar resultados extraordinarios, motivándolos a conquistar las oportunidades para su crecimiento y bienestar.</p>
                      
            <ul>
              <li><i class="icofont-check-circled"></i> Especialista en Coaching Deportivo.</li>
              <li><i class="icofont-check-circled"></i> Postítulo en Coaching Organizacional y Ejecutivo.</li>
              <li><i class="icofont-check-circled"></i> Coach de Equipos en diferentes Clubes como Poeta Lugones - Club Deportivo Atalaya - Club Universitario. </li>              
              <li><i class="icofont-check-circled"></i> Intervenciones específicas en Jugadores de Fútbol Argentinos para el Exterior: Club Atlético Capitalino de México. </li>
              <li><i class="icofont-check-circled"></i> Coaching Individual de Jugadores en diferentes disciplinas como Squash, Voley, Fútbol, Básquet, Handball, Jockey.</li>
              <li><i class="icofont-check-circled"></i> Entrenadora de Profesionales en la Carrera de Coaching Ontológico Profesional Sede Marcos Juárez. </li>
              <li><i class="icofont-check-circled"></i> ECOA Escuela de Coaching Ontológico Americano.</li>
              <li><i class="icofont-check-circled"></i> Coaching Organizacional en Empresas.</li>
              <li><i class="icofont-check-circled"></i> Fundadora y Directora de EC, Emilce Charras Coaching Deportivo.</li>
            </ul>

            <p class ="font-italic text-sm-left text-center"><strong>¿Para qué puedes elegirme como tu Coach?</strong><br>Para ser escuchado y acompañarte a lograr superar lo que te limita a expandirte, a crecer y a vivir tu vida como lo deseás. 
              <br>Para lograr los objetivos profesionales y los de tu equipo.
              <br>Para un nuevo liderazgo intrapersonal e Interpersonal, sea el escenario donde te encuentres.
            </p>

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