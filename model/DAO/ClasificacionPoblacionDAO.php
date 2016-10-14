<?php
class ClasificacionPoblacionDAO
{
	var $cpo_id;
	var $cpo_num_codigo;
	var $cpo_str_descripcion;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "clasificacionpoblacion";
	}
	
	function getClasificacionPoblacion($cpo_id_p = "")
	{
		$this->sql = "SELECT cpo_id, cpo_num_codigo, cpo_str_descripcion FROM ".$this->tabla;
		if($cpo_id_p != "")
			$this->sql .= " WHERE cpo_id = ".$cpo_id_p;
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function insertClasificacionPoblacion($vector_cpo_p = array())
	{
		$this->sql = "INSERT INTO ".$this->tabla." (cpo_num_codigo, cpo_str_descripcion) VALUES (".$vector_cpo_p['cpo_num_codigo'].", '".$vector_cpo_p['cpo_str_descripcion']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteClasificacionPoblacion($cpo_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE cpo_id = ".$cpo_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateClasificacionPoblacion($vector_cpo_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET cpo_num_codigo = ".$vector_cpo_p['cpo_num_codigo'].", cpo_str_descripcion = '".$vector_cpo_p['cpo_str_descripcion']."' WHERE cpo_id = ".$vector_cpo_p['cpo_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	 
	 
}
?>