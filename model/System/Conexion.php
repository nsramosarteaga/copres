<?php
class Conexion{
  
  private $servidor;
  private $usuario;
  private $clave;
  private $baseDatos;
  private $conexion;
  private $desconexion;
 
 
  function __construct(){
	
		$this->servidor="localhost";
		$this->baseDatos="copres_mariquita";
		$this->usuario="copres_mariquita";
		$this->clave="c0pr3s";
		$this->conexion=false;
		$this->desconexion=false;
		
  }

  function conectar()
  {
    $this->conexion = mysqli_connect($this->servidor,$this->usuario,$this->clave,$this->baseDatos);

    if (!$this->conexion)
		die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		else
		{
		  mysqli_query($this->conexion,"SET NAMES 'utf8'");
		  return $this->conexion; 
		}
  }

  function desconectar($idConexion_p){
    $this->desconexion=mysqli_close($idConexion_p);
    return $this->desconexion;
  }

  function obtenerIdConexion(){
    return $this->conexion;      
  }

  function obtenerNombreServidor(){
    return $this->servidor;
  }

  function obtenerBaseDatos(){
    return $this->baseDatos;
  }
  
  function obtenerNombreUsuario(){
    return $this->usuario;
  }

  function obtenerClaveUsuario(){
    return $this->clave;
  }
}
?>
