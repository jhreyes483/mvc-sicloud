<?php
class proveedorController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        $this->_view->setJs(array('jquery-3.5.1.min','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }
    //
    public function index(){
        $this->_view->renderizar('index');
    }

    public function pedido(){
        $this->getSeguridad('DFERA');
        $this->_view->renderizar('pedidoproducto');
    }

}
?>