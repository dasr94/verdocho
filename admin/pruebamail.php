<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$correo = "ventas@verdocho.com";
$pass = 'W$xo7B8NL%V1';
$host = 'premium131.web-hosting.com';
$puerto = 465;


require("php/phpmailer/class.phpmailer.php");
require("php/phpmailer/class.smtp.php");
$mail = new PHPMailer();

$mail->Mailer = "smtp";
$mail->Host = $host;
$mail->SMTPAuth = true;
$mail->Username = $correo; 
$mail->Password = $pass;
$mail->From = $correo;
$mail->FromName = "Ventas Verdocho";

$mail->AddAddress("dsanchez.atsv@gmail.com"); 
$mail->Subject = "Prueba de phpmailer";
$mail->Body = "<b>Mensaje de prueba mandado con phpmailer en formato html</b>";
$mail->AltBody = "Mensaje de prueba mandado con phpmailer en formato solo texto";
$exito = $mail->Send();

$intentos=1; 
while ((!$exito) && ($intentos < 5)) {
sleep(5);
    echo $mail->ErrorInfo;
    $exito = $mail->Send();
    $intentos=$intentos+1;	
}

if(!$exito) {
 echo "<h1>Problemas enviando correo electrónico a ".$valor."</h1>";
 echo "<br/>".$mail->ErrorInfo;	
}
else {
 echo "Mensaje enviado correctamente";
} 




// mail('dsanchez.atsv@gmail.com','Prueba','Esta es una prueba');
// INSERT INTO usuarios_gestorbase(usuario, pass, estado_gestor_base, nivel, nombre_usuario, tienda) VALUES('ASS04402', 'atsv2018', 0, 2, 'JOSE ROBERTO DOMINGUEZ LINARES', 'Administrador');

?>