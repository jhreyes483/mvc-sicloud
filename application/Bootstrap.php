<?php
/*  *********************************************************************
 *   Desarrollado: JCPI                      fecha: 2015-10-20
 *   Descripci�n: Esta clase llama los controladores, metodos
 * 	y abre la plantilla en el editor.
 *		*********************************************************************/

class c_navegacion {
   public static
   function run( Request $peticion ) {
      $controller = $peticion->getControlador() . 'Controller';
     // echo $controller.'   bootstrap <br>';
      $rutaControlador = ROOT . '_controllers/' . $controller . '.php';
      //die($rutaControlador);
      $metodo = $peticion->getMetodo();
      $args = $peticion->getArgs();
      if(is_readable( $rutaControlador)) {
         //die("$controller $metodo");
         require_once $rutaControlador;
         $controller = new $controller;
         if ( is_callable( array( $controller, $metodo ) ) ) {
            $metodo = $peticion->getMetodo();
         } else {
            $metodo = 'index';
         }
         if ( isset( $args ) ) {
            call_user_func_array( array( $controller, $metodo ), $args );
         } else {
            call_user_func( array( $controller, $metodo ) );
         }
      } else {
         throw new Exception( 'No encontrada la ruta que resuelve' );
      }
   }
}
?>