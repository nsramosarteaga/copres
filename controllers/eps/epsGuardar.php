<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$epsDAO = new EPSDAO($id_conexion,$_SESSION['usr_id']);

$insert = $epsDAO->insertEPS($_POST);

if($insert===true) 
    echo 'OK';
else
    echo $insert;

$conexion->desconectar($id_conexion);
?>