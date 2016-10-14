<?php
class AreaDAO
{
	var $are_id;
	var $are_str_referencia;
	var $are_str_descripcion;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "area";
	}
	
	function getArea($are_id_p = "")
	{
		$this->sql = "SELECT are_id, are_str_referencia, are_str_descripcion FROM ".$this->tabla;
		if($are_id_p != "")
			$this->sql .= " WHERE are_id = ".$are_id_p;
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	 
	 
}
?>