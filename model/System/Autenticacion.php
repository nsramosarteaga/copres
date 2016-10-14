<?php
/**
 * @class: Autenticacion
 * @author: Nestor Ramos
 * @version: 1.0
 * @date: 2015-04-22
 */
class Autenticacion
{
  /*
   * @atributos
   */
    const cadena_seguridad = "c0pr3sM@riquit4";
    const caracteres_password = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#$%&!*";
    private $codigo_seguridad;
    private $usuario_log;
    private $ruta_servidor;
    private $conexion;
    private $sql;
    /*
    * @function: __contructor
    * @author: Nestor Ramos.
    * @description: Este metodo le asigna los valores por defecto para la construccion de la clase.
    * @access: public.
    */
    public function __construct($conexion,$usuario_log=0){
        $this->codigo_seguridad=sha1($this::cadena_seguridad);	
        $this->modificarIdConexion($conexion);
		$this->ruta_servidor = "http://93.188.167.229/~copres/";
		
        if (! is_null($usuario_log))
			$this->modificarUsuarioLog($usuario_log);
    }
    
    /*
    * @function: obtenerUsuarioLog
    * @author: Nestor Ramos.
    * @param:
    * @description: Este metodo obtiene el usuario que realiza la instancia del objeto usuario.
    * @access: public.
    * @return: integer.
    */
    public function obtenerUsuarioLog(){
        return $this->usuario_log;
    }
    
    /*
    * @function: modificarUsuarioLog
    * @author: Nestor Ramos.
    * @param: $cedula_usuario_log
    * @description: Este metodo modifica la cedula de usuario que realiza la instancia del objeto usuario.
    * @access: public.
    */
    public function modificarUsuarioLog($usuario_log){
        $this->usuario_log=$usuario_log;
    }
   
    /*
    * @function: obtenerIdConexion
    * @author: Nestor Ramos.
    * @param:
    * @description: Este metodo obtiene id_conexion que realiza la instancia del objeto.
    * @access: public.
    * @return: mysqli
    */
    public function obtenerIdConexion(){
        return $this->conexion;
    }
   
    /*
    * @function: modificarIdConexion
    * @author: Nestor Ramos.
    * @param: $conexion
    * @description: Este metodo modifica la id_conexion que realiza la instancia del objeto.
    * @access: public.
    */
    public function modificarIdConexion($conexion){
        $this->conexion=$conexion;
    }
    
	/*
    * @function: obtenerRutaServidor
    * @author: Nestor Ramos.
    * @param:
    * @description: Este metodo obtiene la ruta de la aplicación en el servidor.
    * @access: public.
    * @return: integer.
    */
    public function obtenerRutaServidor(){
        return $this->ruta_servidor;
    }
	
    /*
    * @function: existeUsuario
    * @author: Nestor Ramos.
    * @description: Esta funcion verifica la existencia de un usuario, pasando el username.
    *               Si el usuario existe, la funcion retorna true, en caso contrario retorna false.
    * @access: public
    * @param: $username
    * @return: boolean
    */
    public function existeUsuario($username){
	$sql="SELECT COUNT(usr_id) FROM sis_usuario WHERE usr_str_username='$username'";
        $result = mysqli_query($this->obtenerIdConexion(),$sql);
	$contador=0;
	while($registro=mysqli_fetch_row($result)){
	  $contador=$registro[0];
	}
	if($contador>0)
	  return true;
	else
	  return false;
    }  
    
    /*
    * @function: existeUsuarioActivo
    * @author: Nestor Ramos.
    * @description: Esta función verifica el estado activo de un usuario, pasando el username.
    *               Si el usuario existe, la funcion retorna true, en caso contrario retorna false.
    * @access: public
    * @param: $username
    * @return: boolean
    */
    public function existeUsuarioActivo($username){
        $sql="SELECT COUNT(usr_id) as cantidad FROM sis_usuario WHERE usr_str_username='$username' AND int_estado='1'";
    	$result = mysqli_query($this->obtenerIdConexion(),$sql);
    	while ($fila = mysqli_fetch_array($result)){
    	    $contador = $fila['cantidad'];
    	}
    	if($contador > 0)    	    
    	    return true;
    	else
    	    return false;
    }

    public function generarPassword($password,$auto=false){
        if($auto){
            for($i=0;$i<8;$i++) {
                $password .= substr($this::caracteres_password,rand(0,strlen($this::caracteres_password)),1);
            }
            return $password;
        }else{            
            return sha1($password.$this->codigo_seguridad);
        }
    }
    
    /*
    * @function: autenticacionExitosa
    * @author: Nestor Ramos.
    * @description: Esta funcion verifica la existencia de un usuario y el cumplimiento con el parámetro de la clave.
    *               Si los datos coinciden, la funcion retorna true, en caso contrario retorna false.
    * @access: public
    * @param: $username, $password
    * @return: boolean
    */
    public function autenticacionExitosa($username,$password){
        if($this->existeUsuarioActivo($username))
        {
            $password = $this->generarPassword($password);           
            $sql="SELECT COUNT(usr_id) FROM sis_usuario WHERE usr_str_username='$username' AND usr_str_password='$password'";
			$result = mysqli_query($this->obtenerIdConexion(),$sql);
			$contador=0;
			while($registro=mysqli_fetch_row($result)){
			  $contador=$registro[0];
			}
			if($contador>0){
			$this->iniciarSesion($username);
				return true;
			}else
				return false;
		}
		return false;
    }

