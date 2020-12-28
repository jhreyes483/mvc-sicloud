<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
*/
$objSession = new Session();
$uN = $objSession->desencriptaSesion();
if (isset($_SESSION['usuario'])) {
  $countNotificacion =  count($_SESSION['notic']);  
}

class ControllerMenu{
public $aMenu , $aP, $aUserDB;
private $db;
public function __construct(){
  include_once          '../controlador/controlador.php';
  include_once          '../vista/notificacion/notificacionN1.php';
  if( isset( $_SESSION['usuario'] )){
    $this->db         =   SQL::ningunDato();
    $this->id_rol     =   openssl_decrypt( $_SESSION['usuario']['ID_rol_n'], COD, KEY);
    $this->aUserDB    =   $this->db->rolMenu($this->id_rol);
  }


    $this->aP= [];
    $this->aMenu['A'][1]         = ['USUARIOS'];
    $this->aMenu['A'][1][1]      = ['Admin Solisitud', 'CU009-controlUsuarios.php'];
    $this->aMenu['A'][1][2]      = ['Acumulación de puntos', 'CU006-acomulaciondepuntos.php'];
    $this->aMenu['A'][1][3]      = ['Facturacion', 'CU005-facturacion.php'];
    $this->aMenu['A'][1][4]      = ['Consulta factura', 'formFactura.php'];
    $this->aMenu['A'][1][5]      = ['Inf Ventas', 'CU0012-informeVentas.php'];
    $this->aMenu['A'][2]         = ['PRODUCTOS'];
    $this->aMenu['A'][2][1]      = ['Catalogo', 'catalogo.php?ops=1'] ;
    $this->aMenu['A'][2][2]      = ['Crear producto', 'CU004-crearProductos.php'];
    $this->aMenu['A'][2][3]      = ['Ingresar producto', 'CU003-ingresoProducto.php'];
    $this->aMenu['A'][2][4]      = ['Editar producto', 'edicionProductoTabla.php?edit'];
    $this->aMenu['A'][2][5]      = ['Solicitar producto', 'CU0015_16(administrador)-solicitud.php'];
    $this->aMenu['A'][2][6]      = ['Sistema de alertas', 'CU0014-alertas.php'];
    $this->aMenu['A'][2][7]      = ['Stock','edicionProductoTabla.php'];
    $this->aMenu['A'][2][8]      = ['Cantidad', 'tablaRegistro.php'];
    $this->aMenu['A'][2][9]      = ['Categoria', 'tablaCategoria.php'];
    $this->aMenu['A'][2][10]     = ['Inf Bodega', 'CU0012-informebodega.php'];
    $this->aMenu['A'][3]         = ['ADMIN SISTEMA'];
    $this->aMenu['A'][3][1]      = ['log errores', 'formLogError.php'];
    $this->aMenu['A'][3][2]      = ['log actividades', 'formControl.php'];
    $this->aMenu['A'][3][3]      = ['log notificaciones', 'formNotificacion.php'];
    $this->aMenu['A'][4]         = ['EDICION'];
    $this->aMenu['A'][4][1]      = ['Categorias', 'formCategoria.php'];
    $this->aMenu['A'][4][2]      = ['Empresas', 'formEmpresa.php'];
    $this->aMenu['A'][4][3]      = ['Unid medida', 'formMedida.php'];
    $this->aMenu['A'][4][4]      = ['Productos', 'edicionProductoTabla.php?edit'];
    $this->aMenu['A'][4][5]      = ['Telefonos', 'formTelefono.php'];
    $this->aMenu['A'][4][6]      = ['Cuentas', 'TablaUsuario.php'];
    $this->aMenu['A'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $this->aMenu['B'][1]         = [ 'CONSTITUCION'];
    $this->aMenu['B'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $this->aMenu['B'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $this->aMenu['B'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $this->aMenu['B'][3]         = [ 'PRODUCTOS'];
    $this->aMenu['B'][3][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $this->aMenu['B'][3][2]      = [ 'INF BODEGA','CU0012-informebodega.php'];
    $this->aMenu['B'][3][3]      = [ 'CATEGORIAS', 'tablaCategoria.php'];
    $this->aMenu['B'][3][4]      = [ 'CANTIDAD', 'tablaRegistro.php'];
    $this->aMenu['B'][3][5]      = [ 'SISTEMA ALERTAS', 'CU0014-alertas.php'];
    $this->aMenu['B'][3][6]      = [ 'STOCK','edicionProductoTabla.php'];
    $this->aMenu['B'][4]         = [ 'PROCESOS', 'tablaRegistro.php'];
    $this->aMenu['B'][4][1]      = [ 'CREAR PRODUCTO', 'CU004-crearProductos.php'];
    $this->aMenu['B'][4][2]      = [ 'INGRESO PRODUCTO', 'CU003-ingresoProducto.php'];
    $this->aMenu['B'][4][3]      = [ 'EDITAR PRODUCTOS', 'edicionProductoTabla.php?edit'];
    $this->aMenu['B'][4][4]      = [ 'SOLICITAR PEDIDO', 'CU0018-registropedido.php'];
    $this->aMenu['B'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $this->aMenu['S'][1]         = [ 'CONSTITUCION'];
    $this->aMenu['S'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $this->aMenu['S'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $this->aMenu['S'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $this->aMenu['S'][4]         = [ 'INF. VENTAS'];
    $this->aMenu['S'][4][1]      = [ 'FECHA','verFecha.php'];
    $this->aMenu['S'][4][2]      = [ 'RANGO','verRango.php'];
    $this->aMenu['S'][4][3]      = ['CONSULTA FACTURAS', 'CU0012-informeVentas.php'];
    $this->aMenu['S'][5]         = [ 'PRODUCTOS'];
    $this->aMenu['S'][5][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $this->aMenu['S'][5][2]      = [ 'ALERTAS','CU0014-alertas.php'];
    $this->aMenu['S'][5][3]      = [  'STOCK','edicionProductoTabla.php'];
    $this->aMenu['S'][6]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $this->aMenu['V'][1]         = [ 'CONSTITUCION'];
    $this->aMenu['V'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $this->aMenu['V'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $this->aMenu['V'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $this->aMenu['V'][3]         = [ 'PRODUCTOS'];
    $this->aMenu['V'][3][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $this->aMenu['V'][3][2]      = [ 'CATEGORIAS', 'tablaCategoria.php'];
    $this->aMenu['V'][3][3]      = [ 'CANTIDAD', 'tablaRegistro.php'];
    $this->aMenu['V'][3][5]      = [  'STOCK','edicionProductoTabla.php'];
    $this->aMenu['V'][4]         = [ 'USUARIOS'];
    $this->aMenu['V'][4][1]      = [ 'CUENTAS','CU009-controlUsuarios.php'];
    $this->aMenu['V'][4][2]      = [ 'PUNTOS','CU006-acomulaciondepuntos.php'];
    $this->aMenu['V'][4][3]      = [ 'FACTURACION','CU005-facturacion.php'];
    $this->aMenu['V'][4][4]      = ['CONSULTA FACTURA', 'formFactura.php'];
    $this->aMenu['V'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];


    $this->aMenu['P'][1]         = [ 'CONSTITUCION'];
    $this->aMenu['P'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $this->aMenu['P'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $this->aMenu['P'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $this->aMenu['P'][3]         = [ 'CATALOGO','catalogo.php?ops=1'];
    $this->aMenu['P'][4]         = [ 'SOLICITUDES','CU0018-registropedido.php'];
    $this->aMenu['P'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];


    $this->aMenu['C'][1]         = [ 'FERRETERIA'];
    $this->aMenu['C'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $this->aMenu['C'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $this->aMenu['C'][2]         = [ 'CATALOGO','catalogo.php?ops=1'];
    $this->aMenu['C'][3]         = [ 'PROMOCIONES','Promociones.php'];
    $this->aMenu['C'][4]         = [ 'CONTACTO','CU000-contact.php'];
    $this->aMenu['C'][5]          =[ 'INICIO','../controlador/api.php?apicall=inicionRol'];
    
}

public function generaMenu(){
  if( isset($_SESSION['usuario']) ){
  $sPdb    = $this->aUserDB[0][2];
  $m       = $this->aUserDB[0][0];
  $nom     = $this->aUserDB[0];

}else{
  $m    = 'C';
  $sPdb = '01,0101,0102,02,03,04,05';
}

    $aPdb = explode( ',' ,$sPdb);
    $aP  = [];
foreach($aPdb as $d ){
    $c = strlen($d);
    switch ($c) {
      case 2:
          $v1 = abs($d);
           $aP[$v1] = [$this->aMenu[$m][$v1][0] , $this->aMenu[$m][$v1][1] ];
          break;
      case 4:
          $sP =  str_split($d, 2);
          $v1 =  abs($sP[0]); 
          $v2 =  abs($sP[1]);
          $aP[$v1][$v2] = [ $this->aMenu[$m][$v1][$v2][0] , $this->aMenu[$m][$v1][$v2][1] ];
          break;
      case 6:
          $sP =  str_split($d, 2);
          $v1 =  abs($sP[0]); 
          $v2 =  abs($sP[1]);
          $v3 =  abs($sP[2]);
          $aP[$v1][$v2][$v3] = [ $this->aMenu[$m][$v1][$v2][$v3][0] , $this->aMenu[$m][$v1][$v2][$v3][1] ];
          break;
    }
  
}
if(isset($_SESSION['usuario'])){
$aU = [  
  1=> $nom, 
  2=> '1'
];
}else{
  $aU = [];
}


$a =[
  $aP,
  $aU
];

return $a;
}


}
$obj = new ControllerMenu();
 $a = $obj->generaMenu();

 $aP  = $a[0];
 $aU  = $a[1];



echo '<nav class="navbar-fixed-top navbar navbar-expand-lg navbar-dark bg-dark navbar navbar-expand-lg  sticky-top">
<a class="navbar-brand ml-4" href="#">
  <img src="fonts/logoportal.png" width="250" height="65" alt="">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>';




echo'

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto mx-auto">';

  foreach($aP as $i0 =>  $d){
  
    if( !is_array($d[0])){ 
       $url = ( !is_array($d[1]))? $d[1] : '';
      if(   is_array ( $aP[$i0][1] ) ){   
        $iniN2 = '<li class="nav-item dropdown active">';  echo $iniN2; $iniN2 ='';
        $url = (!is_array ( $aP[$i0][1]) ) ? $aP[$i0][1] : '' ;
        $subMenu = '<a class="nav-link dropdown-toggle lead px-4 my-3" href="'.$url.'" id="navbarDropdown"
        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$aP[$i0][0].'</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo $subMenu;
        foreach($d as  $i1 => $d1 ){
          if( $i1 != 0 ){
            $url = (!is_array($d1[1]) )? $d1[1]: '';
            echo '<a class="dropdown-item" href="'.$url.'">'.$d1[0].'</a>';
          }
        }
        if($iniN2 == ''){
           echo '</li>';
        }
      }
      if(   !is_array( $d[1] ) ){
       echo '<li class="nav-item active">';
       echo ' <a class="nav-link lead px-4 my-3 " href="'.$url.'">'.$d[0].'<span class="sr-only">(current)</span></a>';
       echo '</li>';
      }
    }
  }

  echo '
        <li class="nav-item dropdown active">
        <!-- icono de notificacion mensaje -->
        <a class="nav-link mx-3" href="#" id="messagesDropdown" role="button" aria-expanded="false">
          <!-- Counter - Messages -->
        </a>
        <!-- icono de carrito -->
        <a href="mostrarCarrito.php"> 
        <svg  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3 " fill="white" xmlns="http://www.w3.org/2000/svg">
              <path style="color :#ffff;" fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg ></a>

            <!-- Icono de conteo productos carrito -->';
          
            if(  isset($_SESSION['CARRITO']) &&  $_SESSION['CARRITO'] > 0){
            echo'
        <span class="badge badge-danger badge-counter">';
        if (  empty($_SESSION['CARRITO'] )){  echo 0; }else{  echo count($_SESSION['CARRITO']); } 
        echo '</span>';
      }

      if( isset($_SESSION['usuario']) ){
      echo'
        <!-- icono de notificacion campana -->
        <a class="" id="messagesDropdown" data-toggle="modal" data-target="#exampleModal" role="button" aria-expanded="true">
          <i class="fas fa-bell fa-fw" style="color :#ffff;"></i>
          <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter">';
            if( isset($countNotificacion)  && $countNotificacion >0 ){ echo $countNotificacion; }else{ echo 0; }
            echo '</span></span>
       </a>';
echo'
        <span class="sr-only">(current)</span>
        </a>
  <li class="nav-item dropdown no-arrow">
  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">';
  if(isset($_SESSION['usuario'])){
     echo '<strong>'.$uN['usuario']['nom1'].'</strong>';

    }


     echo  '<strong>' ; if (isset($_SESSION['usuario'])) {
       echo '
<img class="img-profile ml-3 rounded-circle" src="fonts/us/' .$uN['usuario']['foto']. ' " height="65" width="70">';
 }
echo '
  <!-- Dropdown - User Information -->
  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="#">
          Hola ';
          if( isset($_SESSION['usuario']) ){
         echo   $uN['usuario']['nom1'].' '.$uN['usuario']['ape1'];

       
          echo '
          <div class="dropdown-divider"></div>
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          <em><strong>'.$uN['usuario']['nom_rol'].'</strong></em>';
        }
        echo '
      </a>
      <a class="dropdown-item" href="misdatos.php">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
          Mis datos
      </a>
      <a class="dropdown-item" href="#">
          <i class="fas fa-list fa-sm fa-fw mr-2 "></i>
          Compras
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="../controlador/controladorsession.php?cerrar=3"
          data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
          Salir
      </a>
  </div>';
}
echo '

</li>';



if( !isset($_SESSION['usuario']) ){
  echo '<div class="ml-5 my-4">
  <a href="loginregistrar.php" class="text-white lead">Sign In
  <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"></path>
        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"></path>
  </svg><br>

  </a>
</div>';
}

echo '
</ul>';




echo '
</div>
</nav>
</strong>';

?>

  

