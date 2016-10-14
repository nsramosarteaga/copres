<?php
//global $config;
include $config['path_aplicacion'].'model/System/Conexion.php';
include $config['path_aplicacion'].'model/System/Autenticacion.php';
//Inicio de Sessión
session_start();
// Comprobrar que el usuario tenga sesión iniciada
if($_SESSION['autenticacion']!='Aceptada')
{
  // Si no existe, se envia a la página de autenticación
  header("Location:".$config['url_aplicacion']."views/login.php");
  // Salir del Presente script
  exit();
}
else
{
  //sino, calculamos el tiempo transcurrido
  $fecha_guardada = $_SESSION['ultimo_acceso'];
  $ahora = time();
  $tiempo_transcurrido = $ahora-$fecha_guardada;
  //comparamos el tiempo transcurrido
  if($tiempo_transcurrido >= 1200) {
    //utilizar 3600 para 1 hora    
    $conexion = new Conexion();
    $id_conexion = $conexion->conectar();
    //var_dump($username);
    $autenticacion = new Autenticacion(0,$id_conexion);
    $autenticacion->cerrarSesion();
    //session_destroy(); // destruyo la sesión
    header("Location:".$config['url_aplicacion']."index.php"); //envío al usuario a la pag. de autenticación
  //sino, actualizo la fecha de la sesión
  }else {
    $_SESSION['ultimo_acceso'] = $ahora;
  }
}
?>