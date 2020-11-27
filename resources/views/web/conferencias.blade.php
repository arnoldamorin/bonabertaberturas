@extends('web.plantilla')
@section('titulo', "Conferencias")

@section('contenido')
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs" data-aos="fade-in">
  <div class="container">
    <h2>Conferencias</h2>
    <p class = "font-italic">Cada espacio compartido con ustedes, es un momento maravilloso. Mi misión, es lograr transmitirles mi pasión, que es comunicar a través de la palabra, aquello que pueda ser una semilla para el mundo. Para vivir una vida plena y en bienestar </p>
  </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Events Section ======= -->
<section id="events" class="events">
  <div class="container" data-aos="fade-up">

    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card">
          <div class="card-img">
            <img src="../web/img/events-1.jpg" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title"><a href="">Conferencia 1</a></h5>
            <p class="font-italic text-center">Sunday, September 26th at 7:00 pm</p>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card">
          <div class="card-img">
            <img src="../web/img/events-2.jpg" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title"><a href="">Conferencia 2</a></h5>
            <p class="font-italic text-center">Sunday, November 15th at 7:00 pm</p>
            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card">
          <div class="card-img">
            <img src="../web/img/events-3.jpg" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title"><a href="">Conferencia 3</a></h5>
            <p class="font-italic text-center">Sunday, September 26th at 7:00 pm</p>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
</section><!-- End Events Section -->

@endsection