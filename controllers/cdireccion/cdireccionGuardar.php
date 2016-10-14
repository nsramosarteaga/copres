<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$cdireccionDAO = new ClasificacionDireccionDAO($id_conexion);

$insert = $cdireccionDAO->insertClasificacionDireccion($_POST);

if($insert===true) 
    echo 'OK';
else
    echo $insert;

$conexion->desconectar($id_conexion);
?>