@extends('web.plantilla')

@section('titulo', "Cursos")

@section('contenido')

<!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Detalle del curso</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="../web/img/course-details.jpg" class="img-fluid" alt="">
            <h3>{{ $curso->nombre }}</h3>
            <p>
              {{ $curso->descripcion }}
            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Precio</h5>
              <p>$ {{ number_format($curso->precio, 2, ",", ".") }}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Cupo disponible</h5>
              <p>{{ $curso->cupo }}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Horario</h5>
              <p>{{ $curso->horario }}</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Cource Details Section -->

    <!-- ======= Formulario de Compra ======= -->
    <form action="" method = "post">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <input type="text" name = "txtNombreComprador" id = "txtNombreComprador" placeholder = "Nombre y apellido" class = "form-control text-center" required>
          </div>
          <div class="col-12">
            <input class = "form-control text-center mt-2" type="text" name = "txtCorreoComprador" id = "txtCorreoComprador" placeholder = "Correo" required>
          </div>
          <div class="col-12">
            <input class = "form-control text-center mt-2" type="tel" name = "txtTelefonoComprador" id = "txtTelefonoComprador" placeholder = "Teléfono" required >
          </div>
          <div class="col-12 text-center mt-3">
            <a href="#" class = "get-started-btn">Comprar</a>
          </div>
        </div>
      </div>
    </form>

@endsection