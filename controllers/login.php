<?php
include_once('../model/System/Conexion.php');
include_once('../model/System/Autenticacion.php');

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$autenticacion = new Autenticacion($id_conexion,0);
$username = (isset($_POST['username']))?$_POST['username']:NULL;
$password = (isset($_POST['password']))?$_POST['password']:NULL;


if($autenticacion->autenticacionExitosa($username,$password))
    echo 'Aceptada';
else
    echo 'Datos de ingreso incorrectos.';

$conexion->desconectar($id_conexion);
?>  	