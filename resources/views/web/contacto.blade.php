<?php
$titulo = "contacto";
$title = ucfirst($titulo);
?>

@extends('web.plantilla')
@section('titulo', "Contacto")
@section('contenido')

<div class="container-fluid">
    <div class="row mt-4 mx-0 mb-3">
        <div class="col-4 px-0">
            <div>
                <h1 class="d-inline-block">CONTACTANOS</h1>
            </div>
        </div>
    </div>
    <div class="row mb-5 mx-0">
        <div class="col-12 col-md-4 ml-md-3 ml-md-5 pl-md-0">
            <div class="mb-4">
                <a href="https://www.facebook.com/Casa-de-Aberturas-Bonabert-104308894873966" target="_blank" rel="sponsored">
                    <i class="fab fa-facebook mr-2" alt="Facebook Aberturas Bonabert"></i>
                    <p class="d-inline">Casa de Aberturas Bonabert</p>
                </a>
            </div>
            <div class="mb-4">
                <a href="https://www.instagram.com/aberturas.bonabert/" target="_blank" rel="sponsored">
                    <i class="fab fa-instagram mr-2" alt="Instagram Aberturas Bonabert"></i>
                    <p class="d-inline">@aberturas.bonabert</p>
                </a>
            </div>
            <div class="mb-4">
                <a href="mailto:aberturasbonabert@gmail.com">
                    <i class="fas fa-envelope mr-2" alt="Mail Aberturas Bonabert"></i>
                    <p class="d-inline">aberturasbonabert@gmail.com</p>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-7 text-md-right pr-md-0">
            <form class="form" action="" method="post">
                <div class="pb-4">
                    <input type="text" class="form-control shadow py-2" name="txtNombre" id="txtNombre" placeholder="Nombre y Apellido" required>
                </div>
                <div class="pb-4">
                    <input type="text" class="form-control shadow py-2" name="txtLocalidad" id="txtLocalidad" placeholder="Localidad" required>
                </div>
                <div class="pb-4">
                    <input type="tel" class="form-control shadow py-2" name="txtTelefono" id="txtTelefono" placeholder="Telefono (11 - 12345678)" required>
                </div>
                <div class="pb-4">
                    <input type="text" class="form-control shadow py-2" name="txtAsunto" id="txtAsunto" placeholder="Asunto" required>
                </div>
                <div class="pb-4">
                    <textarea class="form-control shadow py-2" name="txtMensaje" id="txtMensaje" cols="30" rows="10" placeholder="Mensaje..." required></textarea>
                </div>
                <div class="row mx-0">
                    <div class="col-12 text-center px-0">
                        <button class="btn submit shadow" type="submit">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection