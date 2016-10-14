<?php
include_once 'AuditoriaDAO.php';
class PoblacionDAO {
	var $pob_id;
	var $eps_id;
	var $tdo_id;
	var $pob_str_documento;
	var $pob_str_apellido1;
	var $pob_str_apellido2;
	var $pob_str_nombre1;
	var $pob_str_nombre2;
	var $sex_id;
	var $pob_dat_fechaNacimiento;
	var $est_id;
	var $cpo_id;
	var $niv_id;
	var $pob_num_puntaje;
	var $are_id;
	var $pob_str_serialFormulario;
	var $tno_id;
	var $pob_dat_fechaFormulario;
	var $pob_dat_fechaModificacion;
	var $pob_dat_fechaCargue;
	var $pob_str_telefono;
	var $pob_str_direccion;
	var $pob_num_edad;//Campo calculado
	var $cdi_id;
	var $pob_str_correo;
	var $pob_str_observacion;
	private $conexion;
	private $usr_id;
	private $sql;
	private $where;
	private $tabla;
	private $tamanoPorPagina;
	private $limit;
	private $orderBy;

	function __construct($idConexion_p, $usr_id) {
		$this->conexion = $idConexion_p;
		$this->usr_id   = $usr_id;
		$this->tabla    = "poblacion";
		$this->tamanoPorPagina = 0;
	}

	function getSexo($sex_id_p = "") {
		$this->sql = "SELECT sex_id, sex_str_referencia, sex_str_descripcion FROM sexo";
		if ($sex_id_p != "") {
			$this->sql .= " WHERE sex_id = ".$sex_id_p;
		}

		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		return $resultado;
	}

	function getTipoDocumento($tdo_id_p = "") {
		$this->sql = "SELECT tdo_id, tdo_str_referencia, tdo_str_descripcion FROM tipodocumento";
		if ($tdo_id_p != "") {
			$this->sql .= " WHERE tdo_id = ".$tdo_id_p;
		}

		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		// mysqli_free_result($recurso);
		return $resultado;
	}

	function getPoblacion($pob_id_p = "") {
		$this->sql = "SELECT pob_id, eps_id, tdo_id, pob_str_documento, pob_str_apellido1, pob_str_apellido2, pob_str_nombre1, pob_str_nombre2, sex_id, pob_dat_fechaNacimiento, est_id, cpo_id, niv_id, pob_num_puntaje, are_id, pob_str_serialFormulario, tno_id, pob_dat_fechaFormulario, pob_dat_fechaModificacion, pob_str_correo, pob_str_observacion, pob_str_telefono, pob_str_direccion, cdi_id FROM ".$this->tabla;
		if ($pob_id_p != "") {
			$this->sql .= " WHERE pob_id = ".$pob_id_p;
		}	
		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		// mysqli_free_result($recurso);
		return $resultado;
	}

