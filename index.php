<?php
ini_set('display_errors', 1);

define('ROOT', realpath(dirname(__FILE__)). '/');

//echo ROOT.'<br>';
//echo dirname(__FILE__);
define('APP_PATH', ROOT . 'application/' );
define('APP_LIBS', ROOT . 'libs/' );
define('APP_CLASS',ROOT.'_controllers/class/');




try{

    require_once APP_LIBS. 'funciones.php';
    require_once APP_PATH. 'Config.php';
    require_once APP_PATH. 'Request.php';
    require_once APP_PATH. 'Bootstrap.php';
    require_once APP_PATH. 'Controller.php';
    @session_start();
  // Controller::ver($_SESSION['usuario'],1);
    if(isset($_SESSION['usuario'])){
     require_once APP_CLASS.'c_notificacion.php';
     require_once APP_CLASS.'c_numerosLetras.php';
    }
    require_once APP_PATH. 'Model.php';
    require_once APP_PATH. 'View.php';
//    require_once APP_PATH. 'Registro.php';
//    require_once APP_PATH. 'DataBase.php';
    require_once APP_PATH. 'Session.php';
    Session::init();
    c_navegacion::run(new Request);

}
catch (Exception $e){
    echo $e->getMessage();
}
?>
