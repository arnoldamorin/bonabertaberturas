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
      
    @for ($i = 0; $i < count($aConferencias); $i++)
        <div class="col-md-6 d-flex align-items-stretch">
          <div class="card">
            <div class="card-img">
              <img src="../web/img/events-1.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">{{ $aConferencias[$i]->nombre }}</a></h5>
              <p class="card-text">{{ $aConferencias[$i]->descripcion }}</p>
            </div>
          </div>
        </div>
       
  </div>
  @endfor
  </div>
</section><!-- End Events Section -->

@endsection