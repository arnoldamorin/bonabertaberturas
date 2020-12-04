@extends('web.plantilla')

@section('titulo', "Coaching Ejecutivo")

@section('contenido')
<div class="breadcrumbs">
        <div class="container">
          <h2 class="text-center pt-3">Ejecutivo</h2>
        </div>
</div>
<section id="trainers" class="trainers mt-3">
  <div class="container" data-aos="fade-up">
      <div class="row mt-1">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src=" {{ asset('web/img/ejecutivo.jpg') }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <p class="font-italic text-sm-left text-center" style="line-height: 26px;">El coaching ejecutivo es una relación entre un ejecutivo y un coach, con el objetivo de conseguir un cambio en su rendimiento, incorporando un nuevo liderazgo para inspirar a su equipo con un impacto significativo en el logro de las metas. De acuerdo a sus propias necesidades, se inicia un proceso con sesiones individuales para alcanzar su propio resultado superador.</p>
          <div class="col-12 text-sm-left text-center pl-0">
            <a href="https://api.whatsapp.com/send?phone=5493512452331" target="_blank" title="Whatsapp" class="get-started-btn m-0">Agendar Sesión</a>
          </div>
        </div>
        
      </div> 
  </div>
</section>
    
@endsection