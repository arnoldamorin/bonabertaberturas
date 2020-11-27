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

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <h3>Saul Goodman</h3>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <h3>Sara Wilsson</h3>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <h3>Jena Karlis</h3>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <h3>Matt Brandon</h3>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <h3>John Larson</h3>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>
      
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