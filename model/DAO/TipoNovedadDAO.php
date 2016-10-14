<?php
class TipoNovedadDAO
{
	var $tno_id;
	var $tno_str_referencia;
	var $tno_str_descripcion;
	private $conexion;
	private $sql;
	private $tabla;
	
	function __construct($idConexion_p){
		$this->conexion = $idConexion_p;
		$this->tabla = "tiponovedad";
	}
	
	function getTipoNovedad($tno_id_p = "")
	{
		$this->sql = "SELECT tno_id, tno_str_referencia, tno_str_descripcion FROM ".$this->tabla;
		if($tno_id_p != "")
			$this->sql .= " WHERE tno_id = ".$tno_id_p;
		
		$recurso = mysqli_query($this->conexion, $this->sql);
		
		$resultado = array();
		while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
		{
			$resultado[] = $fila;
		}
		return $resultado;
	}
	
	function insertTipoNovedad($vector_tno_p = array())
	{
		$this->sql = "INSERT INTO ".$this->tabla." (tno_str_referencia, tno_str_descripcion) VALUES ('".$vector_tno_p['tno_str_referencia']."', '".$vector_tno_p['tno_str_descripcion']."')";
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function deleteTipoNovedad($tno_id_p = "")
	{
		$this->sql = "DELETE FROM ".$this->tabla." WHERE tno_id = ".$tno_id_p;
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	
	function updateTipoNovedad($vector_tno_p = array())
	{
		$this->sql = "UPDATE ".$this->tabla." SET tno_str_referencia = '".$vector_tno_p['tno_str_referencia']."', tno_str_descripcion = '".$vector_tno_p['tno_str_descripcion']."' WHERE tno_id = ".$vector_tno_p['tno_id'];
		$recurso = mysqli_query($this->conexion, $this->sql);		
	}
	 
	 
}
?>