<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';
$cdi_id = (isset($_POST['cdi_id'])) ? $_POST['cdi_id'] : NULL ;
if(is_null($cdi_id))
    exit("El dato no puede ser vacío");

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$cdireccionDAO    = new ClasificacionDireccionDAO($id_conexion);
$array_cdireccion = $cdireccionDAO->getClasificacionDireccion($cdi_id);
$cdireccion = $array_cdireccion [0];

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/cdireccion/editar.php';
include '../../views/template/footer.php';

$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/mantenimiento.js"></script>