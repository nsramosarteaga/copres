<?php
class ClasificacionDireccionDAO {
	var $cdi_id;
	var $cdi_str_tipo;
	var $cdi_str_nombre;
	private $conexion;
	private $sql;
	private $tabla;

	function __construct($idConexion_p) {
		$this->conexion = $idConexion_p;
		$this->tabla    = "clasificaciondireccion";
	}

	function getClasificacionDireccion($cdi_id_p = "", $cdi_str_tipo_p = "") {
		$this->sql = "SELECT cdi_id, cdi_str_tipo, cdi_str_nombre FROM ".$this->tabla." WHERE 1";

		if ($cdi_id_p != "") {
			$this->sql .= " AND cdi_id = ".$cdi_id_p;
		}

		if ($cdi_str_tipo_p != "") {
			$this->sql .= " AND cdi_str_tipo = '".$cdi_str_tipo_p."'";
		}

		$recurso = mysqli_query($this->conexion, $this->sql);

		$resultado = array();
		while ($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC)) {
			$resultado[] = $fila;
		}
		return $resultado;
	}

	function insertClasificacionDireccion($vector_p = array()) {
            $this->sql = "INSERT INTO ".$this->tabla." (cdi_str_tipo, cdi_str_nombre) VALUES ('".$vector_p['cdi_str_tipo']."', '".$vector_p['cdi_str_nombre']."')";
            $recurso   = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error insertando barrio/vereda: " . $this->conexion->error;
	}

	function deleteClasificacionDireccion($cdi_id_p = "") {
            $this->sql = "DELETE FROM ".$this->tabla." WHERE cdi_id = ".$cdi_id_p;
            $recurso   = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error borrando barrio/vereda: " . $this->conexion->error;
	}

	function updateClasificacionDireccion($vector_p = array()) {
            $this->sql = "UPDATE ".$this->tabla." SET cdi_str_tipo = '".$vector_p['cdi_str_tipo']."', cdi_str_nombre = '".$vector_p['cdi_str_nombre']."' WHERE cdi_id = ".$vector_p['cdi_id'];
            $recurso   = mysqli_query($this->conexion, $this->sql);
            if($recurso===TRUE)
                return $recurso;
            else
                return "Error actualizando barrio/vereda: " . $this->conexion->error;
	}

}
?>