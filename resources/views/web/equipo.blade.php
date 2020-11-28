@extends('web.plantilla')

@section('titulo', "Coaching De Equipos")

@section('contenido')
<div class="breadcrumbs">
        <div class="container">
          <h2 class="text-center pt-3">Coaching De Equipos</h2>
        </div>
</div>
<section id="trainers" class="trainers mt-5">
  <div class="container" data-aos="fade-up"> 
    <div class="row">
      <div class="col-sm-6 col">
        <p class="font-italic text-sm-left text-center" style="line-height: 26px;">En cada organización, existen diferentes equipos de trabajos. Para alcanzar una coordinación de acciones efectivas, es indispensable capacitar a los equipos con competencias dirigidas a la comunicación y al liderazgo. Un equipo al máximo de sus capacidades, funciona colaborativamente para un fin en común y con un enfoque claro.</p>
        <div class="col-12 pl-0">
          <a href="https://api.whatsapp.com/send?phone=" target="_blank" title="Whatsapp" class="get-started-btn ml-0">Agendar entrevista</a>
        </div>
      </div>
      <div class="col-6">
        <img src="../img/equipo.jpg" class="img-fluid"alt="">
      </div>
    </div>
  </div> 
</section>
    
@endsection