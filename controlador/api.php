<?php

include_once 'controladorrutas.php';
conficController();

require_once '../controlador/controlador.php';
require_once '../controlador/controladorsession.php';

class apiController extends Controller{
protected $db;

public function __construct(){
   parent::__construct();
   $this->db  = new ControllerDoc();
   $this->getApi();
}

public function index(){
   die('Error, metodo index en api no definido');
}
              
 public function isTheseParametersAvailable($params){
   $avaible = true;
   $missingparams = '';

   foreach($params as $param){
      if(!isset($_POST[$param]) || strlen($_POST[$param]) <=0 ){
         $avaible = false;
         $missingparams = $missingparams.','.$param;
      }
   }
   // Si faltan parametros
   if(!$avaible){
      $response =[];
      $response['error'] = true;
      $response['message'] = 'Parametros:'.substr($missingparams, 1, strlen($missingparams)).'vacion'; 
      // Error de visualizacion
      echo json_encode($response);
      // detener la ejecucion adicional
      die();
   }
}



public function getApi(){
   //Una matriz que muestra la respuesta de la api
   $response = [];
   /*
   Si se trata de una llamada api
   que significa que un parameetro get llamado se establece una URL
   y con estos parametros estamos concluyendo que es una llamada api
   */
if(isset($_GET['apicall'])){
   // Aqui van todos los llamados de la api
   switch ($_GET['apicall']) {
      // Opcion crear usuarios
      case 'createusuario':
      // Primero haremos la verificacion de parametros.
     $this->isTheseParametersAvailable(  [ 'ID_us','nom1','nom2', 'ape1', 'ape2','fecha', 'pass', 'correo','FK_tipo_doc' ]  );
     //  = new ControllerDoc();
      $result = $this->db->createUsuariosController(
         $this->getSql('ID_us'), 
         $this->getSql('nom1'),
         $this->getSql('nom2'),
         $this->getSql('ape1'),
         $this->getSql('ape2'),
         $this->getSql('fecha'),    
         $this->getSql('pass'),
        // $_POST['foto'],
         $_FILES['foto']['name'],
         $this->getSql('correo'),
         $this->getSql('FK_tipo_doc'),
         $this->getSql('FK_rol'),
         date('Y-m-d'),
         0,
         $_FILES['foto']['tmp_name'],
         $this->getSql('tel')
      );  
      if($result){
         //esto significa que no hay ningun error
         $response['error']    = false;
         $_SESSION['message']  = $response['message'] = 'Usuario agregado correctamente';
         $_SESSION['color']    = "success";
      }else{ 
         $response['error']    = true;
         $_SESSION['message']  = $response['message'] = 'ocurrio un error, intenta nuevamente';
         $_SESSION['color']    = "danger";
      }
      header( 'location:  ../index.php');
      break;
      case 'readusuario';
         $response['error']     = false;
         $response['message']   = 'Solicitud completada correctamente';
         $response['contenido'] = $this->db->readUsuariosController();
      break;
      case 'elimianarUsuario';
         $bool =   $this->db->eliminarUsuario( $_GET['id'] );
         if( $bool ){
            $response['error']   =  false;
            $response['message'] =  $_SESSION['message'] = 'Elimino usuario de manera exitosa';
            $_SESSION['color']   = 'success';
         }else{
            $response['error']    =  true;
            $response['message']  = $_SESSION['message'] ='No elimino usuario';
            $_SESSION['color']    = 'danger';

         }
       echo "<script>window.location.replace('../vista/TablaUsuario.php')</script>"; 
      break;        
      case 'actualizarUsuario';
         $array =
         [  
            $this->getSql('ID_us'), 
            $this->getSql('nom1'),
            $this->getSql('nom2'),
            $this->getSql('ape1'),
            $this->getSql('ape2'),
            $this->getSql('fecha'),    
            '',
            $this->getSql('foto'),    
            $this->getSql('correo'),
            $this->getSql('FK_tipo_doc'),
            $this->getSql('FK_rol')
         ];

        Controller::ver($array, 1);
         $bool1 =   $this->db->actualizarDatosUsuario($_GET['id'], $array );
         if( $bool1 ){
           $response['error']    = false;
           $response['message']  = $_SESSION['message']  = "Actualizo usuario";
           $_SESSION['color']    = "success";
         }else{
           $response['error']    = true;
           $response['message']  = $_SESSION['message']  = "Error no actualizo usuario"; 
           $_SESSION['color']    = "danger";
         }

         header( 'location:  ../vista/CU009-controlUsuarios.php?documento='.$_GET['id'].'&accion=bId');
      break;
      case 'loginusuario':
        $this->isTheseParametersAvailable( ['nDoc', 'pass', 'tDoc'] );
         $result = $this->db->loginUsuarioController(
            $this->getSqlSinEspacios('nDoc'),
            $this->getSqlSinEspacios('pass'),
            $this->getSqlSinEspacios('tDoc'));
         if(!$result){
            $response['error']     = true;
            $response['menssage']  = $_SESSION['message'] = 'Credenciales no validas';
            $_SESSION['color']     = "danger";
         }else{
            $response['error']      = false;
            $_SESSION['color']      = "success";
            $response['contenido']  = $result;
         }
      break;
      case 'activarCuenta':
         $result = $this->db->activarCuenta($_GET['id'] );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message']    = 'No activo cuenta';
            $_SESSION['color']      = 'danger';
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message']    = 'Activo cuenta';
            $response['contenido']  = $result;

            $_SESSION['color']      = 'success';
         }
         header( 'location:  ../vista/CU009-controlUsuarios.php');
      break;
      case 'desactivarUsuario':
         $result = $this->db->desactivarCuenta($_GET['id'] );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message'] = 'No desactivo cuenta';
            $response['contenido']  = $result;
            $_SESSION['color']      =  'danger';
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message'] = 'Desactivo cuenta';
            $response['contenido']  = $result;
            $_SESSION['color']      =  'success';
            header( 'location:  ../vista/CU009-controlUsuarios.php');
         }
      break;
      // insertar producto modulo - CU004-crearproductos.php
      case 'insertProducto':
         $a =[
            $this->getSql('ID_prod'),
            $this->getSql('nom_prod'),
            $this->getSql('val_prod'),
            $this->getSql('stok_prod'),
            $this->getSql('estado_prod'),
            $this->getSql('CF_categoria'),
            $this->getSql('CF_tipo_medida'),
            $_FILES['foto']['name'],
            $_FILES['foto']['tmp_name']

         ];
         $result = $this->db->insertarProducto( $a );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message'] = 'No inserto producto';
            $response['contenido']  = $result;
            $_SESSION['color']      = 'Danger';
            
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message'] = 'Inserto producto'; 
            $response['contenido']  = $result;
            $_SESSION['color']      = 'success';
         }
         header( 'location:  ../vista/CU004-crearProductos.php');
      break;

