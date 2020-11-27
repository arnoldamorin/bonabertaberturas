@extends('web.plantilla')
@section('titulo', "Contacto")
@section('contenido')
<?php
    include_once("PHPMailer/src/PHPMailer.php");
    include_once("PHPMailer/src/SMTP.php");

$pg = "contacto";

if($_POST){ /* es postback */
    $nombre = $_POST["txtNombre"];
    $correo = $_POST["txtCorreo"];
    //$asunto = $_POST["txtAsunto"];
    $mensaje = $_POST["txtMensaje"];

    if($nombre != "" && $correo != ""){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.dominio.com"; // SMTP a utilizar
        $mail->Username = "info@dominio.com.ar"; // Correo completo a utilizar
        $mail->Password = "aqui va la clave de tu correo";
        $mail->Port = 25;
        $mail->From = "info@dominio.com.ar"; //Desde la cuenta donde enviamos
        $mail->FromName = "Jose Hidalgo";
        $mail->IsHTML(true);
        $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

         //Destinatarios
         $mail->addAddress($correo);
         $mail->addBCC("jhidalgomez@gmail.com"); //Copia oculta
         $mail->Subject = utf8_decode("Contacto página Web");
         $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
         /*if(!$mail->Send()){ //cuando este en el servidor descomentar
             $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
         }*/
         $mail->ClearAllRecipients(); //Borra los destinatarios
 
         //Envía ahora un correo a nosotros con los datos de la persona
         $mail->addAddress("info@dominio.com.ar");
         $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
         $mail->Body = "Te escribio $nombre cuyo correo es $correo, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";
        
         //if($mail->Send()){ /* Si fue enviado correctamente redirecciona */
             header('Location: confirmacion-envio.php');
         //} else {
             $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
         //}    
     } else {
         $msg = "Completa todos los campos";
     }

}




?>






<body>
  <!-- ======= Contact Section ======= -->

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

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:3" data-msg="Por favor ingresa al menos 3 caracteres" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Por favor ingresa un mail valido" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Por favor ingresa al menos 8 caracteres para el Asunto" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor escribe algo para nosotros" placeholder="Mensaje"></textarea>
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
  </body>
@endsection
</html>
   
