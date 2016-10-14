<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once ('../../model/System/Conexion.php');
include_once ('../../model/System/Autenticacion.php');
include '../../model/DAO/PoblacionDAO.php';
include '../../model/DAO/TipoNovedadDAO.php';
include '../../local/es_CO.php';

$conexion    = new Conexion();
$id_conexion = $conexion->conectar();

$poblacionDAO = new PoblacionDAO($id_conexion, $_SESSION['usr_id']);
$auditoriaDAO = new AuditoriaDAO($id_conexion);
$tipoNovedadDAO = new TipoNovedadDAO($id_conexion);

//$array_resultado = $poblacionDAO->getPoblacion($_POST['pob_id']);
$array_resultado = $poblacionDAO->reporteador($_POST);
if($array_resultado){
	$datosPoblacion = $array_resultado[0];
	//var_dump($datosPoblacion);
	echo "<div class='small'>";
	echo $datosPoblacion['tdo_str_referencia']."-".$datosPoblacion['pob_str_documento']." ".$datosPoblacion['pob_str_nombre1']." ".$datosPoblacion['pob_str_nombre2']." ".$datosPoblacion['pob_str_apellido1']." ".$datosPoblacion['pob_str_apellido2']."<br/>";
	echo "EPS: ".$datosPoblacion['eps_str_nombre']."<br/>";
	echo "Estado: ".$datosPoblacion['est_str_referencia']."-".$datosPoblacion['est_str_descripcion']."<br/>";
	echo "Fecha Nacimiento: ".$datosPoblacion['pob_dat_fechaNacimiento']."<br/>";
	echo "Género: ".$datosPoblacion['sex_str_descripcion']."<br/>";	
	echo "Dirección: ".$datosPoblacion['pob_str_direccion']." ";
	if($datosPoblacion['cdi_str_tipo']=='V')
		echo "Vereda ";
	else
		echo "Barrio ";
	echo $datosPoblacion['cdi_str_nombre']."<br/>";	
	echo "Telefono: ".$datosPoblacion['pob_str_telefono']."<br/>";
	echo "Correo Electrónico: ".$datosPoblacion['pob_str_correo']."<br/>";	
	echo "Población: ".$datosPoblacion['cpo_str_descripcion']."<br/>";
	echo "Nivel: ".$datosPoblacion['niv_id']."<br/>";
	echo "Puntaje SISBEN: ".$datosPoblacion['pob_num_puntaje'];	
	echo "</div>";
	
	$resultado_auditoria = $auditoriaDAO->getAuditoria(null,'poblacion',$_POST['pob_id']);
	
	/*
	echo "<div class='row'>
			<div class='col-lg-2'><span class='lead'>Fecha</span></div>
			<div class='col-lg-3'><span class='lead'>Novedad</span></div>
			<div class='col-lg-7'><span class='lead'>Observación</span></div>
		</div>";
	foreach($resultado_auditoria as $fila){
		$fila['str_aud_data'] = json_decode($fila['str_aud_data'],true);
		echo "<div class='row'>";
		echo "<div class='col-lg-2'><span class='small70'>".substr($fila['dat_aud_fecha'],0,strlen($fila['dat_aud_fecha'])-3)."</span></div>";
		$tpoNovedad = $tipoNovedadDAO->getTipoNovedad($fila['str_aud_data']['tno_id']);
		echo "<div class='col-lg-3'><span class='small75'>".$tpoNovedad[0]['tno_str_descripcion']."</span></div>";
		echo "<div class='col-lg-7'><span class='small75'>".$fila['str_aud_data']['pob_str_observacion']."</span></div>";		
		echo "</div>";
	}
	*/
	
	$tabla_novedades = '<div id="tabla_novedades"><table class="table table-striped table-bordered small75">
		<thead>
		<tr>
			<th>Fecha</th>
			<th>Novedad</th>
			<th>Observación</th>
		</tr>		
		</thead>		
		<tbody>';
	foreach($resultado_auditoria as $fila){
		$fila['str_aud_data'] = json_decode($fila['str_aud_data'],true);		
		$tabla_novedades .= '<tr>
			<td>'.substr($fila['dat_aud_fecha'],0,strlen($fila['dat_aud_fecha'])-3).'</td>';		
		$tpoNovedad = $tipoNovedadDAO->getTipoNovedad($fila['str_aud_data']['tno_id']);
		$tabla_novedades .= '<td>'.$tpoNovedad[0]['tno_str_descripcion'].'</td>'.
			'<td>'.$fila['str_aud_data']['pob_str_observacion'].'</td>'.
			'</tr>';
	}	
	$tabla_novedades .=	'</tbody>
		</table></div>';
	echo $tabla_novedades;
}else{
	echo "<div class='alert alert-danger alert-dismissable'><h4><i class='icon fa fa-ban'></i> Alerta!</h4>No existen datos del usuario.</div>";
}

$url_aplicacion = $config['url_aplicacion'];


$conexion->desconectar($id_conexion);
?>
