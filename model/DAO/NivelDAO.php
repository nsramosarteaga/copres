<?php
class NivelDAO
{
	var $niv_id;
	var $niv_str_referencia;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "nivel";
	}
	
	function getNivel($niv_id_p = "")
	{
		$this->sql = "SELECT niv_id, niv_str_referencia FROM ".$this->tabla;
		if($niv_id_p != "")
			$this->sql .= " WHERE niv_id = ".$niv_id_p;
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function insertNivel($vector_niv_p = array())
	{
		$this->sql = "INSERT INTO ".$this->tabla." (niv_str_referencia) VALUES ('".$vector_niv_p['niv_str_referencia']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteNivel($niv_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE niv_id = ".$niv_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateNivel($vector_niv_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET niv_str_referencia = '".$vector_niv_p['niv_str_referencia']."' WHERE niv_id = ".$vector_niv_p['niv_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	 
	 
}
?>