      case 'IngresarCantidad':
          //$cant, $stock, $id
         $a =[
            $this->getSql('cantidad'),
            $this->getSql('stok'),
            $_GET['id'],
         ];
         $result = $this->db->inserCatidadProducto( $a );
         if($result){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message'] = 'Registro entrega';
            $response['contenido']  = $result;
            $_SESSION['color']      = 'success';
            
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message'] = 'Error, no registro entrega'; 
            $response['contenido']  = $result;
            $_SESSION['color']      = 'danger';
         }
         header( 'location:  ../vista/CU003-ingresoProducto.php');
      break;





      
      
      case 'eliminarTelefono':
         $r= $this->db->eliminarTelefono($_GET['id']);
         if($r){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message'] = 'No elimino telefono';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'danger';
            
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message'] ='Elimino telefono'; 
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';
         }
      break;

  
      case 'eliminarCategoria':
         $a = [
            $_GET['id']
         ];
          $r = $this->db->eliminarCategoria($a);
          if(!$r){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message']  = "Error no creo categoria";
            $response['contenido']  = $r;
            $_SESSION['color']      = "danger";
            
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message']    = "Elimino categoria"; 
            $response['contenido']  = $r;
            $_SESSION['color']      = "success";
         }
      header( 'location:  ../vista/formCategoria.php');
      break;

