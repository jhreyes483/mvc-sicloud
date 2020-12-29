<?php
class supervisorController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->db       = $this->loadModel('consultas.sql', 'sql');
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }
    //
    public function index(){
        $this->_view->renderizar('index');
    }
    //
    public function consFactura(){
        $this->getSeguridad('S1CF');
        $this->_view->renderizar('consFactura');
    }
    //
    public function consulta(){
        $this->getSeguridad('S1FF');
        if( isset( $_POST['accion']) ){
            switch ($_POST['accion']){
                case 'consFactura':
                    $this->verFactura($_POST['f']);
                break;
            }
        }
    }
    //
    public function verFactura($id){
        $aFactura = $this->db->verFactura($id);
        if( count($aFactura) == 0){
          $this->_view->factura =  ['response_status'=> 'error', 'response_msg' => 'No existe factura' ];
        }else{
            $aProd = $this->db->consProductosFactura($id);
            $this->_view->factura =  ['response_status' => 'OK', 'response_msg' => [
                    $aFactura,
                    $aProd
                ]
            ];
        }
        $this->_view->renderizar('factura');
    }

    // PENDINTE CIFRAS A LETRAS
    public function facturas(){
        $this->getSeguridad('S1FF');
        if (isset($_POST['consulta'])) {
            extract($_POST);
            $r           = $this->db->verIntervaloFecha($f1, $f2);
            //$v            = new CifrasEnLetras();
            //Convertimos el total en letras
            //$letra = ($v->convertirEurosEnLetras($total));
            if( count($r) != 0 ){
                $total       = array_sum( array_column($r , 11));
                $this->_view->facturas = ['response_status' => 'ok', 'response_msg' => [$r, $total ] ];
            }else{
                $this->_view->facturas = ['response_status' => 'error', 'response_msg' => 'No hay facturas en el rango de fechas' ];
            }
        }
        $this->_view->renderizar('infVentas');
        $this->_view->setTable('facturas', 0);
    }
}
?>