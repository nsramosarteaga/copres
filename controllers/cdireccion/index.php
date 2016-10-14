<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$cdireccionDAO    = new ClasificacionDireccionDAO($id_conexion);
$array_cdireccion = $cdireccionDAO->getClasificacionDireccion();

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/cdireccion/index.php';
include '../../views/template/footer.php';

$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/mantenimiento.js"></script>