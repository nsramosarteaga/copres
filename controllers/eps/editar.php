<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';
$eps_id = (isset($_POST['eps_id'])) ? $_POST['eps_id'] : NULL ;
if(is_null($eps_id ))
    exit("El dato no puede ser vacío");

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$epsDAO    = new EPSDAO($id_conexion);
$array_eps = $epsDAO->getEPS($eps_id);
$eps = $array_eps [0];

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/eps/editar.php';
include '../../views/template/footer.php';

$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/mantenimiento.js"></script>