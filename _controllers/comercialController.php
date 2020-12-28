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
    public function preventa(){
        $this->getSeguridad('S1F');
        $this->_view->setCss(array('datatables.min'));
        $this->_view->setJs(array('popper.min','datatables.min'));
        if( isset($_POST)  ) extract($_POST);
        if( isset($accion)){
            switch ($accion) {
                case 'anular':
                    // Anula factura
                    $ID= ( isset($ID) )? $ID: $this->session['usuario']['ID_us'] ;
                    $_SESSION['venta']   =  null;
                    $_SESSION['message'] = 'anulo factura';
                    $_SESSION['color']   = 'danger'; 
                    $accion = null; 
                    $this->_view->renderizar('facturacion');
                break;
                case 'agregar':
                    // Agraga producto a factura
                    if (! isset($_SESSION['venta'])){ $_SESSION['venta'] = [];}
                    if(  !in_array( $ID_prod  ,   array_column($_SESSION['venta'] , 0 ) )  ){ 
                        $subTotal = ($cantidad *  $val_prod);
                        $_SESSION['venta'][] = [
                            $ID_prod,
                            $nom_prod,
                            $stok_prod,
                            $cantidad,
                            $val_prod,
                            $Cat,
                            $subTotal
                        ];  
                        $_SESSION['message'] = 'Agrego producto';
                        $_SESSION['color']   = 'success'; 
                        $total =  array_sum(  array_column($_SESSION['venta'] , 6 ) ) ;
                        $letras =  $this->o_numeroLetras->convertirEurosEnLetras($total );
                        //
                        if( $total > 0 ){
                            $this->_view->total = ['response_status' => 'ok' , 'response_msg' => [ $total, $letras ] ];
                        }else{
                            $this->_view->total = ['response_status' => 'error', 'response_msg' => 'No hay datos'];
                        }
                        //
                        $this->facturacion();
                        $accion = null; 
                    }else{
                        $_SESSION['message'] = 'Error, Producto ya existe';
                        $_SESSION['color']   = 'danger'; 
                        $this->facturacion();
                    }
                break;
                case 'eliminar':
                // PENDIENTE
                // Elimina producto de factura
                  unset($_SESSION['venta'][$id_prod]);
                  $this->facturacion();
                break;
                case 'facturarInterno':
                // PENDIENTE
                   $this->facturacion() ;    
                break;      
                default:
                    $this->facturacion()  ;
                break;
            }
        }
    }

    //PENDINTE
    public function facturacion(){
        $this->getSeguridad('S1F');
        // scripts de datatables
        $this->_view->setCss(array('datatables.min'));
        $this->_view->setJs(array('popper.min','datatables.min'));

        $_SESSION['s_cliente'] = (  isset( $_POST['ID'] )  ) ? $_POST['ID'] : $_SESSION['s_cliente'];  
        $datosU = $this->db->selectUsuarios( $_SESSION['s_cliente'] );

        $aProd  = $this->db->verProductos();
        $aPago  = $this->db->verPago();
        $TipoV  = $this->db->verTipoV();
    
     //   if( count($) == 0 ){ //$aC[0] = "Usuario no existe";  return $aC;
         //   $this->_view->datos  = ['response_status' => 'error', 'response_msg' => 'No hay datos' ];
      //  } else{
            $this->_view->datos  = [ 'response_status' =>'ok', 'response_msg' => [
                        $datosU,
                        $aProd,
                        $aPago,
                        $TipoV
                        ]
                    ];  
            //$this->getJson(  $this->db->selectUsuarioFac(6, 1) );  
         
      //  }
        $this->_view->renderizar('facturacion');
    }

}








?>