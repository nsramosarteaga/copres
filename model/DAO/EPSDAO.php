<?php
class EPSDAO
{
	var $eps_id;
	var $eps_str_codigo;
	var $eps_str_nombre;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "eps";
	}
	
	function getEPS($eps_id_p = "")
	{
		$this->sql = "SELECT eps_id, eps_str_codigo, eps_str_nombre FROM ".$this->tabla;
		if($eps_id_p != "")
			$this->sql .= " WHERE eps_id = ".$eps_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function insertEPS($vector_eps_p = array())
	{
		$validarCodigoEPS = $this->getValue("eps_id", $this->tabla, array("eps_str_codigo", $vector_eps_p['eps_str_codigo']));
		
		if($validarCodigoEPS === "")
		{
            $this->sql = "INSERT INTO ".$this->tabla." (eps_str_codigo, eps_str_nombre) VALUES ('".$vector_eps_p['eps_str_codigo']."', '".$vector_eps_p['eps_str_nombre']."')";
            $recurso = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error insertando eps: " . $this->conexion->error;
		}
		else
			return "Error de registro: Ya existe el código que intenta registrar.";
	}
	
	function deleteEPS($eps_id_p = "")
	{
		$validarPob = $this->getValue("pob_id", "poblacion", array("eps_id", $eps_id_p));
		
		if($validarPob === "")
		{
            $this->sql = "DELETE FROM ".$this->tabla." WHERE eps_id = ".$eps_id_p;
            $recurso = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error borrando eps: " . $this->conexion->error;
		}
		else
			return "Error de borrado: Ya existe población con esta EPS.";
            
	}
	
	function updateEPS($vector_eps_p = array())
	{
		$validarCodigoEPS = $this->getValue("eps_id", $this->tabla, array("eps_str_codigo", $vector_eps_p['eps_str_codigo']), array("eps_id", "<>", $vector_eps_p['eps_id']));
		
		if($validarCodigoEPS === "")
		{
            $this->sql = "UPDATE ".$this->tabla." SET eps_str_codigo = '".$vector_eps_p['eps_str_codigo']."', eps_str_nombre = '".$vector_eps_p['eps_str_nombre']."' WHERE eps_id = ".$vector_eps_p['eps_id'];
            $recurso = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error actualizando eps: " . $this->conexion->error;
		}
		else
			return "Error de actualización: Ya existe el código que intenta registrar.";
	}
	
	function getValue($col_p, $tabla_p, $cond_p, $cond_adicional = "")
	{		
		$this->sql = "SELECT ".$col_p." FROM ".$tabla_p." WHERE ".$cond_p[0]." = '".$cond_p[1]."'";
		if($cond_adicional != "")
		{
			$this->sql .= " AND ".$cond_adicional[0]." ".$cond_adicional[1]." ".$cond_adicional[2];
		}
		$this->sql .= " LIMIT 1";
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = "";
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			// mysqli_free_result($recurso);
			return $fila[$col_p];
		}		
		return $resultado;
		
	}
	 
	 
}
?>