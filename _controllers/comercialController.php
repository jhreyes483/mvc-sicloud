<?php
class comercialController extends Controller{

    public function __construct(){
        parent::__construct();
        require_once ROOT.'_controllers/class/c_numerosLetras.php';
        $this->o_numeroLetras = new C_numerosLetras;
       // Controller::ver($this->m_numeroLetras);
        $this->s        = new Session;
        $this->session  = $this->s->desencriptaSesion();
        $this->db       = $this->loadModel('consultas.sql', 'sql');
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        $this->_view->setJs(array('jquery-1.9.0','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery','tablesorter-master/jquery.tablesorter'));
    }

    public function index(){
        $this->_view->renderizar('index');
    }

    public function puntos(){
       $this->getSeguridad('S1P');
            $r = $this->db->verPuntosUs();
            if( count($r) != 0  ){
               $this->_view->datos = [ 'response_status' => 'ok', 'response_msg' => $r ];
            }else{
                $this->_view->datos = ['response_status' => 'error' , 'response_msg' => 'no hay datos'];
            }
            $this->_view->renderizar('acomulaciondepuntos');
            $this->_view->setTable('puntos', 2, 0);
    }

    //*********************************************************/
    // Facturacion - interna
    //*********************************************************/
    // agrega producto de array pre venta



}








?>