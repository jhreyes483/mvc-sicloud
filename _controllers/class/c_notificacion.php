<?php
class c_notificacion extends Controller {


   public function __construct(){
      
   }


   public function index()
   {

   }

   public function verNotificaciones(){
      if(isset($_SESSION['usuario'])){
      $db                  = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
      $id_rol              = openssl_decrypt( $_SESSION['usuario']['ID_rol_n'], COD, KEY);
      return               $this->notificacion  = $db->verNotificaciones($id_rol); 
   }
   }

   public function countNotificcacion(){
      return count($this->notificacion);
   }

 }

?>