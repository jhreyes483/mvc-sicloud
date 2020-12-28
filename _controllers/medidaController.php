<?php
class medidaController extends Controller{


   public function __construct(){
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }
   //
   public function index(){
      $this->getSeguridad('S1CM');
      if(isset($_POST['accion'])){
         switch ($_POST['accion']) {
            case 'insertMedida':
               $a = [
                  $this->getSql('nom_medida'),
                  $this->getSql('acron_medida')
               ];
                $b = $this->db->insertMedia($a);
                if($b){
                  $_SESSION['message']  = 'Creo unidad medida';
                  $_SESSION['color']    = 'success';
               }else{
                  $_SESSION['message']  = "Error, no creo unidad de medida";
                  $_SESSION['color']    = 'danger';
               }         
            break;
            case 'UdateMedia':
               $a = [
                  $this->getSql('id'),
                  $this->getSql('nom'),
                  $this->getSql('acron')
               ];
                $bA = $this->db->actualizarDatosMedida($a);
                if($bA){
                   $bB = $this->registraLog($this->getSql('id'),11);
                }
                if($bB){
                  $_SESSION['message'] = 'Actualizar medida';
                  $_SESSION['color']      = 'success';
               }else{
                  $_SESSION['message'] = 'Error, Al actualizar medida no debe tener "" por seguridad';
                  $_SESSION['color']      = 'danger';
               }
            break;
         }
      }
      if( isset($_GET['d'])){ // si existe eliminar medida
         $a = [
            $_GET['id'],
         ];
         //
         $bA = $this->db->eliminarDatosMedia($a);
         if($bA){
           $bB = $this->registraLog($this->getSql('id'),10);
         }
         //
         if($bB){
           $_SESSION['message'] = 'Elimino medida';
           $_SESSION['color']   = 'success';
         }else{
            $_SESSION['message'] = "Error, no creo unidad de medida";
            $_SESSION['color']   = 'danger';
         }
         $this->redireccionar('medida');
      }
      //
      $r  = $this->db->verMedida();
      if( count($r) != 0 ){
         $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay registro de empresa' ];
      }
      $this->_view->renderizar('index');
      $this->_view->setTable('medidas', 0, 2 );
   }
   //
   public function edit(){
      $this->getSeguridad('S1CM');
      $r = $this->db->verMedidaPorId($_POST['id']);
      if( count($r) != 0 ){
         $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay registro de empresa' ];
      }
      $this->_view->renderizar('editar');
   }
}
