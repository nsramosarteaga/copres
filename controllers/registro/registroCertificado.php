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

$texto ="";
//$array_resultado = $poblacionDAO->getPoblacion($_POST['pob_id']);
$array_resultado = $poblacionDAO->reporteador($_POST);
if($array_resultado){
	$datosPoblacion = $array_resultado[0];
	//var_dump($datosPoblacion);
	$texto .= '<div style="text-align:center; margin-left:-10mm; width:155mm;">'.
				$lang['certificacion']['texto_uno'];
	$texto .= '<p style="text-align:justify;">'.$datosPoblacion['pob_str_apellido1']." ".$datosPoblacion['pob_str_apellido2']." ".$datosPoblacion['pob_str_nombre1']." ".$datosPoblacion['pob_str_nombre2'];
	
	if ($datosPoblacion['sex_str_referencia'] ==='F'){
		$texto .= ' identificada con ';
	}else{
		$texto .= ' identificado con ';
	}
	$texto .= $datosPoblacion['tdo_str_referencia'].' número '.$datosPoblacion['pob_str_documento'];
	$texto .= ' se encuentra actualmente '.$datosPoblacion['est_str_referencia'].' con la EPS '.$datosPoblacion['eps_str_nombre'].' en la Base de Datos COPRES del Régimen Subsidiado del Municipio de '.$lang['copyright']['municipio'].' y el siguiente historial de novedades:<br/></p>';
	$resultado_auditoria = $auditoriaDAO->getAuditoria(null,'poblacion',$_POST['pob_id']);
	
	$tabla_novedades = '
		<table class="table table-striped table-bordered small75" align="center">
			<thead>
			<tr>
				<th>Fecha</th>
				<th>Novedad</th>
				<th>Observación</th>
			</tr>		
			</thead>		
			<tbody>';
	$clase_fila = array(0=>'par',1=>'impar');
	$i=1;
	foreach($resultado_auditoria as $fila){
		$fila['str_aud_data'] = json_decode($fila['str_aud_data'],true);		
		$tabla_novedades .= '<tr class="'.$clase_fila[$i % 2].'">
			<td>'.substr($fila['dat_aud_fecha'],0,strlen($fila['dat_aud_fecha'])-3).'</td>';		
		$tpoNovedad = $tipoNovedadDAO->getTipoNovedad($fila['str_aud_data']['tno_id']);
		$tabla_novedades .= '<td style="text-align:justify;">'.$tpoNovedad[0]['tno_str_descripcion'].'</td>'.
			'<td style="text-align:justify;">'.$fila['str_aud_data']['pob_str_observacion'].'</td>'.
			'</tr>';
		$i++;
	}	
	$tabla_novedades .=	'</tbody>
		</table>';	
	$texto .= $tabla_novedades."";	
	
	//setlocale(LC_TIME,"spanish");
	//define("CHARSET","iso-8859-1");
	//setlocale(LC_ALL,"es_ES.UTF-8");
	$dias = array("domingo","lunes","martes","mièrcoles","jueves","viernes","sábado");
	$meses = array("enero","febrero","marzo","abril","mayo", "junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
	$texto .= '<br/><p style="text-align:justify;">Se expide la presente certificación a solicitud del interesado/a el '.$dias[date('w')].' '.date('d').' de '.$meses[date('n')-1].' del '.date('Y').'.</p><br/>';
	
	//setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
	//$texto .= '<br/><p style="text-align:justify;">Se expide la presente certificación a solicitud del interesado/a el '.strftime('%A %d de %B del %Y').'.</p><br/>';
	$texto .= '<p><img src="../img/firma-certificado.png"></p>'; // Fondo transparente 250x155 px
	/*
	$texto .= '<p style="position: relative; top:-18mm;"><b>'.$lang['certificacion']['nombre_funcionario_certificador'].'<br/>'.
				$lang['certificacion']['cargo_funcionario_certificador'].'</b></p>';
	*/
	
	$texto .= '<p style="text-align:justify; margin-bottom:10px; font-size:60%">Elaborado por: '.$lang['certificacion']['funcionario_elabora'].' </p>';
	
	$texto .= '</div>';
	
	echo $texto;
}else{
	echo "<div class='alert alert-danger alert-dismissable'><h4><i class='icon fa fa-ban'></i> Alerta!</h4>No existen datos del usuario.</div>";
}
$url_aplicacion = $config['url_aplicacion'];
$conexion->desconectar($id_conexion);
?>
