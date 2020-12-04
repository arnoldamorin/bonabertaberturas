@extends('web.plantilla')
@section('titulo', "Coaching Deportivo")
@section('contenido')


<body>
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2 class = "pt-3">Deportivo</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section id="coaching" class="coaching">
        <div class="container" data-aos="fade-up">

            <div class="row mt-3">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src=" {{ asset('web/img/diferencia-tu-conferencia.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">

                    <p class="font-italic text-sm-left text-center" style="line-height: 26px;">Facilito potenciar a toda la Red Deportiva y que puedan lograr los Resultados que buscan y desean alcanzar, a través de un Proceso transformacional y de posibilidad de acciones. Se entrena desde un aprendizaje integral, para que el deportista haga emerger sus habilidades y capacidades, traduciéndolas en éxitos deportivos.
Se trabaja desde la motivación y el compromiso, estimulando su confianza, su autoestima, su autoaprendizaje, elevando su nivel de conciencia y mejorando sus relaciones intrapersonales e interpersonales en el camino hacia el logro de sus metas.</p>

                    <div class="col-12 text-sm-left text-center pl-0">
                        <a href="https://api.whatsapp.com/send?phone=5493512452331" target="_blank" title="Whatsapp" class="get-started-btn m-0">Agendar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
</body>

</html>

@endsection