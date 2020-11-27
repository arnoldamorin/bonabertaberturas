@extends('web.plantilla')

@section('titulo', "Cursos")

@section('contenido')

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="container">
    <h2>Cursos</h2>
    <p class = "font-italic">En la actualidad, es necesario un desarrollo integral de la persona. Para eso, es primordial un aprendizaje continuo en la manera de ser, en las habilidades y potencialidades para lograr impactar en el entorno de manera eficaz. Para ello, es fundamental incorporar nuevas competencias que desde la disciplina del Coaching Ontológico logra aportar nuevas competencias en los diseños conversacionales y la gestión de procesos.</p>
    <p class = "mt-3">¡Inscribite ahora mismo!</p>
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
            <img src="{{ $aCursos[$i]->imagen }}" class="img-fluid text-center" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="/cursos/curso-detalle{{ $aCursos[$i]->idcurso }}">
                  <h4>Comprar curso</h4>
                </a>
                <p class="price">${{ number_format($aCursos[$i]->precio, 2, ",", ".") }}</p>
              </div>
              <h3>{{ $aCursos[$i]->nombre }}</h3>
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