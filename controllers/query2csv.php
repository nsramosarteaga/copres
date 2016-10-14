<?php
include '../config/config.inc';
include_once ('../model/System/Conexion.php');
include_once('../local/es_CO.php'); // Idioma

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();


?>	
