<?php
include '../../config/config.inc';
include_once ('../../model/System/Conexion.php');
include '../../model/DAO/ClasificacionDireccionDAO.php';
include '../../local/es_CO.php';

$conexion             = new Conexion();
$id_conexion          = $conexion->conectar();
//$cdi_tipo_direccion_p = array(0=>NULL, 'U'=> 'B', 'R'=> 'V');
$cdi_tipo_direccion_p = array(0=>NULL, '1'=> 'B', '2'=> 'V', 'U'=>'B', 'R'=>'V');
$are_id = (isset($_POST['are_id']))?$_POST['are_id']:'';
$cdi_id = (isset($_POST['cdi_id']))?$_POST['cdi_id']:'';
$cdireccionDAO = new ClasificacionDireccionDAO($id_conexion);
$array_cdireccion = $cdireccionDAO->getClasificacionDireccion('', $cdi_tipo_direccion_p[$are_id]);

$options = '<option value="">'.$lang['sistema']['cbo_seleccione'].'</option>';

foreach ($array_cdireccion as $row) {
	$options .= '<option value="'.$row['cdi_id'].'" ';
	if( $cdi_id === $row['cdi_id']) $options .= ' selected="selected"';
	$options .= '>'.$row['cdi_str_nombre'].'</option>';
}

echo $options;
?>
