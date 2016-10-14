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

$poblacionDAO = new PoblacionDAO($id_conexion, $_SESSION['usr_id']);
$array_poblacion = $poblacionDAO->getPoblacionExtendida();

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/registro/buscar.php';
include '../../views/template/footer.php';
$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/registro.js"></script>