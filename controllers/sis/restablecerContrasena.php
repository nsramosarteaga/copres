<?php
include '../../config/config.inc';
include_once ('../../model/System/Conexion.php');
include_once ('../../model/System/Autenticacion.php');
include_once ('../../model/System/Util.php');

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$autenticacion = new Autenticacion($id_conexion,0);
$util = new Util();

$correo_electronico = (isset($_POST['correo_electronico']))?$_POST['correo_electronico']:NULL;
$vector_usuario_p['usuario'] = $autenticacion->getUsuarioCorreo($correo_electronico);
//var_dump($vector_usuario_p);
if(isset($vector_usuario_p['usuario'][0]['usr_str_username'])){
    $vector_usuario_p = $vector_usuario_p['usuario'][0];
    $vector_usuario_p['usr_str_password'] = $autenticacion->generarPassword(NULL,TRUE);
    //$vector_usuario_p['usr_str_password'] = 'copres';
    //print_r($vector_usuario_p);
   
    if($autenticacion->updateContrasena($vector_usuario_p)){ 
 		   
      require '../../lib/PHPMailer/PHPMailerAutoload.php';
    	$mail = new PHPMailer;
    	$mail->isSMTP();	// Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'nsramosarteaga@gmail.com';                 // SMTP username
		$mail->Password = 'N3st0rS3n3n';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		$mail->Port = 587;
		
		$mail->From = 'info@copres.com';
		$mail->FromName = 'Soporte COPres';
		$mail->addAddress($vector_usuario_p['usr_str_correoElectronico']);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Restablecimiento de contraseña';
		$mail->Body    = 'Cordial saludo '.$vector_usuario_p['usr_str_apellidoUsuario'].' '.$vector_usuario_p['usr_str_nombreUsuario'].',<br/><br/>'
                . 'Su contraseña de acceso se ha restablecido<br/>'
                . 'Sus nuevos datos de acceso son:<br/>'
                . '<b>Usuario:</b> '.$vector_usuario_p['usr_str_username'].'<br/>'
                . '<b>Contraseña:</b> '.$vector_usuario_p['usr_str_password'].'<br/><br/>'
                .'Visite: '.$config['url_aplicacion'].'<br/><br/>Cordialmente,<br/>Soporte COPres';
		$mail->AltBody = 'Cordial saludo '.$vector_usuario_p['usr_str_apellidoUsuario'].' '.$vector_usuario_p['usr_str_nombreUsuario'].',\n\n'
                . 'Su contraseña de acceso se ha restablecido\n'
                . 'Sus nuevos datos de acceso son:<br/>'
                . 'Usuario:'.$vector_usuario_p['usr_str_username'].'\n'
                . 'Contraseña:'.$vector_usuario_p['usr_str_password'].'\n';

		if(!$mail->send()) {
    		echo 'El mensaje con la nueva contraseña no pudo ser enviado.';
    		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
    		echo 'SENT';
		}
		
               
    }else{
        echo "No se pudó asignar una nueva contraseña al usuario.";        
    }
}else{
    echo "No existe usuario relacionado al correo electrónico ".$correo_electronico;
}
$conexion->desconectar($id_conexion);
?>