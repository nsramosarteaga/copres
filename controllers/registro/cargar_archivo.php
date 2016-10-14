<?php
include '../../config/config.inc';
include '../seguridad.php';
//include_once ('../../model/System/Conexion.php');
include '../../local/es_CO.php';

include '../../model/System/Util.php';

include_once '../../model/DAO/PoblacionDAO.php';

//$conexion    = new Conexion();
//$id_conexion = $conexion->conectar();

$msg_registro_pob = "";

if(isset($_FILES['pob_str_adjunto']['name']) and !empty($_FILES['pob_str_adjunto']['name']))
{
	$util = new Util();
	$v_pob_nuevos = $util->csv_to_array($_FILES['pob_str_adjunto']['tmp_name'], ";", $_FILES['pob_str_adjunto']['name']);
	//echo "csv_to_array:".count($v_pob_nuevos);
	$msg_registro_pob = insertCSV($v_pob_nuevos);
}
//echo $msg_registro_pob;

include '../../views/template/header.php';
include '../../views/registro/cargar_archivo.php';
include '../../views/template/footer.php';

//$conexion->desconectar($id_conexion);
?>
<!-- script local -->
<script src="<?=$config['url_aplicacion'];?>scripts/registro.js"></script>
<?php
function insertCSV($v_pob_nuevos_p)
	{
		if(count($v_pob_nuevos_p) > 0)
		{
			$conexion_pob = new Conexion();
			$idConexion_pob = $conexion_pob->conectar();
			$poblacionDAO = new poblacionDAO($idConexion_pob, $_SESSION['username']);
			$observaciones = array();
			$contador = 2;
			foreach($v_pob_nuevos_p as $fila_csv)
			{
				if($fila_csv['tdo_id'] != '' and $fila_csv['pob_str_documento'] != '')
				{					
					$fila_csv['pob_str_apellido1']=utf8_encode($fila_csv['pob_str_apellido1']);
					$fila_csv['pob_str_apellido2']=utf8_encode($fila_csv['pob_str_apellido2']);
					$fila_csv['pob_str_nombre1']=utf8_encode($fila_csv['pob_str_nombre1']);
					$fila_csv['pob_str_nombre2']=utf8_encode($fila_csv['pob_str_nombre2']);
					$fila_csv['pob_str_direccion']=utf8_encode($fila_csv['pob_str_direccion']);
					
					$respuesta_tmp = $poblacionDAO->insertPoblacion($fila_csv, $contador);
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
?>
