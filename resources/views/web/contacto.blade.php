@extends('web.plantilla')
@section('titulo', "Contacto")
@section('contenido')

      <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2 class ="pt-3">Escribime</h2>
        <p class = "font-italic">Si querés conocer más acerca de cómo puedo acompañarte</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
      <!--<div data-aos="fade-up">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div>-->

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <!--<div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>

          </div>-->

          <div class="col-lg-12 mt-5 mt-lg-0">

            <form action="/" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="txtNombre" class="form-control" id="txtNombre" placeholder="Nombre" data-rule="minlen:3" data-msg="Por favor ingresa al menos 3 caracteres" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" data-rule="email" data-msg="Por favor ingresa un mail valido" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="txtAsunto" id="txtAsunto" placeholder="Asunto" data-rule="minlen:4" data-msg="Por favor ingresa al menos 8 caracteres para el Asunto" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="txtMensaje" rows="5" data-rule="required" data-msg="Por favor escribe algo para nosotros" placeholder="Mensaje"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Cargando</div>
                <div class="error-message"></div>
                <div class="sent-message">Tu mensaje ha sido enviado. ¡Muchas gracias!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
@endsection
