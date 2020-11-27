@extends('web.plantilla')
@section('titulo', "Coaching Empresarial")
@section('contenido')

<body>
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2 class = "pt-3">Empresarial</h2>
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

                    <p class="font-italic text-sm-left text-center">Cada Empresa es un escenario único y con necesidades particulares. Están inmersas en un mundo volátil, incierto, complejo y ambiguo. Para ello, es necesario desarrollar y potenciar a los equipos.  El Coach facilita el espacio y las herramientas para detectar cuáles están siendo las debilidades o fortalezas no vistas por los Altos Mandos como por los equipos operarios y diseñar planificaciones eficaces para mejorar su propio rendimiento.</p>

                    <div class="col-12 pl-0">
                        <a href="https://api.whatsapp.com/send?phone=" target="_blank" title="Whatsapp" class="get-started-btn ml-0">Agendar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
</body>

</html>

@endsection