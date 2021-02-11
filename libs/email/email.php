<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception; 
include('Mailer/src/PHPMailer.php');
include('Mailer/src/SMTP.php');
include('Mailer/src/Exception.php');
 

$mail = new PHPMailer(true);
try{
 $fromeail     = 'eventos.banquetes.dcache@gmail.com';
 $fromname     = 'sicloud web';
 $host         = 'smtp.gmail.com';
 $port         = '465'; // 465 para (tls  587 ) (ssl 465)
 $SMTPSecure    ='ssl';
 $password     = '@1030607384';
 $emailTo      = 'jhreyes483@misena.edu.co'; // correos de envio
 $sujeto       = 'sujeto';
 $bodyEmail    = '<h1>Hola este es correo de prueba </h1>';
 
 //$mail = new PHPMailer/PHPMailer/PHPMailer();
 $mail->isSMTP();
 $mail->SMTPDebug   = 2;
 $mail->Host        = $host;
 $mail->Port        = $port;
 $mail->SMTPAuth    = true;
 $mail->SMTPSecure  = $fromeail;
 $mail->password    = $password;
 $mail->Username    = 'eventos.banquetes.dcache@gmail.com';
 $mail->msgHTML("Message");
 
 $mail->setFrom($fromeail, $fromname);
 $mail->addAddress($emailTo); // direccion a la que se va a enviar correo
 $mail->isHTML(true);
 $mail->Subject = $sujeto;
 $mail->Body = $bodyEmail;
 
// corregir en la linea 1809 no encuentra la clase SMTP
$mail->SMTPSecure =  $SMTPSecure; // or we ca use TLS
 if(!$mail->send()){
   error_log("No se envio el correo"); die();
 }
 //return true;
 echo 'envio correo'; die();
 
 }catch(Exception $e ){
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
 <form action="enviar.php" method="post">
   <input type="text" name="correo" id="">
   <input type="text" name="asunto" id="">
   <textarea name="mensaje" id="" cols="30" rows="10">
 
   </textarea>
   <input type="submit" value="enviar correoo">
 </form>
 </body>
</html>