      case 'eliminarEmpresa':
         $a = [
            $_GET['id']
         ];
          $r = $this->db->eliminarEmpresa($a);
          if($r){
            $response['error']      = true;
            $response['menssage']   = $_SESSION['message'] = "Elimino empresa";
            $response['contenido']  = $r;
            $_SESSION['color']      = "success";
         }else{
            $response['error']      = false;
            $response['message']    = $_SESSION['message'] = "Error no elimino empresa";
            $response['contenido']  = $r;
            $_SESSION['color']      = "danger";
         }
      header( 'location:  ../vista/formEmpresa.php');
      break;
  
    
      case 'eliminarMedida':
         $a = [
            $_GET['id'],
         ];
  
          $r = $this->db->eliminarDatosMedia($a);
          if($r){
            $response['error']      = false;
            $response['menssage']   = $_SESSION['message'] = 'Elimino medida';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';
         }else{
            $response['error']      =  true;
            $response['message']    = $_SESSION['message'] = "Error, no creo unidad de medida";
            $response['contenido']  = $r;
            $_SESSION['color']      = 'danger';
         }
      header( 'location:  ../vista/formMedida.php');
      break;
 
      case 'actualizarDatosPers':
         $a = [
            $_GET['id'],
            $this->getSql('nom1'),
            $this->getSql('nom2'),
            $this->getSql('ape1'),
            $this->getSql('ape2'),
            $this->getSql('fecha'),
            $this->getSql('correo')
         ];
  
          $r = $this->db->insertUpdateUsuarioCliente($a);
          if($r){
            $response['error']      = false;
            $response['menssage']   = $_SESSION['message'] = 'Actualizo datos';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';
         }else{
            $response['error']      =  true;
            $response['message']    = $_SESSION['message']  = 'Error, Al actulizar datos';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'danger';
         }
      header( 'location:  ../vista/misdatos.php');
      break;
      case 'cambioContrasena':
         $a = [
            $this->getSql('id'),
            $this->getSql('passA'),
            $this->getSql('passN'),
            $this->getSql('passN2')
         ];
          $r = $this->db->validaContraseña($a);
          if($r){
            $response['error']      = false;
            $response['menssage']   = $_SESSION['message'] ='Cambio contraseña de manera exitosa';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';
         }else{
            $response['error']      =  true;
            $response['message']    = $_SESSION['message'] = 'Error, al cambio contraseña'; 
            $_SESSION['color']      = 'danger';
         }
      header( 'location:  ../vista/cambioContraseña.php');
      break;
      case 'cambioContrasenaCorreo':
         $a = [
            $this->getSql('tipo_doc'),
            $this->getSql('documento'),
            $this->getSql('email'),
            $this->getSql('fActual'),
            $this->getSql('fCaduc'),
            $this->getSql('token')
         ];
          $r = $this->db->validarCredecilesCorrreo($a);
          if($r){
            $response['error']      = false;
            $response['menssage']   = $_SESSION['message'] = 'Cambio contraseña de manera exitosa';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';

         }else{
            $response['error']      =  true;
            $response['message']    = $_SESSION['message'] = 'Error, al cambio contraseña'; 
            header( 'location:  ../vista/forgot_password/dist/index.php');
            $_SESSION['color']      = 'danger';
         }
      break;
      case 'inicionRol':
          include_once '../controlador/controladorsession.php';
          $objSession = new Session();
          $objSession->verificarAcceso();
      break;
      case 'notificLeida':
         $r = $this->db->notificacionLeida($_GET['id']);
         if($r){
           $response['error']      = false;
           $response['menssage']   = $_SESSION['message'] = 'Update exitoso exitosa';
           $_SESSION['color']      = 'success';
        }else{
           $response['error']      =  true;
           $response['message']    = $_SESSION['message'] = 'Error, aupdate'; 
           $_SESSION['color']      = 'danger';
        }
     break;
     case 'deleteNotific':
      //die($_GET['id']);
            
