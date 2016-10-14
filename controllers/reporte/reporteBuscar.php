<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/PoblacionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();

// var_dump($_POST);
$poblacionDAO = new PoblacionDAO($id_conexion, $_SESSION['usr_id']);

$array_resultado = $poblacionDAO->reporteador($_POST);
//print_r($array_resultado);
$table ="<table id='resultados_busqueda' class='table table-striped table-bordered small75'>
<thead>
	<tr>
	<th>Item</th>
	<th>EPS</th>	
	<th>Tipo</th>
	<th>Documento</th>
	<th>Primer Apellido</th>
	<th>Segundo Apellido</th>
	<th>Primer Nombre</th>
	<th>Segundo Nombre</th>
	<th>Fecha Nacimiento</th>
	<th>Genero</th>
	<th>Estado</th>
	<th>Tipo Pob.</th>
	<th>Nivel</th>
	<th>Area</th>
	</tr>
</thead>
<tbody>";
$clase_fila = array(0=>'par',1=>'impar');
$i=1;
$table_contenido = "";
foreach($array_resultado as $row){
	$table_contenido .= "<tr class='".$clase_fila[$i % 2]."'>
		<td clas=''>$i</td>
		<td>".$row['eps_str_codigo']."</td>
		<td>".$row['tdo_str_referencia']."</td>		
		<td>".$row['pob_str_documento']."</td>
		<td>".$row['pob_str_apellido1']."</td>
		<td>".$row['pob_str_apellido2']."</td>
		<td>".$row['pob_str_nombre1']."</td>
		<td>".$row['pob_str_nombre2']."</td>
		<td>".$row['pob_dat_fechaNacimiento']."</td>
		<td>".$row['sex_str_referencia']."</td>
		<td>".$row['est_str_referencia']."</td>
		<td>".$row['cpo_id']."</td>
		<td>".$row['niv_str_referencia']."</td>
		<td>".$row['are_str_referencia']."</td>
	</tr>";	
	$i++;
}

$table .= $table_contenido."</tbody>
</table>";
$titulo_informe='<div style="text-align:center; width:100%"><b>'.strtoupper($lang['reporte']['titulo_informe']).'</b><br/>';
if($_POST['filtro']!=="") $titulo_informe .= 'Filtro aplicado:'.$_POST['filtro'].'</div>';

if(empty($array_resultado))
	echo "No hay resultados que cumplan con los criterios seleccionados.";
else
	echo $titulo_informe.$table;

$conexion->desconectar($id_conexion);
?>
