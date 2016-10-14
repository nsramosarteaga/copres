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
		$this->sql = "INSERT INTO ".$this->tabla." (eps_str_codigo, eps_str_nombre) VALUES ('".$vector_eps_p['eps_str_codigo']."', '".$vector_eps_p['eps_str_nombre']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteEPS($eps_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE eps_id = ".$eps_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateEPS($vector_eps_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET eps_str_codigo = '".$vector_eps_p['eps_str_codigo']."', eps_str_nombre = '".$vector_eps_p['eps_str_nombre']."' WHERE eps_id = ".$vector_eps_p['eps_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	 
	 
}
?>