    /*
    * @function: iniciarSesion
    * @author: Nestor Ramos
    * @description: Esta funcion inicia las variables de sesion que se utilizan en la aplicacion
    * @access: public
    */
    public function iniciarSesion($username){
	if($this->existeUsuario($username)==true && $this->existeUsuarioActivo($username)==true){

	$sql="SELECT usr_str_username, usr_str_numIdentificacion, usr_str_nombreUsuario, usr_str_apellidoUsuario, usr_str_correoElectronico, rol_id, usr_id
	FROM sis_usuario WHERE usr_str_username='$username'";
        
	$rs=mysqli_query($this->obtenerIdConexion(),$sql);
	while($registro = mysqli_fetch_assoc($rs)){
	    // Asignar nombre a la sesion para poder guardar diferentes datos
	    //session_name("login_usuario");
	    // Inicio la sesion
	    session_start();
	    $_SESSION['username']=$registro['usr_str_username'];
	    $_SESSION['nombre_usuario']=$registro['usr_str_nombreUsuario'];
	    $_SESSION['apellido_usuario']=$registro['usr_str_apellidoUsuario'];
	    $_SESSION['autenticacion']='Aceptada';
	    $_SESSION['correo_usuario']=$registro['usr_str_correoElectronico'];
	    $_SESSION['rol_id']=$registro['rol_id'];
		$_SESSION['usr_id']=$registro['usr_id'];
		$_SESSION['ruta_servidor'] = $this->ruta_servidor;
	    $_SESSION['ultimo_acceso']=time();
		
	    //return $registro[0];
	    // Almacenar LOG
	    //include_once('ClaseAuditoria.php');
	    //$auditoria=new Auditoria($registro[0],$this->obtenerIdConexion());
	    //$auditoria->agregarAuditoria($registro[0],'Ingreso','usuario','cedula_usuario','cedula_usuario',null,$registro[0], $registro[0]);
	}
      //Actualizar último acceso
      //$actualizar_ultimo_accceso=$this->modificarUltimoAccesoUsuario($cedula_usuario,$_SESSION['ultimo_acceso']);
    }
  }

  /**
   * @function: cerrarSesion
   * @author: Nestor Ramos
   * @description: Esta funcion destuye las variables de sesion que se utilizan en la aplicacion
   * @access: public
   */
  public function cerrarSesion(){
    // Almacenar LOG
    //include_once('ClaseAuditoria.php');
    //$auditoria=new Auditoria($this->obtenerCedulaUsuarioLog(),$this->obtenerIdConexion());
    //$auditoria->agregarAuditoria($this->obtenerCedulaUsuarioLog(),'Salida','usuario','cedula_usuario','cedula_usuario',null,$this->obtenerCedulaUsuarioLog(),$this->obtenerCedulaUsuarioLog());
    $_SESSION['username']='';
    unset($_SESSION['username']);
	 $_SESSION['usr_id']='';
    unset($_SESSION['usr_id']);
    $_SESSION['nombre_usuario']='';
    unset($_SESSION['nombre_usuario']);
    $_SESSION['apellido_usuario']='';
    unset($_SESSION['apellido_usuario']);
    $_SESSION['autenticacion']='';
    unset($_SESSION['autenticacion']);
	$_SESSION['ruta_servidor']='';
	unset($_SESSION['ruta_servidor']);
    $_SESSION['correo_usuario']='';
    unset($_SESSION['correo_usuario']);
    $_SESSION['ultimo_acceso']='';
    unset($_SESSION['ultimo_acceso']);
    $_SESSION['id_rol']='';
    unset($_SESSION['id_rol']);
    session_unset();
    session_destroy();
    session_write_close();
  }
  
    function getUsuarioCorreo($usr_str_correoElectronico_p)
    {
        $this->sql = "SELECT usr_id,usr_str_username,usr_str_nombreUsuario,usr_str_apellidoUsuario,usr_str_correoElectronico "
                . "FROM sis_usuario "
                . "WHERE usr_str_correoElectronico='".$usr_str_correoElectronico_p."'";
        //echo $this->sql;
        $recurso = mysqli_query($this->conexion, $this->sql);
        if($recurso !== false){
            $resultado = array();
            while($fila = mysqli_fetch_array($recurso, MYSQLI_ASSOC))
            {
                $resultado[] = $fila;
            }
            return $resultado;
        }
        return false;
    }
    
    function updateContrasena($vector_usuario_p = array())
    {   $vector_usuario_p['usr_str_password'] = $this->generarPassword($vector_usuario_p['usr_str_password']);
        $this->sql = "UPDATE sis_usuario "
        . "SET usr_str_password = '".$vector_usuario_p['usr_str_password']."' "
        . "WHERE usr_str_username = '".$vector_usuario_p['usr_str_username']."'";
        $recurso = mysqli_query($this->conexion, $this->sql);
        if($recurso===TRUE)
            return $recurso;
        else
            return "Error actualizando contraseña: " . $this->conexion->error;
    }
    
}
?>
