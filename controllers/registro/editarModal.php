<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include_once ('../../model/System/Autenticacion.php');
include '../../model/DAO/PoblacionDAO.php';
include '../../model/DAO/EPSDAO.php';
include '../../model/DAO/EstadoDAO.php';
include '../../model/DAO/ClasificacionPoblacionDAO.php';
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../model/DAO/NivelDAO.php';
include '../../model/DAO/AreaDAO.php';
include '../../model/DAO/TipoNovedadDAO.php';
include '../../local/es_CO.php';
$pob_id = (isset($_POST['pob_id'])) ? $_POST['pob_id'] : NULL ;
//var_dump($_POST);
if(is_null($pob_id ))
	exit("El dato no puede ser vacío");

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$autenticacion = new Autenticacion($id_conexion, $_SESSION['usr_id']);

$epsDAO    = new EPSDAO($id_conexion);
$array_eps = $epsDAO->getEPS();


$poblacionDAO = new PoblacionDAO($id_conexion, $_SESSION['usr_id']);

$array_tdo    = $poblacionDAO->getTipoDocumento();
$array_genero = $poblacionDAO->getSexo();

$estadoDAO    = new EstadoDAO($id_conexion);
$array_estado = $estadoDAO->getEstado();

$cpoblacionDAO    = new ClasificacionPoblacionDAO($id_conexion);
$array_cpoblacion = $cpoblacionDAO->getClasificacionPoblacion();

$cdireccionDAO    = new ClasificacionDireccionDAO($id_conexion);
$array_cdireccion = $cdireccionDAO->getClasificacionDireccion();

$nivelDAO    = new NivelDAO($id_conexion);
$array_nivel = $nivelDAO->getNivel();

$AreaDAO    = new AreaDAO($id_conexion);
$array_area = $AreaDAO->getArea();

$tnoDAO    = new TipoNovedadDAO($id_conexion);
$array_tno = $tnoDAO->getTipoNovedad();

$array_poblacion = $poblacionDAO->getPoblacion($pob_id);
// ajustar campos de fecha	
$fecha_tmp = explode("-",$array_poblacion[0]['pob_dat_fechaNacimiento']);
$array_poblacion[0]['pob_dat_fechaNacimiento'] = $fecha_tmp[2]."/".$fecha_tmp[1]."/".$fecha_tmp[0];
$fecha_tmp = explode("-",$array_poblacion[0]['pob_dat_fechaFormulario']);
$array_poblacion[0]['pob_dat_fechaFormulario'] = $fecha_tmp[2]."/".$fecha_tmp[1]."/".$fecha_tmp[0];


if(!empty($array_poblacion[0]['cdi_id'])){
	$cdi_str_nombre = $cdireccionDAO->getClasificacionDireccion($array_poblacion[0]['cdi_id']);
	$array_poblacion[0]['cdi_str_nombre'] = $cdi_str_nombre[0]['cdi_str_nombre'];
}else{
	$cdi_str_nombre = NULL;
	$array_poblacion[0]['cdi_str_nombre'] = '';
}

$array_poblacion[0]['array_eps'] = $array_eps;
$array_poblacion[0]['array_genero'] = $array_genero;
$array_poblacion[0]['array_tdo'] = $array_tdo;
$array_poblacion[0]['array_estado'] = $array_estado;
$array_poblacion[0]['array_cpoblacion'] = $array_cpoblacion;
$array_poblacion[0]['array_cdireccion'] = $array_cdireccion;
$array_poblacion[0]['array_nivel'] = $array_nivel;
$array_poblacion[0]['array_area'] = $array_area;
$array_poblacion[0]['array_tno'] = $array_tno;


if (count($array_poblacion) > 0 && $array_poblacion != false) 
{
	$response[] = array("status" => "OK", "response" => "POBLACION");
	$response[] = $array_poblacion[0];
	
	
}
else 
{
	$response[] = array("status" => "ERROR", "response" => "NO_REGION");
}	

echo json_encode($response);
/*
*/

//include '../../views/template/header.php';
//include '../../views/registro/editar.php';
//include '../../views/template/footer.php';
$conexion->desconectar($id_conexion);
?>