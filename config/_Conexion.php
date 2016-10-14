<?php
/**
 * @class: Conexion
 * @author: Nestor Ramos
 * @version: 1.0
 */
class Conexion{
  /**
   * @atributos
   * @author: Nestor Ramos
   */
  private $servidor;
  private $usuario;
  private $clave;
  private $base_datos;
  private $id_conexion;
  private $desconexion;
  
  /**
   * @function: __construct
   * @author: Nestor Ramos
   * @description: Esta funcion instancia los datos de la conexión a la base de datos
   * @access: public
   */
  function __construct(){
    $this->servidor="localhost";
    $this->base_datos="copres";
    $this->usuario="copres";
    $this->clave="c0pr3s";
    $this->id_conexion=0;
    $this->desconexion=false;
  }
  /**
   * @function: conectar
   * @author: Nestor Ramos
   * @description: Esta funcion conecta a la aplicacion hecha en php con la base de datos.
   * @access: public
   * @return: int
   */
  function conectar()
  {
    /*x| Abrir una conexión */
    $this->id_conexion = @mysqli_connect($this->servidor,$this->usuario,$this->clave,$this->base_datos);

	if (!$this->id_conexion) {    
		die ( 'Fallo la conexión a MySQL: Error No. ' .mysqli_connect_errno(). ' Descripción: ' . mysqli_connect_error() );	  		
    }
    else
    {
      mysqli_query($this->id_conexion,"SET NAMES 'utf8'");
      return $this->id_conexion;      
    }
  }
  /**
   * @function: desconectar
   * @author: Nestor Ramos
   * @description: Esta funcion desconecta la aplicacion hecha en php de la base de datos, dadpo el identificador de la
   * conexion.
   * @param: $id_conexion
   * @access: public
   * @return: int
   */
  function desconectar($id_conexion){
    $this->desconexion=mysqli_close($id_conexion);
    return $this->desconexion;
  }
  
}
?>
