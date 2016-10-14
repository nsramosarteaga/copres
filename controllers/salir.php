<?php
include '../config/config.inc';
include_once('seguridad.php');
include_once('../model/System/Conexion.php');
include_once('../model/System/Autenticacion.php');
$conexion = new Conexion();
$id_conexion = $conexion->conectar();
$autenticacion = new Autenticacion($_SESSION['username'],$id_conexion);
$autenticacion->cerrarSesion();
$conexion->desconectar($id_conexion);
header('Location: '.$config['url_aplicacion'].'index.php');
?>