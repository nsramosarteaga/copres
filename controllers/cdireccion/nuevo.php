<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/EPSDAO.php';
include '../../local/es_CO.php';

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/cdireccion/nuevo.php';
include '../../views/template/footer.php';

?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/mantenimiento.js"></script>