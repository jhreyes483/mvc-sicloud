<?php

class userController extends Controller{

   public function __construct(){
      
      $this->db = $this->loadModel('consultas.sql', 'sql');
      parent::__construct();
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
      $this->param = $this->getParam();
   }

   public function index(){
      
      
      $this->_view->datos = $this->db->readUsuarioModel();
      $this->_view->renderizar('index');
      $this->_view->setTable('usuarios', 2, 6);
   }   




   public function m_destroy(){

   }
}


?>