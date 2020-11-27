@extends('web.plantilla')

@section('titulo', "Coaching Ejecutivo")

@section('contenido')
<div class="breadcrumbs">
        <div class="container">
          <h2 class="text-center pt-3">Ejecutivo</h2>
        </div>
</div>
<section id="trainers" class="trainers mt-5">
  <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-6">
          <p class="font-italic text-sm-left text-center" style="line-height: 26px;">El coaching ejecutivo es una relación entre un ejecutivo y un coach, con el objetivo de conseguir un cambio en su rendimiento, incorporando un nuevo liderazgo para inspirar a su equipo con un impacto significativo en el logro de las metas. De acuerdo a sus propias necesidades, se inicia un proceso con sesiones individuales para alcanzar su propio resultado superador.</p>
          <div class="col-12 pl-0 text-center">
            <a href="https://api.whatsapp.com/send?phone=" target="_blank" title="Whatsapp" class="get-started-btn ml-0">Agendar Sesión</a>
          </div>
        </div>
        <div class="col-12">
          <img src="" alt="">
        </div>
      </div> 
  </div>
</section>
    
@endsection