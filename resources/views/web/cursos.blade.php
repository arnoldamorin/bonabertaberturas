@extends('web.plantilla')

@section('titulo', "Cursos")

@section('contenido')

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="container">
    <h2>Cursos</h2>
    <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab officiis, facilis ad quas laudantium quae praesentium accusantium, doloremque corrupti in tempore! Eaque saepe non nihil veritatis nisi fuga quidem minima!</p>
  </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Courses Section ======= -->
<section id="courses" class="courses">
  <div class="container" data-aos="fade-up">

    <div class="row" data-aos="zoom-in" data-aos-delay="100">
      
      @for ($i = 0; $i < count($aCursos); $i++)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-3">
          <!-- Course Item -->
          <div class="course-item">
            <img src="../web/img/course-1.jpg" class="img-fluid text-center" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="">
                  <h4>Comprar curso</h4>
                </a>
                <p class="price">${{ number_format($aCursos[$i]->precio, 2, ",", ".") }}</p>
              </div>
              <h3><a href="course-details.html">{{ $aCursos[$i]->nombre }}</a></h3>
              <p>{{ $aCursos[$i]->descripcion }}</p>
              <p><strong>Horario:</strong> {{ $aCursos[$i]->horario }}<br>
                <strong>Modalidad:</strong> {{ $aCursos[$i]->categoria }}</p>
            </div>
          </div>
        </div> <!-- End Course Item-->
      @endfor

    </div>

  </div>
</section><!-- End Courses Section -->

@endsection