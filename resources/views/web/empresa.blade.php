<?php
    $titulo = "empresa";
    $title = ucfirst($titulo);
?>

@extends("web.plantilla")
@section('titulo', "Empresa")
@section("contenido")

<div class="container-fluid">
    <div class="row my-md-4 mt-4">
        <div class="col-12 col-md-4">
            <div>
                <h1 class="d-inline-block">LA EMPRESA</h2>
            </div>
        </div>
    </div>
</div>
<div class="row align-items-center mr-md-0 mb-md-5 mx-0">
    <div class="col-12 col-md-5 px-0 ml-md-5 text-center">
        <div>
            <img class="img img-fluid" src="img/logo-xl.jpg" alt="logo aberturas bonabert">
        </div>
    </div>
    <div class="col-12 col-md-5 px-4">
        <div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae vel expedita ipsum enim facere, obcaecati nobis nihil totam, debitis adipisci architecto nemo saepe itaque rem harum, quas veniam cupiditate neque!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur aliquam, est hic exercitationem veritatis odio quisquam quia, sint earum quos deleniti vitae libero quam. Saepe quasi totam est quo nobis.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium voluptatum doloribus repellendus ex a ad explicabo? Expedita, hic fugit quos, sequi optio adipisci sit laboriosam enim explicabo, animi perferendis doloremque!</p>
        </div>
    </div>
</div>
<div class="row mx-0">
    <div class="col-12 text-center mb-5">
        <iframe class="shadow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.976105055034!2d-59.106799784237474!3d-34.57947116372358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc87d13964a015%3A0xf0b3c74de64e7d71!2sAberturas%20Bonabert!5e0!3m2!1ses-419!2sar!4v1609981990496!5m2!1ses-419!2sar" width="640" height="480" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</div>
@endsection