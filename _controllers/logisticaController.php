<?php

class logisticaController extends Controller
{

   public function __construct(){
      parent::__construct();
      $this->db            = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
   }


   public function alertas(){
      $this->_view->renderizar('alertas');
   }

   public function cantidad(){
         $this->getSeguridad('S1CT');
         $r = $this->db->ConteoProductosT();
         $this->_view->datos = [
            $r,
            (array_sum( array_column( $r, 1  ) ))
         ];
   
         $this->_view->renderizar('cantidadProductos');
         $this->_view->setTable('cantidad', 1);
   }

   public function categoria(){
         $this->getSeguridad('S1CG');
         $this->_view->datosF = $this->db->verCategorias();
         if(isset($_POST['accion'])  && $_POST['accion'] == 'filtroCategoria'){
            $r  = $this->db->verPorCategoria($_POST['p']);
            if( count($r)!= 0  ){
               $this->_view->datos  = [ 'response_status' => 'ok', 'response_msg' => $r ];
            }else{
               $this->_view->datos  = [ 'response_status' => 'error', 'response_msg' => 'No hay productos' ];
            }
         }
         $this->_view->renderizar('categorias');
         $this->_view->setTable('productos', 1);
   }

   public function index(){
      $this->issetSession();
      $this->_view->renderizar('index');
      if(isset($_GET['edit'])){
         echo "hola";
      }
   }
 
   // vista


   // vista
   public function solicitud(){
      $this->getSeguridad('S1CS');
      $this->_view->renderizar('logistica-solicitud');
   }   


}
