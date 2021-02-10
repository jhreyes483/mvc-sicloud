<?php

class userController extends Controller{

   public function __construct(){
      
      $this->db = $this->loadModel('consultas.sql', 'sql');
      parent::__construct();
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      //$this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
      $this->param = $this->getParam();
   }

   public function index(){
    
      
      $this->_view->datos = $this->db->readUsuarioModel();
      $this->_view->renderizar('index');
      $this->_view->setTable('usuarios', 2, 6);
   }   



   public function validaContraseña($a){
      $passAterior =  $this->db->validarPass( $a[0], $a[1] );
       // validacion de contrase�a en base de datos
          if($passAterior){
              if( $a[2] ==  $a[3] ){
                  $r1 = $this->db->cambioPass( $a[0], $a[3] );
                  if($r1){
                      $_SESSION['message'] = "Cambio contraseña de manera exitosa";
                      $_SESSION['color']   = "success";
                  }
              }else{
                  $_SESSION['message']     = "Campos de contraseña nueva no son iguales";
                  $_SESSION['color']       = "danger";
              }
          }else{
              $_SESSION['message'] = "Contraseña incorrecta";
              $_SESSION['color'] = "danger";
          }
  }


   public function misdatos(){
      $obj = new Session;
      $s = $obj->desencriptaSesion();
      if( isset($_POST) && count($_POST) != 0){
        $b = $this->db->insertUpdateUsuarioCliente([
            $s['usuario']['ID_us'],
            $this->getSql('nom1'),
            $this->getSql('nom2'),
            $this->getSql('ape1'),
            $this->getSql('ape2'),
            $this->getSql('fecha'),
            $this->getSql('correo')
         ]);

         if($b){
            $_SESSION['message'] = 'Acutalizo sus datos'; $_SESSION['color'] = 'success'; 
         }else{
            $_SESSION['message'] = 'Error al actualizar'; $_SESSION['color'] = 'danger'; 
         }
      }

      

      $r = $this->db->selectIdUsuario($s['usuario']['ID_us']);
      if(count($r) != 0 ){
         $this->_view->datos = [  'response_status'=>'ok', 'response_msg' => $r ];
      }else{
         $this->_view->datos= [ 'response_status'=>'error' , 'No hay datos' ];
      }
     // Controller::ver($this->_view->datos);
      $this->_view->renderizar('misdatos');
   }

   public function pass(){
      if( isset($_POST) && count($_POST) != 0){
         $obj = new Session;
         $s = $obj->desencriptaSesion();
         switch ($_POST['accion']) {
            case 'cambioContrasena':
               $this->validaContraseña([ 
                  $s['usuario']['ID_us'],
                  $this->getSql('passA'),
                  $this->getSql('passN'),
                  $this->getSql('passN2')
                  ]);
               break;
            
            default:
               # code...
               break;
         }
      }
      $this->_view->renderizar('cambiopass');
   }



   public function m_destroy(){

   }
}


?>