<?php

class categoriaController extends Controller{

   public function __construct(){
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }

   public function index(){
      $this->getSeguridad('S1CC');
      // crud
      // Eliminar
      if(isset($_GET['d'])){
         $a = [
            $_GET['id']
         ];
          $bA = $this->db->eliminarCategoria($a);
          if($bA){
             $bB = $this->registraLog($_GET['id']  , 6 );
          }
          if($bB){
            $_SESSION['message']    = "Elimino categoria"; 
            $_SESSION['color']      = "success";
            $this->redireccionar('categoria');
         }else{
            $_SESSION['message']    = "Error no elimino";
            $_SESSION['color']      = "danger";  
            $this->redireccionar('categoria');
         }
      }
      // insertar
      if(isset($_POST['accion'])){ 
         switch ($_POST['accion']) {
            case 'insertcategoria':
               $a = [
                  $this->getSql('nom_categoria')
               ];
                $r = $this->db->insertCategoria($a);
                if($r){
                  $_SESSION['message']    = "Registro categoria";
                  $_SESSION['color']      = "success";
                  $this->redireccionar('categoria');    
               }else{
                  $_SESSION['message'] = "Error no creo categoria";
                  $response['contenido']  = $r;
                  $this->redireccionar('categoria');       
               }
            break; 
            // actualiza
            case 'updatecategoria';
               $a = [
                  $this->getSql('id'), 
                  $this->getSql('categoria')
               ];
                $bA = $this->db->actualizarDatosCategoria($a);
                if($bA){
                  $bB = $this->registraLog($this->getSql('id'), 7 );
               }
                if($bB){
                  $_SESSION['message']    = 'Actualizo Categoria '.$_POST['categoria'];
                  $_SESSION['color']      = "success";
               }else{
                  $_SESSION['message'] = 'Error, no Actualizo Actegoria'.$_POST['categoria'];
                  $_SESSION['color']   = "danger";
               }
            break;
         }
      }
      $r = $this->db->verCategoria();
      if( count($r) != 0){
         $this->_view->datos = ['response_status' => 'ok','response_msg'=> $r];
      }else{
         $this->_view->datos = ['response_stutas' => 'error', 'response_msg' => 'No hay registro de categorias'];
      }
      $this->_view->renderizar('index');
      $this->_view->setTable( 'categorias', 1  );
   }

   public function editar(){
      $this->getSeguridad('S1CC');
      $this->_view->datos =  $this->db->verCategoriaId($_POST['id']);
      $this->_view->renderizar('editar');
   }


   

}
