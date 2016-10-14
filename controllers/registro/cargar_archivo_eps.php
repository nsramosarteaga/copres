<?php
session_start();
$sid = session_id();
// echo "session id: ".$sid;

include '../../config/config.inc';
include '../seguridad.php';
//include_once ('../../model/System/Conexion.php');
include '../../local/es_CO.php';
include '../../model/System/Util.php';
include_once '../../model/DAO/PoblacionDAO.php';

$msg_registro_pob = "";
$array_resultado_pob_tmp = array();
if(isset($_FILES['pob_str_adjunto_eps']['name']) and !empty($_FILES['pob_str_adjunto_eps']['name']))
{
	$util = new Util();
	$v_pob_nuevos = $util->csv_to_array($_FILES['pob_str_adjunto_eps']['tmp_name'], ",", $_FILES['pob_str_adjunto_eps']['name']);
	// echo "csv_to_array:".count($v_pob_nuevos);
	$msg_registro_pob = insertCSV($v_pob_nuevos);	
	$array_resultado_pob_tmp = getPoblacionTmp();
	
	$array_resultado_pob_tmp_coincidencias = NULL;
	$array_resultado_pob_tmp_coincidencias_parciales = NULL;
	foreach( $array_resultado_pob_tmp as $fila){
		$eps_id = $fila['eps_id'];
		if($fila["pob_id2"] != ""){
			$array_resultado_pob_tmp_coincidencias[] = $fila ; 
		}else{
			$array_resultado_pob_tmp_coincidencias_parciales[] = $fila;
		}
	}
	
	// obtener coincidencias parciales	
	$array_verificacion_campos = array('eps_id','pob_str_apellido1','pob_str_apellido2','pob_str_nombre1','pob_str_nombre2','est_id','pob_dat_fechaNacimiento');
	$array_verificacion_mensaje = array('EPS','Primer Apellido','Segundo Apellido','Primer Nombre','Segundo Nombre','Estado','Fecha Nacimiento');
	$i = 0;
	foreach($array_resultado_pob_tmp_coincidencias_parciales as $fila){
		//print_r($fila);
		//echo "<br/>".$i." - ".$fila['tdo_id'],",".$fila['pob_str_documento'];
		$pob_id = getPoblacionPob_id($fila['tdo_id'],$fila['pob_str_documento']);
		//echo " pob_id:".$pob_id."|";
		
		$num_coincidencia = 0;
		$campos_coincidencia = array();
		
		if(! is_null($pob_id)){
			$num_coincidencia = 2;
			$campos_coincidencia[] = "Tipo documento";
			$campos_coincidencia[] = "Documento";			
			$poblacion_copres = getPoblacion($pob_id);
			
			$j=0;
			foreach( $array_verificacion_campos as $value ){
				if($poblacion_copres[$value] == $fila[$value]){
					$num_coincidencia++;
					$campos_coincidencia[] = $array_verificacion_mensaje[$j];
				}
				$j++;
			}
			
		}
		
		$array_resultado_pob_tmp_coincidencias_parciales[$i]['num_coincidencia'] = $num_coincidencia;
		$array_resultado_pob_tmp_coincidencias_parciales[$i]['campos_coincidencia'] = $campos_coincidencia;
		$i++;
	}
	
	$array_parciales = array();
	$array_no_copres = array();
	foreach($array_resultado_pob_tmp_coincidencias_parciales as $fila1){
		if( (int)$fila1['num_coincidencia'] > 0 ){
			// obtener registro de eps con coincidencias parciales
			$array_parciales[] = $fila1;
		}else{
			// obtener registro de eps, pero no en copres
			$array_no_copres[] = $fila1;
		}
	}		
	// obtener registros de copres, pero no del municipio
	$array_resultado_pob_tmp_eps = getPoblacionTmpEps($eps_id);
	
	// Crear Archivos Planos
	$csv_end = "\n";
    $csv_sep = ",";
	// Encabezados
	//$headers = array("Tipo","Documento","Primer Apellido","Segundo Apellido","Primer Nombre", "Segundo Nombre", "Fecha Nacimiento", "Estado", "EPS");
	$filaEncabezado = utf8_encode("TipoDoc".$csv_sep."Documento".$csv_sep."Primer Apellido".$csv_sep."Segundo Apellido".$csv_sep."Primer Nombre".$csv_sep."Segundo Nombre".$csv_sep."Fecha Nacimiento".$csv_sep."Estado".$csv_sep."EPS".$csv_end);
	
	// Coincidencias totales
	$nombre_archivo = $config['path_aplicacion']."files/csv/coincidencias_totales.csv";
	$handle = fopen($nombre_archivo, "wr");	
	$contenido = '';
	foreach ($array_resultado_pob_tmp_coincidencias as $registro){
		 $contenido .= '"'.$registro['tdo_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_documento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_dat_fechaNacimiento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['est_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['eps_id'].'"'.$csv_end;
	}
	$contenido = $filaEncabezado.$contenido;
	fwrite($handle, utf8_decode($contenido));	
	fclose($handle);
	// Coincidencias parciales
	$nombre_archivo = $config['path_aplicacion']."files/csv/coincidencias_parciales.csv";
	$handle = fopen($nombre_archivo, "wr");	
	$contenido = '';
	foreach ($array_parciales as $registro){
		 $contenido .= '"'.$registro['tdo_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_documento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_dat_fechaNacimiento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['est_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['eps_id'].'"'.$csv_end;
	}
	$contenido = $filaEncabezado.$contenido;
	fwrite($handle, utf8_decode($contenido));	
	fclose($handle);
	// no copres
	$nombre_archivo = $config['path_aplicacion']."files/csv/no_copres.csv";
	$handle = fopen($nombre_archivo, "wr");	
	$contenido = '';
	foreach ($array_no_copres as $registro){
		 $contenido .= '"'.$registro['tdo_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_documento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_dat_fechaNacimiento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['est_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['eps_id'].'"'.$csv_end;
	}
	$contenido = $filaEncabezado.$contenido;
	fwrite($handle, utf8_decode($contenido));	
	fclose($handle);
	// no eps
	$nombre_archivo = $config['path_aplicacion']."files/csv/no_eps.csv";
	$handle = fopen($nombre_archivo, "wr");	
	$contenido = '';
	foreach ($array_resultado_pob_tmp_eps as $registro){
		 $contenido .= '"'.$registro['tdo_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_documento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_apellido2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre1'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_str_nombre2'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['pob_dat_fechaNacimiento'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['est_id'].'"'.$csv_sep;
		 $contenido .= '"'.$registro['eps_id'].'"'.$csv_end;
	}
	$contenido = $filaEncabezado.$contenido;
	fwrite($handle, utf8_decode($contenido));	
	fclose($handle);
}
//echo $msg_registro_pob;

include '../../views/template/header.php';
include '../../views/registro/cargar_archivo_eps.php';
include '../../views/template/footer.php';

//$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/registro.js"></script>
<?php
function insertCSV($v_pob_nuevos_p)
{
		global $sid;
		if(count($v_pob_nuevos_p) > 0)
		{
			$conexion_pob = new Conexion();
			$idConexion_pob = $conexion_pob->conectar();
			$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
			$observaciones = array();
			$contador = 2;
			
			$reset_sql = "DELETE FROM poblacion_tmp WHERE pob_str_session_id = '".$sid."'";
			mysqli_query($idConexion_pob, $reset_sql);
			
			foreach($v_pob_nuevos_p as $fila_csv)
			{
				// echo "<pre>";
				// print_r($fila_csv);
				// echo "</pre>";
				if($fila_csv['tdo_id'] != '' and $fila_csv['pob_str_documento'] != '')
				{								
					$fila_csv['pob_str_apellido1']=utf8_encode($fila_csv['pob_str_apellido1']);
					$fila_csv['pob_str_apellido2']=utf8_encode($fila_csv['pob_str_apellido2']);
					$fila_csv['pob_str_nombre1']=utf8_encode($fila_csv['pob_str_nombre1']);
					$fila_csv['pob_str_nombre2']=utf8_encode($fila_csv['pob_str_nombre2']);
					$fila_csv['pob_str_direccion']=utf8_encode($fila_csv['pob_str_direccion']);
					
					$respuesta_tmp = $poblacionDAO->insertPoblacionTmp($fila_csv, $contador, $sid);
					if($respuesta_tmp != 1 )
						$observaciones[] = $respuesta_tmp;
				}					
				else
                    $observaciones[] = "- En la línea ".$contador." del archivo falta el tipo de documento y/o el número de documento.";
				$contador++;
			}
			
			$msg_registro_pob = implode("<br>", $observaciones);
			return $msg_registro_pob;
		}				
	}
	
function getPoblacionTmp()
{
	global $sid;
	$conexion_pob = new Conexion();
	$idConexion_pob = $conexion_pob->conectar();
	$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
	$respuesta_tmp = array();
	$respuesta_tmp = $poblacionDAO->getPoblacionTmp($sid);
	$conexion_pob->desconectar($idConexion_pob);
	return $respuesta_tmp;
}

function getPoblacionTmpEps($eps_id)
{
	$conexion_pob = new Conexion();
	$idConexion_pob = $conexion_pob->conectar();
	$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
	$respuesta_tmp = array();
	$respuesta_tmp = $poblacionDAO->getPoblacionTmpEps($eps_id);
	$conexion_pob->desconectar($idConexion_pob);
	return $respuesta_tmp;
}

function getPoblacion($pob_id)
{
	$conexion_pob = new Conexion();
	$idConexion_pob = $conexion_pob->conectar();
	$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
	$respuesta_tmp = array();
	$respuesta_tmp = $poblacionDAO->getPoblacion($pob_id);
	$conexion_pob->desconectar($idConexion_pob);
	return $respuesta_tmp[0];
}

function getPoblacionPob_id($tpo_id,$pob_str_documento,$eps_id=""){
	$conexion_pob = new Conexion();
	$idConexion_pob = $conexion_pob->conectar();
	$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
	$respuesta_tmp = array();
	$respuesta_tmp = $poblacionDAO->getPoblacionPob_id($tpo_id,$pob_str_documento,$eps_id);
	$conexion_pob->desconectar($idConexion_pob);
	return $respuesta_tmp[0]['pob_id'];
}
?>
