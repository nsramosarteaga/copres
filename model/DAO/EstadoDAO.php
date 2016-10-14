<?php
class EstadoDAO
{
	var $est_id;
	var $est_str_referencia;
	var $est_str_descripcion;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "estado";
	}
	
	function getEstado($est_id_p = "")
	{
		$this->sql = "SELECT est_id, est_str_referencia, est_str_descripcion FROM ".$this->tabla;
		if($est_id_p != "")
			$this->sql .= " WHERE est_id = ".$est_id_p;
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function insertEstado($vector_est_p = array())
	{
		$this->sql = "INSERT INTO ".$this->tabla." (est_str_referencia, est_str_descripcion) VALUES ('".$vector_est_p['est_str_referencia']."', '".$vector_est_p['est_str_descripcion']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteEstado($est_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE est_id = ".$est_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateEstado($vector_est_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET est_str_referencia = '".$vector_est_p['est_str_referencia']."', est_str_descripcion = '".$vector_est_p['est_str_descripcion']."' WHERE est_id = ".$vector_est_p['est_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	 
	 
}
?>