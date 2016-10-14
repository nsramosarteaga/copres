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

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

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

include '../../views/template/header.php';
include '../../views/registro/dep_interna.php';
include '../../views/template/footer.php';
$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script>
var criterios = [];
<?php 
foreach ($criterios_internos as $llave => $valor)
{
	echo "criterios['".$llave."'] = '".$valor."';";
}
?>
</script>


<script src="<?=$config['url_aplicacion'];?>scripts/registro.js"></script>

