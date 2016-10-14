<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$cdireccionDAO = new ClasificacionDireccionDAO($id_conexion);

$update = $cdireccionDAO->updateClasificacionDireccion($_POST);

if($update===true) 
    echo 'OK';
else
    echo $update;

$conexion->desconectar($id_conexion);
?>