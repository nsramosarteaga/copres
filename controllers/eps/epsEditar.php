<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$epsDAO = new EPSDAO($id_conexion,$_SESSION['usr_id']);

$update = $epsDAO->updateEPS($_POST);

if($update===true) 
    echo 'OK';
else
    echo $update;

$conexion->desconectar($id_conexion);
?>