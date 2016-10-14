<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$epsDAO    = new EPSDAO($id_conexion,$_SESSION['usr_id']);

//validar q no exista poblacin de esa eps

$eliminar = $epsDAO->deleteEPS($_POST['eps_id']);

if($eliminar===true)
    echo 'OK';
else
    echo $eliminar;

$conexion->desconectar($id_conexion);
?>
