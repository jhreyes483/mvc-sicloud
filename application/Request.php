<?php
/*  *********************************************************************
*   Desarrollado: Javier Reyes                     fecha: 2020-12-17
*   _Descripci�n: Esta clase separa el controlador, el metodo y los argumentos
*   *********************************************************************/

class Request{
    private $_controlador;
    private $_metodo;
    private $_argumentos;

    public function __construct() {
        $url   = $_SERVER['REQUEST_URI'];
     //   echo $_SERVER['REQUEST_URI'].' url<br>';
     //   echo $enlace_actual;
        if(isset ( $url )){
         // $url = filter_input(INPUT_GET, $enlace_actual , FILTER_SANITIZE_URL);
            $url = explode('/', $url);
           // die();
           unset($url[1]);
           $url = array_filter($url);
            $this->_controlador = array_shift($url);
          //  echo $this->_controlador.'  controlador desde requiest <br>';
//            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo    = array_shift($url);
           // echo $this->_metodo.'  metotodo desde requiest <br>';
           // die();
//            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
        }

        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;
        }

        if(!$this->_metodo){
            $this->_metodo = 'index';
        }

        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }
    //retorna el controlador
    public function getControlador(){   // echo $this->_controlador;
        return $this->_controlador;  
    }
    //retorna el metodo
    public function getMetodo(){
        return $this->_metodo;
    }
    //aqui nos hace un arreglo de argumentos
    public function getArgs(){
        return $this->_argumentos;
    }
}
?>