            $r = $this->db->deleteNotific( $_GET['id'] );
            if($r){
              $response['error']      = false;
              $response['menssage']   = $_SESSION['message'] = 'Elimino log';
              $_SESSION['color']      = 'success';
           }else{
              $response['error']      =  true;
              $response['message']    = $_SESSION['message'] = 'Error al eliminar log'; 
              $_SESSION['color']      = 'danger';
           }
           header( 'location:  ../vista/formNotificacion.php');
         break;
     case 'deleteLog':
//die($_GET['id']);
      
      $r = $this->db->deleteLog( $_GET['id'] );
      if($r){
        $response['error']      = false;
        $response['menssage']   = $_SESSION['message'] = 'Elimino log';
        $_SESSION['color']      = 'success';
     }else{
        $response['error']      =  true;
        $response['message']    = $_SESSION['message'] = 'Error al eliminar log'; 
        $_SESSION['color']      = 'danger';
     }
     header( 'location:  ../vista/formControl.php');
   break;
   case 'selectUsuarioFactura':
   $r = $this->db->selectUsuarioFac(6, 1);
   echo json_encode($r, JSON_UNESCAPED_UNICODE);
   die();
   break;

      default:
      $response['error']      = true;
      $response['message']    = 'ingreso a api "no esta en ningun metodo"'; 
      break;
   }
}else{
   // Si no es un api el que se estaq invocando
   // Empujar los valores apropiados en la consulta json
   if( !isset($_POST['apicalp'])){
   $response['message'] = 'Llamado invalido del api';
}else{

}
}

