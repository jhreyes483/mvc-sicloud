<?php

class logisticaController extends Controller
{

   public function __construct(){
      parent::__construct();
      $this->db            = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
   }


      // vista
   public function alertas(){
      // falta 
      $this->_view->renderizar('alertas');
   }

      //vista
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

   // vista
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

   public function crearProductos(){
      $this->getSeguridad('S1PCL');
      $c =  $this->db->verCategorias();
      $m =  $this->db->verMedida();
      $e =  $this->db->verProveedor();
      $p =  $this->db->verProductos();
      $this->_view->datos = [$c, $m, $e, $p];

      if (isset($_POST['accion'])) {
         switch ($_POST['accion']) {
            case 'inserProducto':
               $a = [
                  $this->getSql('ID_prod'),
                  $this->getSql('nom_prod'),
                  $this->getSql('val_prod'),
                  $this->getSql('stok_prod'),
                  $this->getSql('estado_prod'),
                  $this->getSql('CF_categoria'),
                  $this->getSql('CF_tipo_medida'),
                  $_FILES['foto']['name'],
                  $_FILES['foto']['tmp_name'],
                  $this->getSql('descripcion')
               ];
               //Copia foto de producto
               $destino = 'public/layout1/img/prod/'.$_FILES['foto']['name']; // verificar si copio
               copy($_FILES['foto']['tmp_name'] , $destino); 
               $result = $this->db->insertarProducto($a);
               if (!$result) {
                  $response['error']      = true;
                  $response['menssage']   = $_SESSION['message'] = 'No inserto producto';
                  $response['contenido']  = $result;
                  $_SESSION['color']      = 'Danger';
               } else {
                  $response['error']      = false;
                  $response['message']    = $_SESSION['message'] = 'Inserto producto';
                  $response['contenido']  = $result;
                  $_SESSION['color']      = 'success';
               }
               break;
         }
      }

      $this->_view->renderizar('crearProductos');
   }

   public function index(){
      $this->_view->renderizar('index');
      if(isset($_GET['edit'])){
         echo "hola";
      }
   }

   // vista
   public function ingreso(){
      $this->getSeguridad('S1PL');
      $p =  $this->db->verProductos();
      $this->_view->datosF = [ $p  ];
      if (isset($_POST['accion'])) {
         $b=null;
         if(!isset($_POST['p'])){
            $r = $this->db->verJoin(2041172460);
         }

         switch ($_POST['accion']) {            
            case 'busquedaProducto':
               $r = $this->db->verJoin($_POST['p']);
            break;
            case 'IngresarCantidad':
               $a =[
                  ($this->getSql('cantidad')  + $this->getSql('stok')),
                  $_POST['id'],
               ];
               $b = $this->db->inserCatidadProducto( $a );
               if($b == 1){
                  $_SESSION['message'] = 'Registro entrega'; $_SESSION['color'] = 'success';
               } 
            break;
            
            default:
            Controller::ver($_POST);
            die('DEFAULT');
            break;
         }
      }else{
         $r = $this->db->verJoin($_POST['p']??'1557972591');
      }

      if( isset($r) &&  count($r) != 0){
         $this->_view->datos =['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos =['response_status' => 'error', 'response_msg' => 'No hay datos'];
      }  
      $this->_view->renderizar('ingresoProducto');
   }

   // vista
   public function productos(){
      $r = $this->db->verProductos();
      if( isset($_POST['accion']) ){
         switch ($_POST['accion']) {
            case 'EliminarProducto':
               $b= $this->db->EliminarProducto($this->getSql('id'));
               if(!$b){
                  $response['menssage']   = $_SESSION['message'] = 'No elimino producto';
                  $_SESSION['color']      = 'danger';
               }else{
                  $response['message']    = $_SESSION['message'] = 'Elimino producto'; 
                  $_SESSION['color']      = 'success';
               }
            break;
         }
      }else{

      }

      if(isset($r)  && count($r) != 0){
         $this->_view->datos = ['response_status'=>'ok', 'response_msg'=>$r];
      }else{
         $this->_view->datos = ['response_status'=>'error', 'response_msg'=>'No hay datos'];
      }
      $this->_view->renderizar('edicionProducto');
      $this->_view->setTable('stock', 2, 0);
   }

   // vista
   public function solicitud(){
      $this->getSeguridad('S1CS');
      $this->_view->renderizar('logistica-solicitud');
   }

   // vista
   public function unitEdit(){
         $producto   =  $this->db->verProductosId($_POST['id']);
         $categorias =  $this->db->verCategorias();
         $medida     =  $this->db->verMedida();
         $provedor   =  $this->db->verProveedor();
         $estado     =[ 'estandar'  , 'promocion' ]; 
         if( count($categorias) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
         if( count($categorias) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
         if( count($medida    ) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de medida' ];
         if( count($producto  ) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'El producto no existe' ];
         $this->_view->datos =  [ 'response_status' => 'ok', 'response_msg' =>  [$categorias , $medida, $provedor, $producto , $estado] ];

         if( isset( $_POST['accion'] )){
            $this->getSeguridad('S1PLE');
            switch ($_POST['accion']) {
               case'updateProducto':
                     $a = [
                        $this->getSql('ID_prod'), // 0
                        $this->getSql('nom_prod'), // 1
                        $this->getSql('val_prod'), // 2
                        $this->getSql('stok_prod'), // 3
                        $this->getSql('estado_prod'), // 4
                        $this->getSql('CF_categoria'), // 5
                        $this->getSql('CF_tipo_medida') // 6
                        ];
                     
                     $r = $this->db->editarProducto($a);
                     if($r){
                        $_SESSION['message'] = 'Edito producto '.$this->getSql('nom_prod').' de manera exitoza';
                        $_SESSION['color']      = 'success';
                     }else{
                        $_SESSION['message'] = 'Error al editar producto '.$this->getSql('nom_prod'); 
                        $_SESSION['color']      = 'danger';
                     }
               break;

            }
         }
         $this->_view->renderizar('unitEditProducto');
      } 










   


}
