<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;



require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller{
    public function index(){
        $seccion = "Contacto";
        return view('web.contacto', compact('seccion'));
    }

    public function enviarCorreo(Request $request){
        $nombre = $request->input("txtNombre");
        $asunto = $request->input("txtAsunto");
        $email = $request->input("txtEmail");
        $mensaje = $request->input("txtMensaje");

        if($nombre != "" && $email != ""){
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "mail.dominio.com"; // SMTP a utilizar
            $mail->Username = "info@emilcecharras.com.ar"; // Correo completo a utilizar
            $mail->Password = "emilcecharras@gmail.com";
            $mail->Port = 25;
            $mail->From = "info@emilcecharras.com.ar"; //Desde la cuenta donde enviamos
            $mail->FromName = "Emilce Charras";
            $mail->IsHTML(true);
            $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
    
             //Destinatarios
             $mail->addAddress($email);
             $mail->addBCC("emilcecharras@gmail.com"); //Copia oculta
             $mail->Subject = utf8_decode("Contacto página Web");
             $mail->Body = "Recibi tu consulta, te respondere a la brevedad.";
             /*if(!$mail->Send()){ //cuando este en el servidor descomentar
                 $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
             }*/
             $mail->ClearAllRecipients(); //Borra los destinatarios
     
             //Envía ahora un correo a nosotros con los datos de la persona
             $mail->addAddress("emilcecharras@gmail.com");
             $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
             $mail->Body = "Te escribio $nombre cuyo correo es $email, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";
            
             //if($mail->Send()){ /* Si fue enviado correctamente redirecciona */
                 return view("web.contacto-exitoso");
             //} else {
                 $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
             //}    
         } else {
             $msg = "Completa todos los campos";
         }
    }

}
