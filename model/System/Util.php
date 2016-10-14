<?php
/**
 * @class: Util
 * @author: Nestor Ramos
 * @version: 1.0
 * @date: 2015-11-20
 */
class Util
{
  /*
   * @atributos
   */
    
    /*
    * @function: __contructor
    * @author: Nestor Ramos.
    * @description: Este metodo le asigna los valores por defecto para la construccion de la clase.
    * @access: public.
    */
    public function __construct(){
		
    }

    /**
    * @link http://gist.github.com/385876
    */
    function csv_to_array($filename='', $delimiter=';', $filename_original = '')
    {
            if(!file_exists($filename) || !is_readable($filename)){
                    return false;	
            }

            $ext_csv=explode('.', $filename_original);

            if($ext_csv[1]=='csv')
            {	
                    $header = NULL;
                    $data = array();
                    if (($handle = fopen($filename, 'r')) !== FALSE)
                    {
                            while (($row = fgetcsv($handle, 3072, $delimiter)) !== FALSE)
                            {
                                    if(!$header){
                                            $header = $row;
                                    }					
                                    else{
                                            $data[] = array_combine($header, $row);
                                    }

                            }
                            fclose($handle);
                    }
                    return $data;
            }	

            return array();
    }

    /*
    function enviarCorreoRestablecerContrasena($usuario){
        $subject = 'Restablecimiento de contraseña';
        $message = 'Cordial saludo '.$usuario['usr_str_apellidoUsuario'].' '.$usuario['usr_str_nombreUsuario'].',<br/><br/>'
                . 'Su contraseña de acceso se ha restablecido<br/>'
                . 'Sus nuevos datos de acceso son:<br/>'
                . '<b>Usuario:</b>'.$usuario['usr_str_username'].'<br/>'
                . '<b>Contraseña:</b>'.$usuario['usr_str_password'].'<br/>';
        
        $headers = 'From: soporte@copres.xyz' . "\r\n" .
            'Reply-To: nestor.ramos@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        $envio = mail($usuario['usr_str_correoElectronico'], $subject, $message, $headers);
        if($envio) 
        	echo "sent";
        else 
        	var_dump( error_get_last());
    }
    */
	
}
?>