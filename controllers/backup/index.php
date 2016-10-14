<?php
include '../../config/config.inc';
include '../seguridad.php';
//include_once ('../../model/System/Conexion.php');
include '../../local/es_CO.php';

//$conexion    = new Conexion();
//$id_conexion = $conexion->conectar(); date("Y-m-d H:i:s")
$existe_backup = false;
$nombre_archivo_bkp = 'copres_backup_'.date("Ymd0000").'.zip';
$ruta_archivo_bkp = $config['path_aplicacion']."backup/".$nombre_archivo_bkp;
if(file_exists($ruta_archivo_bkp)){
    $existe_backup = true;
}else{
    $nombre_archivo_bkp = str_replace('0000.zip','1800.zip',$nombre_archivo_bkp);
    $ruta_archivo_bkp = str_replace('0000.zip','1800.zip',$ruta_archivo_bkp);
    if(file_exists($ruta_archivo_bkp)) $existe_backup = true;
}

$url_aplicacion = $config['url_aplicacion'];
include '../../views/template/header.php';
include '../../views/backup/index.php';
include '../../views/template/footer.php';

//$conexion->desconectar($id_conexion);
?>