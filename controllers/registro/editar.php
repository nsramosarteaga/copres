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
$array_poblacion = $poblacionDAO->getPoblacion($pob_id);
$poblacion = $array_poblacion[0];

/*
foreach($array_poblacion  as $row){
	$poblacion = $row;
}*/
//print_r($poblacion);

// ajustar campos de fecha
$fecha_tmp = explode("-",$poblacion['pob_dat_fechaNacimiento']);
$poblacion['pob_dat_fechaNacimiento'] = $fecha_tmp[2]."/".$fecha_tmp[1]."/".$fecha_tmp[0];
$fecha_tmp = explode("-",$poblacion['pob_dat_fechaFormulario']);
$poblacion['pob_dat_fechaFormulario'] = $fecha_tmp[2]."/".$fecha_tmp[1]."/".$fecha_tmp[0];

$array_tdo    = $poblacionDAO->getTipoDocumento();
$array_genero = $poblacionDAO->getSexo();

$estadoDAO    = new EstadoDAO($id_conexion);
$array_estado = $estadoDAO->getEstado();

$cpoblacionDAO    = new ClasificacionPoblacionDAO($id_conexion);
$array_cpoblacion = $cpoblacionDAO->getClasificacionPoblacion();

$cdireccionDAO    = new ClasificacionDireccionDAO($id_conexion);
$array_cdireccion = $cdireccionDAO->getClasificacionDireccion();
if(!empty($poblacion['cdi_id'])){
	$cdi_str_nombre = $cdireccionDAO->getClasificacionDireccion($poblacion['cdi_id']);
	$poblacion['cdi_str_nombre'] = $cdi_str_nombre[0]['cdi_str_nombre'];
}else{
	$cdi_str_nombre = NULL;
	$poblacion['cdi_str_nombre'] = '';
}
//print_r($poblacion);

$nivelDAO    = new NivelDAO($id_conexion);
$array_nivel = $nivelDAO->getNivel();

$AreaDAO    = new AreaDAO($id_conexion);
$array_area = $AreaDAO->getArea();

$tnoDAO    = new TipoNovedadDAO($id_conexion);
$array_tno = $tnoDAO->getTipoNovedad();

include '../../views/template/header.php';
include '../../views/registro/editar.php';
include '../../views/template/footer.php';
$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/registro_editar.js"></script>