if(isset($_POST['apicalp'])){
   switch ($_POST['apicalp']) {
   case 'insertUdateCategoria':
      //ControllerDoc::ver($_POST, 1);
      $a = [
         $this->getSql('id'), 
         $this->getSql('categoria')
      ];
       $r = $this->db->actualizarDatosCategoria($a);
       if(!$r){
         $response['error']      = true;
         $response['menssage']   = $_SESSION['message'] = 'Error, no Actualizo Actegoria'.$_POST['categoria'];
         $response['contenido']  = $r;
         $_SESSION['color']      = "danger";
      }else{
         $response['error']      = false;
         $response['message']    = $_SESSION['message'] = 'Actualizo Categoria '.$_POST['categoria'];
         $response['contenido']  = $r;
         $_SESSION['color']      = "success";
      }
   header( 'location:  ../vista/formCategoria.php');
   break;


   case 'insertcategoria':
      $a = [
         $this->getSql('nom_categoria')
      ];
       $r = $this->db->insertCategoria($a);
       if(!$r){
         $response['error']      = true;
         $response['menssage']   =  $_SESSION['message'] = "Error no creo categoria";
         $response['contenido']  = $r;    
      }else{
         $response['error']      = false;
         $response['message']    = $_SESSION['message'] = 'Inserto categoria'; 
         $response['contenido']  = $r;
         $_SESSION['message']    = "Inserto categoria";
         $_SESSION['color']      = "success";
      }
   header( 'location:  ../vista/formCategoria.php');
   break;


   case 'insertUdateEmpresa':
      $a = [
         $this->getSql('ID_rut'),
         $this->getSql('nom_empresa')
      ];
   
       $r = $this->db->actualizarDatosEmpresa($a);
       if(!$r){
         $response['error']      = true;
         $response['menssage']   = $_SESSION['message'] = "Error, no actualizo empresa";
         $response['contenido']  = $r;
         $_SESSION['color']      = "danger";
      }else{
         $response['error']      = false;
         $response['message']    = $_SESSION['message']    = "Actualizo empresa";
         $response['contenido']  = $r;
         $_SESSION['color']      = "success";
      }
   header( 'location:  ../vista/formEmpresa.php');
   break;
   case 'insertEmpresa':
      $a = [
         $this->getSql('ID_rut'),
         $this->getSql('nom_empresa')
      ];
       $r = $this->db->insertEmpresa($a);
       if($r){
         $response['error']      = false;
         $response['message']    = $_SESSION['message']  = "Creo empresa";
         $response['contenido']  = $r;
         $_SESSION['color']      = "success";
      }else{

         $response['error']      = true;
         $response['menssage']   = $_SESSION['message'] = 'Error, no creo empresa';
         $response['contenido']  = $r;
         $_SESSION['color']      = "danger";
      }

   header( 'location:  ../vista/formEmpresa.php');
   break;
   case 'insertMedida':
      $a = [
         $this->getSql('nom_medida'),
         $this->getSql('acron_medida')
      ];
       $r = $this->db->insertMedia($a);
       if($r){
         $response['error']      = false;
         $response['menssage']   = $_SESSION['message']  = 'Creo unidad medida';
         $response['contenido']  = $r;
         $_SESSION['color']      = 'success';
      }else{
         $response['error']      =  true;
         $response['message']    = $_SESSION['message']  = "Error, no creo unidad de medida";
         $response['contenido']  = $r;
         
         $_SESSION['color']      = 'danger';
      }
   header( 'location:  ../vista/formMedida.php');
   break;
   case 'venta':
      $a = $_SESSION['CARRITO'];
      require_once 'controllerFacturacion.php';
      $objFac = new  ControllerFactura();
      $objFac->facturar($a, 1);
      header( 'location:  ../vista/mostrarCarrito.php');
   break;

   case 'EliminarProducto':
      $r= $this->db->EliminarProducto($this->getSql('id'));
      if(!$r){
         $response['error']      = true;
         $response['menssage']   = $_SESSION['message'] = 'No elimino producto';
         $response['contenido']  = $r;
         $_SESSION['color']      = 'danger';
      }else{
         $response['error']      = false;
         $response['message']    = $_SESSION['message'] = 'Elimino producto'; 
         $response['contenido']  = $r;
         $_SESSION['color']      = 'success';
      }
      header( 'location:  ../vista/edicionProductoTabla.php');
   break;
   case'updateProducto':
   //  extract($_POST);
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
         $response['error']      = false;
         $response['menssage']   = $_SESSION['message'] = 'Edito producto '.$nom_prod.' de manera exitoza';
         $_SESSION['color']      = 'success';
      }else{
         $response['error']      =  true;
         $response['message']    = $_SESSION['message'] = 'Error al editar producto '.$nom_prod; 
         $_SESSION['color']      = 'danger';
      }
      header( "location:  ../vista/edicionProductoTabla.php");
      break;
      case 'insertUdateMedia':
       //  ControllerDoc::ver($_POST, 1);
         $a = [
            $this->getSql('id'),
            $this->getSql('nom'),
            $this->getSql('acron')
         ];
         // ControllerDoc::ver($a, 1);
  
          $r = $this->db->actualizarDatosMedida($a);
          if($r){
            $response['error']      = false;
            $response['menssage']   = $_SESSION['message'] = 'Actualizar medida';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'success';
         }else{
            $response['error']      =  true;
            $response['message']    = $_SESSION['message'] = 'Error, Al actualizar medida no debe tener "" por seguridad';
            $response['contenido']  = $r;
            $_SESSION['color']      = 'danger';
         }
      header( 'location:  ../vista/formMedida.php');
      break;
   
   default:
     echo 'no esta en metodo';
      break;
   }
}


 echo json_encode($response);

}

   
}


$obj = new apiController();