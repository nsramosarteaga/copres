<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

$cdireccionDAO = new ClasificacionDireccionDAO($id_conexion);

//validar q no exista poblacin de esa eps

$eliminar = $cdireccionDAO->deleteClasificacionDireccion($_POST['cdi_id']);

if($eliminar===true)
    echo 'OK';
else
    echo $eliminar;

$conexion->desconectar($id_conexion);
?>
