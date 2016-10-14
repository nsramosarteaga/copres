<?php
include '../../config/config.inc';
include '../seguridad.php';
include_once '../../model/System/Conexion.php';
include '../../model/DAO/PoblacionDAO.php';
include '../../local/es_CO.php';

$conexion = new Conexion();
$id_conexion = $conexion->conectar();
//var_dump($_POST);
$poblacionDAO = new PoblacionDAO($id_conexion, $_SESSION['usr_id']);

$array_resultado = $poblacionDAO->depuracionInterna($_POST);


$table ="<table id='resultados_busqueda_criterio' class='display table table-striped' cellspacing='0' width='100%' style='font-size:8pt'>
<thead>
	<tr>
	<th>Item</th>
	<th>Tipo</th> 
	<th>Documento</th>
	<th>Primer Apellido</th>
	<th>Segundo Apellido</th>
	<th>Primer Nombre</th>
	<th>Segundo Nombre</th>	
	<th>Fecha Nacimiento</th>
	<th>EPS</th>
	<th>Estado</th> 
	<th>".$lang['tbl_registro']['opciones']."</th>
	</tr>
</thead>
<tbody>";
$clase_fila = array(0=>'par',1=>'impar');
$i=1;
foreach($array_resultado as $row){
	// $table .= "<tr class='".$clase_fila[$i % 2]."'>
		// <td>$i</td>
		// <td>".$row['tdo_str_referencia']."</td>
		// <td>".$row['pob_str_documento']."</td>
		// <td>".$row['pob_str_apellido1']."</td>
		// <td>".$row['pob_str_apellido2']."</td>
		// <td>".$row['pob_str_nombre1']."</td>
		// <td>".$row['pob_str_nombre2']."</td>
		// <td>".$row['pob_dat_fechaNacimiento']."</td>
		// <td>".$row['eps_str_nombre']."</td>
		// <td>".$row['est_str_referencia']."</td>";
		
		
		$table .= "<tr class='".$clase_fila[$i % 2]."'>
		<td>$i</td>
		<td>".$row['tdo_str_referencia']."</td>
		<td>".$row['pob_str_documento']."</td>
		<td>".$row['pob_str_apellido1']."</td>
		<td>".$row['pob_str_apellido2']."</td>
		<td>".$row['pob_str_nombre1']."</td>
		<td>".$row['pob_str_nombre2']."</td>
		<td>".$row['pob_dat_fechaNacimiento']."</td>
		<td>".$row['eps_str_nombre']."</td>
		<td>".$row['est_str_descripcion']."</td>";
	
		$table .= '<td>
			<form action="editar.php" id="form_editar_'.$row['pob_id'].'" name="form_editar_'.$row['pob_id'].'" method="post" >
				<input type="hidden" value="'.$row['pob_id'].'" id="pob_id" name="pob_id">
			</form>
			<a title="'.$lang['sistema']['btn_ver'].'" href="#" class="btn btn-info btn-xs" onclick="mostrarRegistro(\''.$row['pob_id'].'\')"><i class="fa fa-search"></i></a>
			<a title="'.$lang['sistema']['btn_modificar'].'" href="#" class="btn btn-primary btn-xs" onclick="modificarRegistroModal(\''.$row['pob_id'].'\')"><i class="fa fa-pencil"></i></a>
			<a title="'.$lang['sistema']['btn_eliminar'].'" href="#" class="btn btn-danger btn-xs" onclick="eliminarRegistro(\''.$row['pob_id'].'\')"><i class="fa fa-trash"></i></a>
		</td>';
		
	$table .= "</tr>";	
	$i++;
}

$table .= "</tbody>
</table>";



if(empty($array_resultado))
	echo "<div class='alert danger'>No hay resultados que cumplan con los criterios seleccionados.</div>";
else
	echo $table;

$conexion->desconectar($id_conexion);
?>
