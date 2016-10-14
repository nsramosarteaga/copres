<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/PoblacionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$poblacionDAO = new PoblacionDAO($id_conexion,$_SESSION['usr_id']);

$eliminar = $poblacionDAO->deletePoblacion($_POST['pob_id']);

if($eliminar===true)
	echo 'OK';
else
	echo $eliminar;

$conexion->desconectar($id_conexion);
?>