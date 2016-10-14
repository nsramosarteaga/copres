<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/PoblacionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$poblacionDAO = new PoblacionDAO($id_conexion,$_SESSION['usr_id']);

//var_dump($_FILES);

//$date = explode("-",$_POST['pob_dat_fechaNacimiento']);
//$_POST['pob_dat_fechaNacimiento'] = $date[2]."-".$date[1]."-".$date[0];
//$date = explode("-",$_POST['pob_dat_fechaFormulario']);
//$_POST['pob_dat_fechaFormulario'] = $date[2]."-".$date[1]."-".$date[0];

$_POST['pob_str_correo'] = strtolower($_POST['pob_str_correo']);

//var_dump($_POST);

$insert = $poblacionDAO->insertPoblacion($_POST);

if($insert===true) 
	echo 'OK';
else
	echo $insert;


$conexion->desconectar($id_conexion);
?>