	function getPoblacionExtendida($pob_id_p = "") {
		$this->sql = "SELECT a.pob_id, b.eps_str_nombre, b.eps_str_codigo, c.tdo_str_referencia, a.pob_str_documento, a.pob_str_apellido1, a.pob_str_apellido2, a.pob_str_nombre1, a.pob_str_nombre2, d.sex_str_referencia, a.pob_dat_fechaNacimiento, e.est_str_referencia, f.cpo_str_descripcion, g.niv_str_referencia, a.pob_num_puntaje, h.are_str_referencia, a.pob_str_serialFormulario, i.tno_str_referencia, a.pob_dat_fechaFormulario, a.pob_dat_fechaModificacion, a.pob_str_correo, a.pob_str_observacion, a.pob_str_telefono, a.pob_str_direccion, a.cdi_id 
		FROM ".$this->tabla." as a INNER JOIN eps as b ON a.eps_id=b.eps_id INNER JOIN tipodocumento as c ON a.tdo_id=c.tdo_id INNER JOIN sexo as d ON a.sex_id=d.sex_id INNER JOIN estado as e ON a.est_id=e.est_id INNER JOIN clasificacionpoblacion as f ON a.cpo_id=f.cpo_id INNER JOIN nivel as g ON a.niv_id=g.niv_id INNER JOIN area as h ON a.are_id=h.are_id INNER JOIN tiponovedad as i ON a.tno_id=i.tno_id";
		if ($pob_id_p != "") {
			$this->sql .= " WHERE pob_id = ".$pob_id_p;
		}
		//$this->sql .= " LIMIT 300";
		
		//echo "sql:".$this->sql;		
		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		// mysqli_free_result($recurso);
		return $resultado;
	}
	
	
	function insertPoblacion($vector_pob_p = array(), $linea_p = "") {
		$this->pob_num_puntaje          = (!isset($vector_pob_p['pob_num_puntaje']) or $vector_pob_p['pob_num_puntaje'] == "")?"NULL":str_replace(",", ".", $vector_pob_p['pob_num_puntaje']);
				
		$validar_tdo = $this->getValue("tdo_id", "tipodocumento", array("tdo_str_referencia", $vector_pob_p['tdo_id']));
		if($validar_tdo == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe el tipo de documento indicado (".$vector_pob_p['tdo_id'].").";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe el tipo de documento indicado (".$vector_pob_p['tdo_id'].").";
		}
		else
			$vector_pob_p['tdo_id'] = $validar_tdo;
		
		$validar_eps = $this->getValue("eps_id", "eps", array("eps_str_codigo", $vector_pob_p['eps_id']));
		if($validar_eps == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe la EPS indicada (".$vector_pob_p['eps_id'].").";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe la EPS indicada (".$vector_pob_p['eps_id'].").";
		}
		else
			$vector_pob_p['eps_id'] = $validar_eps;
		
		$validar_sex = $this->getValue("sex_id", "sexo", array("sex_str_referencia", $vector_pob_p['sex_id']));
		if($validar_sex == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay sexo definido.";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay sexo definido.";
		}
		else
			$vector_pob_p['sex_id'] = $validar_sex;
		
		
		
	// echo $vector_pob_p['tdo_id']."<br>";
		if ($this->validateRecord("", $vector_pob_p['tdo_id'], $vector_pob_p['pob_str_documento'])) {
			
			$validar_puntaje = is_numeric(trim($this->pob_num_puntaje));
			if(!$validar_puntaje)
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe un valor adecuado para el puntaje del sisben (".$this->pob_num_puntaje.").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe un valor adecuado para el puntaje del sisben (".$this->pob_num_puntaje.").";
			}
			
			
			$this->pob_str_serialFormulario = (!isset($vector_pob_p['pob_str_serialFormulario']) or $vector_pob_p['pob_str_serialFormulario'] == "")?"NULL":"'".$vector_pob_p['pob_str_serialFormulario']."'";
			$this->pob_str_telefono         = (!isset($vector_pob_p['pob_str_telefono']) or $vector_pob_p['pob_str_telefono'] == "")?"NULL":"'".$vector_pob_p['pob_str_telefono']."'";
			$this->pob_str_direccion        = (!isset($vector_pob_p['pob_str_direccion']) or $vector_pob_p['pob_str_direccion'] == "")?"NULL":"'".$vector_pob_p['pob_str_direccion']."'";
			$this->pob_str_correo           = (!isset($vector_pob_p['pob_str_correo']) or $vector_pob_p['pob_str_correo'] == "")?"NULL":"'".$vector_pob_p['pob_str_correo']."'";
			$this->pob_str_observacion      = (!isset($vector_pob_p['pob_str_observacion']) or $vector_pob_p['pob_str_observacion'] == "")?"NULL":"'".$vector_pob_p['pob_str_observacion']."'";
			$this->pob_str_nombre2		    = (!isset($vector_pob_p['pob_str_nombre2']) or $vector_pob_p['pob_str_nombre2'] == "")? "' '":"'".$vector_pob_p['pob_str_nombre2']."'";
			
			$this->cdi_id		   			= (!isset($vector_pob_p['cdi_id']) or $vector_pob_p['cdi_id'] == "")?"NULL": $vector_pob_p['cdi_id'];
			
			$fecNac_tmp = explode("/", $vector_pob_p['pob_dat_fechaNacimiento']);
			if(count($fecNac_tmp) == 3)
				$this->pob_dat_fechaNacimiento = "'".$fecNac_tmp[2]."-".$fecNac_tmp[1]."-".$fecNac_tmp[0]."'";
				else
				{
					if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de nacimiento se encuentra fuera de formato.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de nacimiento se encuentra fuera de formato.";
				}
			
			$validar_est = $this->getValue("est_id", "estado", array("est_str_referencia", $vector_pob_p['est_id']));
			if($validar_est == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un estado definido.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un estado definido.";
			}
			else
				$vector_pob_p['est_id'] = $validar_est;
			
			$validar_cpo = $this->getValue("cpo_id", "clasificacionpoblacion", array("cpo_num_codigo", $vector_pob_p['cpo_id']));
			if($validar_cpo == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una clasificación correcta (".$vector_pob_p['cpo_id'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una clasificación correcta(".$vector_pob_p['cpo_id'].").";
			}
			else
				$vector_pob_p['cpo_id'] = $validar_cpo;
			
			$validar_niv = $this->getValue("niv_id", "nivel", array("niv_str_referencia", $vector_pob_p['niv_id']));
			if($validar_niv == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un nivel correctamente definido.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un nivel correctamente definido.";
			}
			else
				$vector_pob_p['niv_id'] = $validar_niv;
			
			$validar_are = $this->getValue("are_id", "area", array("are_str_referencia", $vector_pob_p['are_id']));
			if($validar_are == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una area correctamente definida.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una area correctamente definida.";
			}
			else
				$vector_pob_p['are_id'] = $validar_are;
			
			$validar_tno = $this->getValue("tno_id", "tiponovedad", array("tno_str_referencia", $vector_pob_p['tno_id']));
			if($validar_tno == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un tipo de novedad válido(".$vector_pob_p['tno_id'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un tipo de novedad válido(".$vector_pob_p['tno_id'].").";
			}
			else
				$vector_pob_p['tno_id'] = $validar_tno;
			
			$fecForm_tmp = explode("/", $vector_pob_p['pob_dat_fechaFormulario']);
			if(count($fecForm_tmp) == 3)
				$this->pob_dat_fechaFormulario = "'".$fecForm_tmp[2]."-".$fecForm_tmp[1]."-".$fecForm_tmp[0]."'";
				else
				{
					if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de formulario se encuentra fuera de formato(".$vector_pob_p['pob_dat_fechaFormulario'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de formulario se encuentra fuera de formato(".$vector_pob_p['pob_dat_fechaFormulario'].").";
				}
			
			$this->pob_dat_fechaCreacion = date("Y-m-d H:i:s");

			$this->sql = "INSERT INTO ".$this->tabla." (eps_id, tdo_id, pob_str_documento, pob_str_apellido1, pob_str_apellido2, pob_str_nombre1, pob_str_nombre2, sex_id, pob_dat_fechaNacimiento, est_id, cpo_id, niv_id, pob_num_puntaje, are_id, pob_str_serialFormulario, tno_id, pob_dat_fechaFormulario, pob_str_correo, pob_str_telefono, pob_str_direccion, pob_str_observacion, cdi_id, pob_dat_fechaCreacion)
			VALUES (".$vector_pob_p['eps_id'].", ".$vector_pob_p['tdo_id'].", '".$vector_pob_p['pob_str_documento']."', '".$vector_pob_p['pob_str_apellido1']."', '".$vector_pob_p['pob_str_apellido2']."', '".$vector_pob_p['pob_str_nombre1']."', ".$this->pob_str_nombre2.", ".$vector_pob_p['sex_id'].", ".$this->pob_dat_fechaNacimiento.", ".$vector_pob_p['est_id'].", ".$vector_pob_p['cpo_id'].", ".$vector_pob_p['niv_id'].", ".$this->pob_num_puntaje.", ".$vector_pob_p['are_id'].", ".$this->pob_str_serialFormulario.", ".$vector_pob_p['tno_id'].", ".$this->pob_dat_fechaFormulario.", ".$this->pob_str_correo.", '".$vector_pob_p['pob_str_telefono']."', '".$vector_pob_p['pob_str_direccion']."', ".$this->pob_str_observacion.", ".$this->cdi_id.",'".$this->pob_dat_fechaCreacion."')";
			// echo $this->sql."<br><br>";
			$recurso = mysqli_query($this->conexion, $this->sql);
			if ($recurso) { 
				$auditoria                         = new AuditoriaDAO($this->conexion);
				$vector_aud                        = array();
				$vector_aud['str_aud_modulo']      = 'Registro Población';
				$vector_aud['str_aud_controlador'] = 'registro';
				$vector_aud['str_aud_metodo']      = __METHOD__;
				$vector_aud['str_aud_tipo']        = 'CREACION';
				$vector_aud['txt_aud_sql']         = addslashes($this->sql);
				$vector_aud['txt_aud_description'] = 'Registro creado ID='.mysqli_insert_id($this->conexion);
				$vector_aud['str_aud_ip']          = $this->get_client_ip();
				$vector_aud['usr_id']              = $this->usr_id;
				$vector_aud['str_aud_tabla_nombre']= 'poblacion';
				$vector_aud['int_aud_tabla_id']    = mysqli_insert_id($this->conexion);
				$vector_aud['str_aud_data'] 			   = json_encode($vector_pob_p);
				$auditoria->insertAuditoria($vector_aud);
			}
			return true;
		} else {
				if($linea_p != "")
					return "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." existe un registro duplicado.";
					else
						return "- Para el documento No. ".$vector_pob_p['pob_str_documento']." existe un registro duplicado.";
		}
	}

	function deletePoblacion($pob_id_p = "") {
		$this->sql = "DELETE FROM ".$this->tabla." WHERE pob_id = ".$pob_id_p;
		$recurso   = mysqli_query($this->conexion, $this->sql);
		if($recurso){
			$auditoria                         = new AuditoriaDAO($this->conexion);
			$vector_aud                        = array();
			$vector_aud['str_aud_modulo']      = 'Registro Población';
			$vector_aud['str_aud_controlador'] = 'registro';
			$vector_aud['str_aud_metodo']      = __METHOD__;
			$vector_aud['str_aud_tipo']        = 'ELIMINACION';
			$vector_aud['txt_aud_sql']         = addslashes($this->sql);
			$vector_aud['txt_aud_description'] = 'Registro eliminado ID='.$pob_id_p;
			$vector_aud['str_aud_ip']          = $this->get_client_ip();
			$vector_aud['usr_id']              = $this->usr_id;
			$vector_aud['str_aud_tabla_nombre']= 'poblacion';
			$vector_aud['int_aud_tabla_id']	   = $pob_id_p;
			$auditoria->insertAuditoria($vector_aud);
		}
		return $recurso;
	}

	function updatePoblacion($vector_pob_p = array()) {
		if ($this->validateRecord($vector_pob_p['pob_id'], $vector_pob_p['tdo_id'], $vector_pob_p['pob_str_documento'])) {
			$this->pob_num_puntaje          = (!isset($vector_pob_p['pob_num_puntaje']) or $vector_pob_p['pob_num_puntaje'] == "")?"NULL":$vector_pob_p['pob_num_puntaje'];
			$this->pob_str_serialFormulario = (!isset($vector_pob_p['pob_str_serialFormulario']) or $vector_pob_p['pob_str_serialFormulario'] == "")?"NULL":"'".$vector_pob_p['pob_str_serialFormulario']."'";
			$this->pob_str_telefono         = (!isset($vector_pob_p['pob_str_telefono']) or $vector_pob_p['pob_str_telefono'] == "")?"NULL":"'".$vector_pob_p['pob_str_telefono']."'";
			$this->pob_str_direccion        = (!isset($vector_pob_p['pob_str_direccion']) or $vector_pob_p['pob_str_direccion'] == "")?"NULL":"'".$vector_pob_p['pob_str_direccion']."'";
			$this->pob_str_correo           = (!isset($vector_pob_p['pob_str_correo']) or $vector_pob_p['pob_str_correo'] == "")?"NULL":"'".$vector_pob_p['pob_str_correo']."'";
			$this->pob_str_observacion      = (!isset($vector_pob_p['pob_str_observacion']) or $vector_pob_p['pob_str_observacion'] == "")?"NULL":"'".$vector_pob_p['pob_str_observacion']."'";
			//$this->pob_dat_fechaModificacion = date("Y-m-d H:i:s");

			$this->sql = "UPDATE ".$this->tabla." SET eps_id = ".$vector_pob_p['eps_id'].", tdo_id = ".$vector_pob_p['tdo_id'].", pob_str_documento = '".$vector_pob_p['pob_str_documento']."', pob_str_apellido1 = '".$vector_pob_p['pob_str_apellido1']."', pob_str_apellido2 = '".$vector_pob_p['pob_str_apellido2']."', pob_str_nombre1 = '".$vector_pob_p['pob_str_nombre1']."', pob_str_nombre2 = '".$vector_pob_p['pob_str_nombre2']."', sex_id = ".$vector_pob_p['sex_id'].", pob_dat_fechaNacimiento = '".$vector_pob_p['pob_dat_fechaNacimiento']."', est_id = ".$vector_pob_p['est_id'].", cpo_id = ".$vector_pob_p['cpo_id'].", niv_id = ".$vector_pob_p['niv_id'].", pob_num_puntaje = ".$this->pob_num_puntaje.", are_id = ".$vector_pob_p['are_id'].", pob_str_serialFormulario = ".$this->pob_str_serialFormulario.", tno_id = ".$vector_pob_p['tno_id'].", pob_dat_fechaFormulario = '".$vector_pob_p['pob_dat_fechaFormulario']."', cdi_id = ".$vector_pob_p['cdi_id'].", pob_str_correo = ".$this->pob_str_correo.", pob_str_telefono = ".$this->pob_str_telefono.", pob_str_direccion = ".$this->pob_str_direccion.", pob_str_observacion = ".$this->pob_str_observacion." WHERE pob_id = ".$vector_pob_p['pob_id'];
			$recurso   = mysqli_query($this->conexion, $this->sql);
			if($recurso){
				$auditoria                         = new AuditoriaDAO($this->conexion);
				$vector_aud                        = array();
				$vector_aud['str_aud_modulo']      = 'Registro Población';
				$vector_aud['str_aud_controlador'] = 'registro';
				$vector_aud['str_aud_metodo']      = __METHOD__;
				$vector_aud['str_aud_tipo']        = 'ACTUALIZACION';
				$vector_aud['txt_aud_sql']         = addslashes($this->sql);
				$vector_aud['txt_aud_description'] = 'Registro actualizado ID='.$vector_pob_p['pob_id'];
				$vector_aud['str_aud_ip']          = $this->get_client_ip();
				$vector_aud['usr_id']              = $this->usr_id;
				$vector_aud['str_aud_tabla_nombre']= 'poblacion';
				$vector_aud['int_aud_tabla_id']	   = $vector_pob_p['pob_id'];
				$vector_aud['str_aud_data'] 			   = json_encode($vector_pob_p);
				$auditoria->insertAuditoria($vector_aud);
			}
			return $recurso;
		} else {

			return "Registro duplicado";
		}
	}

	function validateRecord($pob_id_p, $tdo_id_p, $pob_str_documento_p) {
		$this->sql = "SELECT pob_id FROM ".$this->tabla." WHERE tdo_id = ".$tdo_id_p." AND pob_str_documento = '".$pob_str_documento_p."'";
		if ($pob_id_p != "") {
			$this->sql .= " AND pob_id <> ".$pob_id_p;
		}

		//echo  "<br/>".$this->sql;
		$recurso = mysqli_query($this->conexion, $this->sql);

		// if(mysqli_error($this->conexion))
			// echo mysqli_error($this->conexion).$this->sql;
		
		$num_rows = mysqli_num_rows($recurso);
		// mysqli_free_result($recurso);
		if ($num_rows == 0) {
			return true;
		} else {

			return false;
		}
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if (getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if (getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if (getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}
	
	function getValue($col_p, $tabla_p, $cond_p)
	{
		$this->sql = "SELECT ".$col_p." FROM ".$tabla_p." WHERE ".$cond_p[0]." = '".$cond_p[1]."' LIMIT 1";

		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = "";
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			// mysqli_free_result($recurso);
			return $fila[$col_p];
		}		
		return $resultado;
		
	}
	
	function reporteador($matrizParametros_p = array(), $orderBy_p = "", $start_p =0, $length_p = 0)
	{
		$this->sql = "SELECT * FROM ".$this->tabla." t1 INNER JOIN eps t2 ON t1.eps_id = t2.eps_id INNER JOIN tipodocumento t3 ON t1.tdo_id = t3.tdo_id INNER JOIN sexo t4 ON t1.sex_id = t4.sex_id INNER JOIN estado t5 ON t1.est_id = t5.est_id INNER JOIN clasificacionpoblacion t6 ON t1.cpo_id = t6.cpo_id INNER JOIN nivel t7 ON t1.niv_id = t7.niv_id INNER JOIN area t8 ON t1.are_id = t8.are_id INNER JOIN tiponovedad t9 ON t1.tno_id = t9.tno_id LEFT JOIN clasificaciondireccion t10 ON t1.cdi_id = t10.cdi_id ";
		$this->where = "";
		
		// echo "<pre> parametros: ";
		// print_r($matrizParametros_p);
		foreach($matrizParametros_p as $indice => $valor)
		{
			if($indice == "pob_num_edad_min" or $indice == "pob_num_edad_max" or $indice=="filtro")
				continue;			
			
			if(is_array($valor))
			{
				if(!empty($valor))
				{
					if($this->where == "")
					{
						foreach($valor as $multiple)
						{
							if($this->where == "")
							{
								if(strpos($indice, "_str_")=== false)
									$this->where = "(t1.".$indice." = ".$multiple;
								else
									$this->where = "(t1.".$indice." = '".$multiple."'";
							}
								else
								{
									if(strpos($indice, "_str_")=== false)
										$this->where .= " OR t1.".$indice." = ".$multiple;
									else
										$this->where .= " OR t1.".$indice." = '".$multiple."'";
								}
						}
						$this->where .= (count($valor) > 0) ? ")" : "";
					}
					else
					{
						$parentesisInicial = true;
						foreach($valor as $multiple)
						{
							if($parentesisInicial)
							{
								$this->where = " AND (t1.".$indice." = ".$multiple;
								$parentesisInicial = false;
							}
							else
								$this->where .= " OR t1.".$indice." = ".$multiple;
						}
						$this->where .= (count($valor) > 0) ? ")" : "";
					}
				}
			}
			else
			{
				if($valor != "")
				{
					if($this->where == "")
						{
						if(strpos($indice, "_str_")=== false)
							$this->where = "t1.".$indice." = ".$valor;
							else
								$this->where = "t1.".$indice." = '".$valor."'";
						}
					else
						{
							if(strpos($indice, "_str_")=== false)
								$this->where .= " AND t1.".$indice." = ".$valor;
								else
									$this->where .= " AND t1.".$indice." = '".$valor."'";
						}
				}
			}
		}
		
		if(isset($matrizParametros_p['pob_num_edad_min']) and $matrizParametros_p['pob_num_edad_min'] != "" and isset($matrizParametros_p['pob_num_edad_max']) and $matrizParametros_p['pob_num_edad_max'] != "")
		{
			$validar = $matrizParametros_p['pob_num_edad_max'] -$matrizParametros_p['pob_num_edad_min'];
			if($validar >= 0)
			{					
				$fecha_minima = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d", (strtotime ('-'.($matrizParametros_p['pob_num_edad_max']+1).' year' , strtotime(date("Y-m-d"))))))));
				
				$fecha_maxima = date("Y-m-d", strtotime('-'.$matrizParametros_p['pob_num_edad_min'].' year' , strtotime(date("Y-m-d"))));
				
				if($this->where == "")
					$this->where = " t1.pob_dat_fechaNacimiento BETWEEN '".$fecha_minima."' AND '".$fecha_maxima."'";
					else
						$this->where .= " AND (t1.pob_dat_fechaNacimiento BETWEEN '".$fecha_minima."' AND '".$fecha_maxima."') ";
			}
		}
		
		
		$this->orderBy = $orderBy_p;
		
		$this->limit = ($length_p == 0) ? "" : " LIMIT ".$start_p.", ".$length_p;
		$this->limit = ($this->limit == "" and $this->tamanoPorPagina != 0) ? " LIMIT ".$this->tamanoPorPagina : $this->limit;
		
		$this->where = ($this->where != "") ? "WHERE ".$this->where : "";
		
		$this->sql .= " ".$this->where." ".$this->orderBy.$this->limit;
		
		//echo $this->sql;
		$recurso = mysqli_query($this->conexion, $this->sql);
		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function depuracionInterna($criterio_p = "")
	{
		switch($criterio_p['criterio_sel'])
		{
			case "Criterio 1":
			$this->sql = "SELECT pob_str_apellido1, pob_str_apellido2, pob_str_nombre1, pob_str_nombre2, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_apellido1,pob_str_apellido2,pob_str_nombre1, pob_str_nombre2, pob_dat_fechaNacimiento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";		
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {				
					
				$where_tmp = "(pob_str_apellido1 = '".$fila['pob_str_apellido1']."' AND pob_str_apellido2 = '".$fila['pob_str_apellido2']."' AND pob_str_nombre1 = '".$fila['pob_str_nombre1']."' AND pob_str_nombre2 = '".$fila['pob_str_nombre2']."' AND pob_dat_fechaNacimiento = '".$fila['pob_dat_fechaNacimiento']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido1, pob_str_apellido2");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}
				
			}			
			
			return $resultado;
			break;
			
			
			case "Criterio 2":
			$this->sql = "SELECT pob_str_apellido1, pob_str_nombre1, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_apellido1, pob_str_nombre1, pob_dat_fechaNacimiento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";	
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
									
				$where_tmp = "(pob_str_apellido1 = '".$fila['pob_str_apellido1']."' AND pob_str_nombre1 = '".$fila['pob_str_nombre1']."' AND pob_dat_fechaNacimiento = '".$fila['pob_dat_fechaNacimiento']."')";
				
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido1, pob_str_nombre1");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}
				
				
			}
						
			return $resultado;
			break;			
			
			case "Criterio 3":
			$this->sql = "SELECT pob_str_apellido2, pob_str_nombre2, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_apellido2, pob_str_nombre2, pob_dat_fechaNacimiento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";			
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
									
				$where_tmp = "(pob_str_apellido2 = '".$fila['pob_str_apellido2']."' AND pob_str_nombre2 = '".$fila['pob_str_nombre2']."' AND pob_dat_fechaNacimiento = '".$fila['pob_dat_fechaNacimiento']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido2, pob_str_nombre2");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}
				
			}			
			
			return $resultado;
			break;			
			
			case "Criterio 4":
			$this->sql = "SELECT pob_str_apellido1, pob_str_apellido2, pob_str_nombre1, pob_str_nombre2 FROM ".$this->tabla." GROUP BY pob_str_apellido1,pob_str_apellido2,pob_str_nombre1, pob_str_nombre2 HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
				
				$where_tmp = "(pob_str_apellido1 = '".$fila['pob_str_apellido1']."' AND pob_str_apellido2 = '".$fila['pob_str_apellido2']."' AND pob_str_nombre1 = '".$fila['pob_str_nombre1']."' AND pob_str_nombre2 = '".$fila['pob_str_nombre2']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido1, pob_str_apellido2,pob_str_nombre1");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}
				
			}
			
			return $resultado;
			break;
									
			case "Criterio 5":
			$this->sql = "SELECT pob_str_apellido1, pob_str_nombre2, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_apellido1, pob_str_nombre2, pob_dat_fechaNacimiento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
									
				$where_tmp = "(pob_str_apellido1 = '".$fila['pob_str_apellido1']."' AND pob_str_nombre2 = '".$fila['pob_str_nombre2']."' AND pob_dat_fechaNacimiento = '".$fila['pob_dat_fechaNacimiento']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido1, pob_str_nombre2, pob_dat_fechaNacimiento");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}				
			}
						
			return $resultado;
			break;
						
			case "Criterio 6":
			$this->sql = "SELECT pob_str_apellido2, pob_str_nombre1, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_apellido2,pob_str_nombre1, pob_dat_fechaNacimiento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
									
				$where_tmp = "(pob_str_apellido2 = '".$fila['pob_str_apellido2']."' AND pob_str_nombre1 = '".$fila['pob_str_nombre1']."' AND pob_dat_fechaNacimiento = '".$fila['pob_dat_fechaNacimiento']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_apellido2, pob_str_nombre1, pob_dat_fechaNacimiento");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}				
			}
						
			return $resultado;
			break;
			
			case "Criterio 7":
			$this->sql = "SELECT pob_str_documento, pob_str_apellido2, pob_str_nombre1, pob_dat_fechaNacimiento FROM ".$this->tabla." GROUP BY pob_str_documento HAVING COUNT(1) >1";
			$recurso = mysqli_query($this->conexion, $this->sql);			
			$sql_tmp = "SELECT * FROM ".$this->tabla." t1 INNER JOIN tipodocumento t2 ON t1.tdo_id = t2.tdo_id INNER JOIN estado t3 ON t1.est_id = t3.est_id INNER JOIN eps t4 ON t1.eps_id = t4.eps_id";
			$where_tmp = "";
			$resultado = array();
			while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {									
				$where_tmp = "(pob_str_documento = '".$fila['pob_str_documento']."')";
				$recurso_tmp = mysqli_query($this->conexion, $sql_tmp." WHERE ".$where_tmp." ORDER BY pob_str_documento");
				while ($fila_tmp = mysqli_fetch_array($recurso_tmp, MYSQLI_ASSOC)) {
					$resultado[]= $fila_tmp;					
				}				
			}
						
			return $resultado;
			break;
			
		}
	}
	
	
	function insertPoblacionTmp($vector_pob_p = array(), $linea_p = "", $sid_p = "") {
		$this->pob_num_puntaje          = (!isset($vector_pob_p['pob_num_puntaje']) or $vector_pob_p['pob_num_puntaje'] == "")?"NULL":str_replace(",", ".", $vector_pob_p['pob_num_puntaje']);
				
		$validar_tdo = $this->getValue("tdo_id", "tipodocumento", array("tdo_str_referencia", $vector_pob_p['tdo_id']));
		if($validar_tdo == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe el tipo de documento indicado (".$vector_pob_p['tdo_id'].").";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe el tipo de documento indicado (".$vector_pob_p['tdo_id'].").";
		}
		else
			$vector_pob_p['tdo_id'] = $validar_tdo;
		
		$validar_eps = $this->getValue("eps_id", "eps", array("eps_str_codigo", $vector_pob_p['eps_id']));
		if($validar_eps == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe la EPS indicada (".$vector_pob_p['eps_id'].").";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe la EPS indicada (".$vector_pob_p['eps_id'].").";
		}
		else
			$vector_pob_p['eps_id'] = $validar_eps;
		
		$validar_sex = $this->getValue("sex_id", "sexo", array("sex_str_referencia", $vector_pob_p['sex_id']));
		if($validar_sex == "")
		{
			if($linea_p != "")		
				return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay sexo definido.";
				else
					return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay sexo definido.";
		}
		else
			$vector_pob_p['sex_id'] = $validar_sex;
		
		
	
		// if ($this->validateRecordTmp("", $vector_pob_p['tdo_id'], $vector_pob_p['pob_str_documento'])) {
			
			$validar_puntaje = ($this->pob_num_puntaje != "NULL")?is_numeric(trim($this->pob_num_puntaje)):$this->pob_num_puntaje;
			if(!$validar_puntaje)
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no existe un valor adecuado para el puntaje del sisben (".$this->pob_num_puntaje.").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no existe un valor adecuado para el puntaje del sisben (".$this->pob_num_puntaje.").";
			}
			
			
			$this->pob_str_serialFormulario = (!isset($vector_pob_p['pob_str_serialFormulario']) or $vector_pob_p['pob_str_serialFormulario'] == "")?"NULL":"'".$vector_pob_p['pob_str_serialFormulario']."'";
			$this->pob_str_telefono         = (!isset($vector_pob_p['pob_str_telefono']) or $vector_pob_p['pob_str_telefono'] == "")?"NULL":"'".$vector_pob_p['pob_str_telefono']."'";
			$this->pob_str_direccion        = (!isset($vector_pob_p['pob_str_direccion']) or $vector_pob_p['pob_str_direccion'] == "")?"NULL":"'".$vector_pob_p['pob_str_direccion']."'";
			$this->pob_str_correo           = (!isset($vector_pob_p['pob_str_correo']) or $vector_pob_p['pob_str_correo'] == "")?"NULL":"'".$vector_pob_p['pob_str_correo']."'";
			$this->pob_str_observacion      = (!isset($vector_pob_p['pob_str_observacion']) or $vector_pob_p['pob_str_observacion'] == "")?"NULL":"'".$vector_pob_p['pob_str_observacion']."'";
			$this->pob_str_nombre2		    = (!isset($vector_pob_p['pob_str_nombre2']) or $vector_pob_p['pob_str_nombre2'] == "")?"' '":"'".$vector_pob_p['pob_str_nombre2']."'";
			
