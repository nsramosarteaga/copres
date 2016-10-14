<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$epsDAO    = new EPSDAO($id_conexion);
$array_eps = $epsDAO->getEPS();

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/eps/index.php';
include '../../views/template/footer.php';

$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/mantenimiento.js"></script>