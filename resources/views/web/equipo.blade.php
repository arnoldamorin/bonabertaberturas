@extends('web.plantilla')

@section('titulo', "Coaching De Equipos")

@section('contenido')
<div class="breadcrumbs">
        <div class="container">
          <h2 class="text-center pt-3">Coaching De Equipos</h2>
        </div>
</div>
<section id="trainers" class="trainers mt-3">
  <div class="container" data-aos="fade-up"> 
    <div class="row mt-1">
      <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
        <img src=" {{ asset('web/img/equipo.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
        <p class="font-italic text-sm-left text-center" style="line-height: 26px;">En cada organización, existen diferentes equipos de trabajos. Para alcanzar una coordinación de acciones efectivas, es indispensable capacitar a los equipos con competencias dirigidas a la comunicación y al liderazgo. Un equipo al máximo de sus capacidades, funciona colaborativamente para un fin en común y con un enfoque claro.</p>
        <div class="col-12 text-sm-left text-center pl-0">
          <a href="https://api.whatsapp.com/send?phone=5493512452331" target="_blank" title="Whatsapp" class="get-started-btn mx-0">Agendar entrevista</a>
        </div>
      </div>
    </div>
  </div> 
</section>
    
@endsection