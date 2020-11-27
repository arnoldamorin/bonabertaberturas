@extends('web.plantilla')
@section('titulo', "Testimonios")
@section('contenido')

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Testimonios</h2>
        <p class = "font-italic">Agradecida, les presento a quienes han confiado en mí, los verdaderos protagonistas de su propia historia</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">
        <!-- <div class="section-title">
          <p>OPINIONES SOBRE MI TRABAJO</p>
        </div> -->
        
        <h4 class = "text-center mt-1">Testimonios escritos</h4>
        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in" data-aos-delay="100">
          @for ($i = 0; $i < count($aTestimonios); $i++)
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <h3> {{ $aTestimonios[$i]->nombre }}</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  {{ $aTestimonios[$i]->descripcion }}
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>
          @endfor
        </div>

        <h4 class="mb-3 text-center mt-5">Testimonios grabados</h4>
        <div class="row">
          <div class="col">
            <div class="card">
              <h5 class="mt-2 text-center">Titulo</h5>
              <video src="#" width=320  height=240 controls poster="#">
            </div>
          </div>
          <div class="col">
            <div class="card">
              <h5 class="mt-2 text-center">Titulo</h5>
              <video src="#" width=320  height=240 controls poster="#">
            </div>
          </div>
          <div class="col mb-4">
            <div class="card">
              <h5 class="mt-2 text-center">Titulo</h5>
              <video src="#" width=320  height=240 controls poster="#">
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->
@endsection