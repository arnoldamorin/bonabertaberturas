@extends('web.plantilla')
@section('titulo', "Sesion Personal")
@section('contenido')

<body>
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">
      <h2 class = "pt-3">Sesión Personal</h2>
    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Section ======= -->
  <section id="coaching" class="coaching">
    <div class="container" data-aos="fade-up">

      <div class="row mt-5">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src=" {{ asset('web/img/diferencia-tu-conferencia.jpg') }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">

          <p class="font-italic text-sm-left text-center" style="line-height: 26px;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet a perferendis labore quaerat eaque provident minus accusantium aperiam laboriosam! Obcaecati ad autem error eveniet cumque voluptates odit aliquam optio amet..</p>

          <div class="col-12 col-12 pl-0">
            <a href="https://api.whatsapp.com/send?phone=" target="_blank" title="Whatsapp" class="get-started-btn ml-0">¡Quiero una sesión con vos!</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Section -->
</body>

</html>

@endsection