<?php
/*  *********************************************************************
*   Descripci�n: Controlador principal de nuestro framework
+   **********************************************************************/

include_once 'Config.php';

abstract class Controller{
  protected $_view;
  public function __construct() {
    //$this->_view = new View(new Request);
  }
  abstract public function index();

   protected function loadModel($file, $clase=false, $param=''){
    // die('Funcion modelo controller');
     //Controller::ver($file, 1);
      $clase = $clase!==false? $clase:$file; 
      $rutaModelo = ROOT. '_models/'.$file.'.php';
      echo 'ruta modelo  -> '.ROOT;
     
      if(is_readable($rutaModelo)){
      //  die('Funcion modelo controller');
         require_once $rutaModelo;
         $modelo = new $clase($param);
         return $modelo;
      }else{
         throw new Exception('Error de modelo');
      }
  }

  protected function redireccionar($ruta = false){
    if($ruta){
      header('location:' . BASE_URL . $ruta);
      exit;
    }else{
      header('location:' . BASE_URL);
      exit;
    }
  }

  protected function getLibrary($libreria){
    $rutaLibreria = ROOT. 'libs/'. $libreria . '.php';
    if(is_readable($rutaLibreria)){
      require_once $rutaLibreria;
    }else{
      throw new Exception('Error en la libreria');
    }
  }

  protected function getTexto($clave){
    if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
      $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
      return $_POST[$clave];
    }
    return '';
  }

  protected function getDate($clave){
    if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
      return $_POST[$clave];
    }
    return '';
  }

  //filtro para enteros enviados por url
  protected function filtrarInt($int) {
    $int = (int) $int;
    if(is_int($int)){
      return $int;
    }else{
      return 0;
    }
  }
   
  //filtra un entero enviado por post
  protected function getInt($clave){
    if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
      $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
      return $_POST[$clave];
    }
    return 0;
  }
   
  //limpia los string de codigo sql sanitizar la contrasena por post
  protected function getSql($clave) {
  	if(isset($_POST[$clave]) && !empty($_POST[$clave])){
    	$_POST[$clave] = strip_tags($_POST[$clave]);
      return trim($_POST[$clave]);  
  }
}


  //limpia los string de codigo sql sanitizar la contrasena por post
  protected function getSqlSinEspacios($clave) {
  	if(isset($_POST[$clave]) && !empty($_POST[$clave])){
    	$_POST[$clave] = strip_tags($_POST[$clave]);
      return   str_replace(' ', '',  trim($_POST[$clave]));  
  }
}


   //Sanitizar el nombre de usuario por el metodo post
  protected function getAlphaNum($clave) {
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
      $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
      return trim($_POST[$clave]);
    }
  }
   
  // agrega slashes por si envian comillas dobles
  protected function agregaSlashes($texto){
    return addslashes($texto);
  }
   
   
   
  /******************************************************************************
	*	Visualizacion de datos modo local
	*******************************************************************************/

   public static function ver($dato, $sale=0, $bg=0, $tit='', $float= false, $email=''){
      switch ($bg){
         case 1:  $bgColor = 'b0ffff'; break;
         case 2:  $bgColor = 'd0ffb9'; break;
         default: $bgColor = 'ffcfcd'; break;
      }
         echo '<div style="background-color:#' . $bgColor . '; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding: 0 7px 7px 7px; border-radius:7px; margin-top:10px; ">';
         echo '<h2 style="padding: 5px 5px 5px 10px;	margin: 0 -7px; color: #FFF; background-color: #FF6F00; border-radius: 6px 6px 0 0; display:flex"><img src="'.RUTAS_APP['ruta_img'].'debugging.png">&nbsp;Debugging for:&nbsp;&nbsp;<span style="color:black">'.$tit.'</span></h2>';
         if(is_array($dato) || is_object($dato) ){
            echo '<pre>'; 
            print_r($dato); echo '</pre>'; 
         }else{
            if(isset($dato)){
               echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
            }else{
               echo 'LA VARIABLE NO EXISTE';
            }
         }
         echo '</div>';
         if($sale==1) die();
         if($email!='') mail('soporte@itt.com.co', 'SQL', $dato, '');
   }
}
