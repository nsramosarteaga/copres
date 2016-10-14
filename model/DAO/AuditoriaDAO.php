<?php
class AuditoriaDAO
{
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "auditoria";
	}	
	
	
	function insertAuditoria($vector_aud_p = array())
	{
		$this->sql = "INSERT INTO ".$this->tabla." (str_aud_modulo, str_aud_controlador, str_aud_metodo, str_aud_tipo, txt_aud_sql, txt_aud_description, str_aud_ip, usr_id,str_aud_tabla_nombre,int_aud_tabla_id, str_aud_data) VALUES ('".$vector_aud_p['str_aud_modulo']."', '".$vector_aud_p['str_aud_controlador']."', '".$vector_aud_p['str_aud_metodo']."', '".$vector_aud_p['str_aud_tipo']."', '".$vector_aud_p['txt_aud_sql']."', '".$vector_aud_p['txt_aud_description']."', '".$vector_aud_p['str_aud_ip']."', '".$vector_aud_p['usr_id']."', '".$vector_aud_p['str_aud_tabla_nombre']."', '".$vector_aud_p['int_aud_tabla_id']."', '".$vector_aud_p['str_aud_data']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteAuditoria($aud_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE auditoria_id = ".$aud_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateAuditoria($vector_aud_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET str_aud_modulo = '".$vector_aud_p['str_aud_modulo']."', str_aud_controlador = '".$vector_aud_p['str_aud_controlador']."', str_aud_metodo = '".$vector_aud_p['str_aud_metodo']."', str_aud_tipo = '".$vector_aud_p['str_aud_tipo']."', str_aud_description = '".$vector_aud_p['str_aud_description']."', str_aud_ip = '".$vector_aud_p['str_aud_ip']."', usr_id = '".$vector_aud_p['usr_id']."', str_aud_tabla_nombre='".$vector_aud_p['str_aud_tabla_nombre']."', int_aud_tabla_id='".$vector_aud_p['int_aud_tabla_id']."', str_aud_data = '".$vector_aud_p['str_aud_data']."' WHERE auditoria_id = ".$vector_aud_p['auditoria_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}	 
	
	
	function getAuditoria($auditoria_id_p = null, $str_aud_tabla_nombre_p=null, $int_aud_tabla_id_p=null) {
		$this->sql = "SELECT auditoria_id, str_aud_modulo, str_aud_controlador, str_aud_metodo, str_aud_tipo, txt_aud_sql, txt_aud_description, str_aud_ip, usr_id, dat_aud_fecha, str_aud_tabla_nombre, int_aud_tabla_id, str_aud_data FROM ".$this->tabla." WHERE 1 ";
		
		if (! is_null($auditoria_id_p)) {
			$this->sql .= " AND auditoria_id = ".$auditoria_id_p;
		}
		
		if (! is_null($str_aud_tabla_nombre_p)) {
			$this->sql .= " AND str_aud_tabla_nombre = '".$str_aud_tabla_nombre_p."'";
		}
		
		if (! is_null($int_aud_tabla_id_p)) {
			$this->sql .= " AND int_aud_tabla_id = ".$int_aud_tabla_id_p;
		}
		$this->sql .= " ORDER BY dat_aud_fecha DESC";	
		//echo $this->sql;		
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
