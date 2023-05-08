<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactoController extends Controller
{   
    /*-------------------VISTA PRINCIPAL--------------------*/

    public function index()
    {   
        return view('contacto.contacto');

    }

    /*-------------------ENVIAR CORREO--------------------*/
    protected function send(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>['required', 'email'] ,
            'content'=>'required',
        ]);

        //envio de correo de registro correcto
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                           // 2: debug, 0: sin mensajes de error
            $mail->isSMTP();                                      // usamos SMTP
            $mail->Host = 'smtp.gmail.com';  // servidor de correo SMTP, de gmail por ejemplo
            $mail->SMTPAuth = true;                               // Habilitamos autenticación SMTP
            $mail->Username = 'carolinaaa.0312@gmail.com';                 // SMTP cuenta
            $mail->Password = 'yrzjuexwbxopewvn';                           // SMTP clave
            $mail->SMTPSecure = 'tls';                            // Habilitamos encriptación TLS/SSL
            $mail->Port = 587;                                    // el puerto TCP ( puedes verlo en tu servidor de correo)

            //Recipients
            $mail->addAddress( 'carolinaaa.0312@gmail.com' , 'empresa');     // Add a recipient
            
            //Content
            $mail->isHTML(true);                                  // El mensaje es en HTML
            $mail->Subject = $request->get('name').", quiere ponerse en contacto.";
            $mail->Body    = "<h1>Formulario de contacto</h1>
                                <p><strong>Nombre:</strong> ".$request->get('name')."</p>
                                <p><strong>Correo:</strong> ".$request->get('email')." </p>
                                </br>
                                <p><strong>Mensaje:</strong> ".$request->get('content')." </p>";
            $mail->AltBody = "Formulario de contacto
                                Nombre: ".$request->get('name')."
                                Correo: ".$request->get('email')."
                                Mensaje: ".$request->get('content');
            
            $mail->send();
        
        } catch (Exception $e) {
            }
        return redirect('/contacto')->with('success', 'Correo enviado!');
    }
}