			$this->cdi_id		   			= (!isset($vector_pob_p['cdi_id']) or $vector_pob_p['cdi_id'] == "")?"NULL": $vector_pob_p['cdi_id'];
			
			$fecNac_tmp = explode("/", $vector_pob_p['pob_dat_fechaNacimiento']);
			if(count($fecNac_tmp) == 3)
				$this->pob_dat_fechaNacimiento = "'".$fecNac_tmp[2]."-".$fecNac_tmp[1]."-".$fecNac_tmp[0]."'";
				else
				{
					if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de nacimiento se encuentra fuera de formato.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de nacimiento se encuentra fuera de formato.";
				}
			
			$validar_est = $this->getValue("est_id", "estado", array("est_str_referencia", $vector_pob_p['est_id']));
			if($validar_est == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un estado definido.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un estado definido.";
			}
			else
				$vector_pob_p['est_id'] = $validar_est;
			
			$validar_cpo = $this->getValue("cpo_id", "clasificacionpoblacion", array("cpo_num_codigo", $vector_pob_p['cpo_id']));
			if($validar_cpo == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una clasificación correcta (".$vector_pob_p['cpo_id'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay una clasificación correcta(".$vector_pob_p['cpo_id'].").";
			}
			else
				$vector_pob_p['cpo_id'] = $validar_cpo;
			
			$validar_niv = $this->getValue("niv_id", "nivel", array("niv_str_referencia", $vector_pob_p['niv_id']));
			if($validar_niv == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un nivel correctamente definido.";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un nivel correctamente definido.";
			}
			else
				$vector_pob_p['niv_id'] = $validar_niv;
			
			$validar_are = $this->getValue("are_id", "area", array("are_str_referencia", $vector_pob_p['are_id']));
			if($validar_are == "")
			{
				$vector_pob_p['are_id'] = "NULL";
			}
			else
				$vector_pob_p['are_id'] = $validar_are;
			
			$validar_tno = (isset($vector_pob_p['tno_id']))?$this->getValue("tno_id", "tiponovedad", array("tno_str_referencia", $vector_pob_p['tno_id'])) : "NULL";
			if($validar_tno == "")
			{
				if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un tipo de novedad válido(".$vector_pob_p['tno_id'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." no hay un tipo de novedad válido(".$vector_pob_p['tno_id'].").";
			}
			else
				$vector_pob_p['tno_id'] = $validar_tno;
			
			$fecForm_tmp = (isset($vector_pob_p['pob_dat_fechaFormulario']))?explode("/", $vector_pob_p['pob_dat_fechaFormulario']) : "NULL";
			if(count($fecForm_tmp) == 3)
				$this->pob_dat_fechaFormulario = "'".$fecForm_tmp[2]."-".$fecForm_tmp[1]."-".$fecForm_tmp[0]."'";				
				elseif($fecForm_tmp != "NULL")
				{
					if($linea_p != "")		
					return  "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de formulario se encuentra fuera de formato(".$vector_pob_p['pob_dat_fechaFormulario'].").";
					else
						return  "- Para el documento No. ".$vector_pob_p['pob_str_documento']." la fecha de formulario se encuentra fuera de formato(".$vector_pob_p['pob_dat_fechaFormulario'].").";
				}
				else
					$this->pob_dat_fechaFormulario = $fecForm_tmp;
			
			//$this->pob_dat_fechaModificacion = date("Y-m-d H:i:s");

			$this->sql = "INSERT INTO poblacion_tmp (eps_id, tdo_id, pob_str_documento, pob_str_apellido1, pob_str_apellido2, pob_str_nombre1, pob_str_nombre2, sex_id, pob_dat_fechaNacimiento, est_id, cpo_id, niv_id, pob_num_puntaje, are_id, pob_str_serialFormulario, tno_id, pob_dat_fechaFormulario, pob_str_correo, pob_str_telefono, pob_str_direccion, pob_str_observacion, cdi_id, pob_str_session_id)
			VALUES (".$vector_pob_p['eps_id'].", ".$vector_pob_p['tdo_id'].", '".$vector_pob_p['pob_str_documento']."', '".$vector_pob_p['pob_str_apellido1']."', '".$vector_pob_p['pob_str_apellido2']."', '".$vector_pob_p['pob_str_nombre1']."', ".$this->pob_str_nombre2.", ".$vector_pob_p['sex_id'].", ".$this->pob_dat_fechaNacimiento.", ".$vector_pob_p['est_id'].", ".$vector_pob_p['cpo_id'].", ".$vector_pob_p['niv_id'].", ".$this->pob_num_puntaje.", ".$vector_pob_p['are_id'].", ".$this->pob_str_serialFormulario.", ".$vector_pob_p['tno_id'].", ".$this->pob_dat_fechaFormulario.", ".$this->pob_str_correo.", '".$vector_pob_p['pob_str_telefono']."', '".$vector_pob_p['pob_str_direccion']."', ".$this->pob_str_observacion.", ".$this->cdi_id.", '".$sid_p."')";			
			
			
			// echo $this->sql."<br>";
			$recurso = mysqli_query($this->conexion, $this->sql);
			if ($recurso) { 
				$auditoria                         = new AuditoriaDAO($this->conexion);
				$vector_aud                        = array();
				$vector_aud['str_aud_modulo']      = 'Registro Población Temporal';
				$vector_aud['str_aud_controlador'] = 'registro';
				$vector_aud['str_aud_metodo']      = __METHOD__;
				$vector_aud['str_aud_tipo']        = 'CREACION';
				$vector_aud['txt_aud_sql']         = addslashes($this->sql);
				$vector_aud['txt_aud_description'] = 'Registro creado ID='.mysqli_insert_id($this->conexion);
				$vector_aud['str_aud_ip']          = $this->get_client_ip();
				$vector_aud['usr_id']              = $this->usr_id;
				$vector_aud['str_aud_tabla_nombre']= 'poblacion';
				$vector_aud['int_aud_tabla_id']    = mysqli_insert_id($this->conexion);
				$vector_aud['str_aud_data'] 			   = json_encode($vector_pob_p);
				$auditoria->insertAuditoria($vector_aud);
			}
			else
				echo "Error en la consulta".mysqli_error($this->conexion)."<br><br>";
			return true;
		// } else {
				// if($linea_p != "")
					// return "- En la línea ".$linea_p." para el documento No. ".$vector_pob_p['pob_str_documento']." existe un registro duplicado.";
					// else
						// return "- Para el documento No. ".$vector_pob_p['pob_str_documento']." existe un registro duplicado.";
		// }
	}
	
	
	function validateRecordTmp($pob_id_p, $tdo_id_p, $pob_str_documento_p) {
		$this->sql = "SELECT pob_id FROM poblacion_tmp WHERE tdo_id = ".$tdo_id_p." AND pob_str_documento = '".$pob_str_documento_p."'";
		if ($pob_id_p != "") {
			$this->sql .= " AND pob_id <> ".$pob_id_p;
		}

		//echo  "<br/>".$this->sql;
		$recurso = mysqli_query($this->conexion, $this->sql);

		// if(mysqli_error($this->conexion))
			// echo mysqli_error($this->conexion).$this->sql;
		
		$num_rows = mysqli_num_rows($recurso);
		// mysqli_free_result($recurso);
		if ($num_rows == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function getPoblacionTmp($sid_p)
	{
		$this->sql = "SELECT t1.pob_id, t1.tdo_id, t1.pob_str_documento, t1.pob_str_apellido1, t1.pob_str_apellido2, t1.pob_str_nombre1, t1.pob_str_nombre2, t1.pob_dat_fechaNacimiento, t1.est_id, t1.eps_id, 
		 t2.pob_id as pob_id2, t2.tdo_id as tdo_id2, t2.pob_str_documento as pob_str_documento2, t2.pob_str_apellido1 as pob_str_apellido12, t2.pob_str_apellido2 as pob_str_apellido22, t2.pob_str_nombre1 as pob_str_nombre12, t2.pob_str_nombre2 as pob_str_nombre22, t2.pob_dat_fechaNacimiento as pob_dat_fechaNacimiento2, t2.est_id as est_id2, t2.eps_id as eps_id2 
		 FROM poblacion_tmp t1 LEFT JOIN poblacion t2 ON t1.pob_str_documento = t2.pob_str_documento AND t1.pob_str_apellido1 = t2.pob_str_apellido1 AND t1.pob_str_apellido2 = t2.pob_str_apellido2 AND t1.pob_str_nombre1 = t2.pob_str_nombre1 AND t1.pob_str_nombre2 = t2.pob_str_nombre2 AND t1.tdo_id = t2.tdo_id AND t1.est_id = t2.est_id AND t1.eps_id = t2.eps_id AND t1.pob_dat_fechaNacimiento = t2.pob_dat_fechaNacimiento 
		 WHERE t1.pob_str_session_id = '".$sid_p."' ORDER BY t2.pob_id DESC";
		//echo $this->sql;
		// $this->sql = "SELECT * FROM poblacion_tmp WHERE pob_str_session_id = '".$sid_p."'";
		$recurso = mysqli_query($this->conexion, $this->sql);
		$resultado = array();
		while ($fila_tmp = mysqli_fetch_array($recurso, MYSQLI_ASSOC)){
			$resultado[]= $fila_tmp;					
		}
		return $resultado;
	}
	
	function getPoblacionTmpEps($eps_id_p)
	{
		$this->sql = "SELECT t.* FROM poblacion AS t WHERE t.eps_id ='".$eps_id_p."'  AND t.pob_id NOT IN (
							SELECT t1.pob_id FROM poblacion AS t1 INNER JOIN poblacion_tmp AS t2 ON t1.eps_id = t2.eps_id
							AND t1.tdo_id = t2.tdo_id AND t1.pob_str_documento = t2.pob_str_documento)";
		//echo $this->sql;		
		$recurso = mysqli_query($this->conexion, $this->sql);
		$resultado = array();
		while ($fila_tmp = mysqli_fetch_array($recurso, MYSQLI_ASSOC)){
			$resultado[]= $fila_tmp;					
		}
		return $resultado;
	}
	
	
	function getPoblacionPob_id($tdo_id_p = "" , $pob_str_documento_p ="" ) 
	{
		$this->sql = "SELECT pob_id FROM ".$this->tabla." WHERE 1";		
		
		if ($tdo_id_p != "") {
			$this->sql .= " AND tdo_id = ".$tdo_id_p;
		}
		
		if ($pob_str_documento_p != "") {
			$this->sql .= " AND pob_str_documento = '".$pob_str_documento_p."'";
		}
		
		//echo "<b>".$this->sql."</b>";
		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		// mysqli_free_result($recurso);
		return $resultado;
	}
}
?>
