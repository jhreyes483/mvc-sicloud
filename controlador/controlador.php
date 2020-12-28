
<?php
//session_destroy();
include_once '../modelo/class.sql.php';
include_once 'controladorrutas.php';
conficController();

date_default_timezone_set("America/Bogota");



class ControllerDoc extends Controller
{



    private $objSession, $objModUs;
    public function __construct(){
        parent::__construct();
        include_once 'controladorsession.php';  
        $this->objModUs    = SQL::ningunDato();
        $this->objSession  = Session::ningunDato();
    }
    public function selectDocumento(){
        return $this->objModUs->verDocumeto();
    }
    
    public function loginUsuarioController($ID_us,  $pass, $doc){
        $datosController[]        = [$ID_us, $pass, $doc];
        $USER                     = $this->objModUs->loginUsuarioModel($datosController);
    

        if( isset($USER) && ($USER) ){ 
            $_SESSION['usuario']  =  $this->objSession->encriptaSesion($USER);
            $this->session         = $this->objSession->desencriptaSesion();
            $id_rol               =  openssl_decrypt( $_SESSION['usuario']['ID_rol_n'], COD, KEY);
            $_SESSION['notic']    =  $this->verNotificaciones(   $id_rol  );
            $id_rol               =  null;
            $this->objSession->verificarAcceso();
            $this->session        =  $this->objSession->desencriptaSesion();

            return  $USER;
        }else{
            header("location: ../vista/loginregistrar.php");
            $_SESSION['message'] = 'Contraseña incorreta o usuario no registrado';
            $_SESSION['color']   = 'danger';
        }
    }
        

    public function createUsuariosController(
        $ID_us,
        $nom1,
        $nom2,
        $ape1,
        $ape2,
        $fecha,
        $pass,
        $foto1,
        $correo,
        $FK_tipo_doc,
        $FK_rol,
        $fechaC,
        $estado,
        $ruta, //13 
        $tel
    ) 
    {
        $datosController[] = [
            0         =>  $ID_us,
            1         =>  $nom1,
            2         =>  $nom2,
            3         =>  $ape1,
            4         =>  $ape2,
            5         =>  $fecha,
            6         =>  $pass,
            7         =>  $foto1,
            8         =>  $correo,
            9         =>  $FK_tipo_doc,
            10        =>  $FK_rol,
            11        =>  $fechaC,
            12        =>  $estado,
            13        =>  $ruta,
            14        =>  $tel
        ];
         $bool0 = $this->objModUs->InsertUsuario($datosController, 'usuario');
        if($bool0){
        $bool1 = $this->objModUs->insertrRolUs($datosController);
            if($bool1){
                // Insercion de foto
                //$foto = $_FILES['foto']['name'];
                // $ruta = $_FILES['foto']['tmp_name'];
                $destino = '../vista/fonts/us/'.$foto1;
                copy($ruta, $destino);
                $bool2 =  $this->objModUs->inserTfotoUs(  $foto1 ,  $ID_us );
                if($bool2){
                    $puntos = 2;
                    $fecha  = date('Y-m-d'); 
                    $aP = [
                        $puntos,
                        $fecha,
                        $ID_us,
                        $FK_tipo_doc
                    ];
                    $bool3   = $this->objModUs->insertPuntos($aP);
                }
                    if($bool3){
                        $aT= [
                            $tel,
                            $ID_us
                        ];
                       $boolF = $this->objModUs->insertTelefonoUsuario($aT);
                    }
                if( $boolF ){
                    $est = 0;
                    $descrip = $datosController[0][0];
                    $FK_rol = 1;
                    $FK_not = 1;
                    $aN =[ 
                        $est,
                        $descrip,
                        $FK_not,
                        $FK_rol
                    ];
                    $bool3 = $this->objModUs->notInsertUsuarioAdmin($aN);
                    if($bool3){
                        return true;
                    }else{
                        return false;
                    }



                  // return true;
                }else{
                $_SESSION['message'] = "Error el nombre de la foto ya existe";
                $_SESSION['color']   = "danger";
                }  
            }
        }
    }    
        /*
           // Insercion de foto
           $foto = $_FILES['foto']['name'];
           $ruta = $_FILES['foto']['tmp_name'];
           $destino = '../global/fonts/us/'.$foto;
           copy($ruta, $destino);
           $us = Usuario::ningunDato();
          $i = $us->inserTfoto($destino, $ID_us);

          */
    
    public function readUsuariosController(){
        return $this->objModUs->readUsuarioModel();
    }
    public function readUsuarioModel(){
        return $this->objModUs->readUsuarioModel();
    }


    public function contruyeLogActividad($id_modificado  , $tipo ){
        // Elimina usuario = $tipo 1
        // Actualizo usuario = $tipo 2
        // Activo cuenta = $tipo 3
        // Elimina producto  $tipo 4
        // Actualiza producto $tipo 5
        // Elimina categoria $tipo 6
        // Actualiza categoria $tipo 7
        // Elimina empresa $tipo 8
        // Actualiza empresa 9
         //  Elimina Unidad de medida $tipo 10
        // Actualiza Unidad de medida  empresa 11
         //Borro log  de actividad 12
         //Borro Log de errores 13
        //Borro Log de notificacion 14
        // Desaciva cuenta usaurio 15


        $hora            = date("h:i:sa");
        $hora            = substr( $hora , 0, 8 );
        $fecha           = date('Y-m-d');
        switch ($tipo) {
            case 1:
                $entidad         = 'Usuario';
                $FK_modific      = 2;
                $descrip         = "$entidad modificado ID " .$id_modificado;
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 2:
                $entidad         = 'Usuario';
                $FK_modific      = 1;
                $descrip         = "$entidad modificado ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 3:
                $entidad         = 'Usuario';
                $FK_modific      = 5;
                $descrip         = "$entidad modificado ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 4:
                $entidad         ='Producto';
                $FK_modific      = 2;
                $descrip         = "$entidad modificado ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            case 5:
                $entidad         ='Producto';
                $FK_modific      = 1;
                $descrip         = "$entidad modificado ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 6:
                $entidad         ='Categoria';
                $FK_modific      = 2;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 7:
                $entidad         ='Categoria';
                $FK_modific      = 1;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 8:
                $entidad         ='Empresa';
                $FK_modific      = 2;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            case 9:
                $entidad         ='Empresa';
                $FK_modific      = 1;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 10:
                $entidad         ='Unidad de medida';
                $FK_modific      = 2;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            case 11:
                $entidad         ='Unidad de medidad';
                $FK_modific      = 1;
                $descrip         = "$entidad modificada ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 12:
                $entidad         ='Borro Log de actividad';
                $FK_modific      = 2;
                $descrip         = "$entidad";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            case 13:
                $entidad         ='Borro Log de errores';
                $FK_modific      = 2;
                $descrip         = "$entidad";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            case 14:
                $entidad         ='Borro Log de notificacion';
                $FK_modific      = 2;
                $descrip         = "$entidad";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            case 15:
                $entidad         = 'Usuario';
                $FK_modific      = 6;
                $descrip         = "$entidad modificado ID $id_modificado";
                $this->session   = $this->objSession->desencriptaSesion();
                $tDoc_us_session = $this->session['usuario']['ID_acronimo'] ;
                $ID_us_session   = $this->session['usuario']['ID_us'];
                $arm=[
                    $descrip,
                    $fecha,
                    $hora, 
                    $ID_us_session,
                    $tDoc_us_session,
                    $FK_modific
                ];
            return $this->objModUs->insertModificacion($arm);
            break;
            
            default:
               die('no inserto modificacion');
            break;
        }
    }


    public function eliminarUsuario($id_get){
        $ra         = $this->objModUs->eliminarRoldeUsuario($id_get);
        if($ra) $rb = $this->objModUs->eliminarTelefono($id_get) ;
        if($rb) $rc = $this->objModUs->eliminarUsuario($id_get) ;
        if($rc) return $this->contruyeLogActividad($id_get  , 1 );
    }
    public function actualizarDatosUsuario($id, $array){
        $r1 = $this->objModUs->actualizarDatosUsuario($id, $array);
        if ($r1) {
            //METODO DE INSERSION ROL_USUARIO UPDATE
            $r2 = $this->objModUs->insertUpdateRol( $array);
            if($r2){
                $_SESSION['message'] = 'Actualizo rol';
                $_SESSION['danger']  = 'Error al actualizar rol';
                return $this->contruyeLogActividad($id  , 2 );
            }
        }else{
            $_SESSION['message'] = 'Error al actualizar usuario';
            $_SESSION['danger']  = 'Error al actualizar usuario';
            header( 'location:  ../vista/CU009-controlUsuarios.php?documento='.$_GET['id'].'&accion=bId');
            die();
        }
    }

    //Metodos de entidad usuario form CU009-controlusuarios.php
   
   
    public function selectUsuarioFac( $id , $tipo= 0){
   

        //ControllerDoc::ver($tipo);
        //$id = "1,2,3,4,5,6";
 
        return $this->objModUs->selectUsuarioFac($id, $tipo);
    }





    public function selectUsuarioRol( $id , $tipo= 0){
   

        //ControllerDoc::ver($tipo);
        //$id = "1,2,3,4,5,6";
 
        return $this->objModUs->selectUsuarioRol($id, $tipo);
    }
    public function conteoUsuariosActivos()
    {
        return $this->objModUs->conteoUsuariosActivos();
    }
    public function conteoUsuariosInactivos()
    {
        return $this->objModUs->conteoUsuariosInactivos();
    }
    public function selectIdUsuario($id)
    {
        return $this->objModUs->selectIdUsuario($id);
    }
    public function selectUsuariosPendientes($est)
    {
        return $this->objModUs->selectUsuariosPendientes($est);
    }
    public function activarCuenta($id)
    {
        $r1 = $this->objModUs->activarCuenta($id);
        if($r1){
            return  $this->contruyeLogActividad($id , 3 );
        }else{
            return false;
        }
    }

    public function desactivarCuenta($id)
    {
        $r1 = $this->objModUs->desactivarCuenta($id);
        if($r1){
            return  $this->contruyeLogActividad($id  , 15 );
        }else{
            return false;
         } 
   
    }
    // Metodos de categoria 
    //"CU004-crearProductos.php"

//editarProducto.php
    public function ControllerEditaProductos($id){
        $producto   =  $this->objModUs->verProductosId($id);
        $categorias =  $this->objModUs->verCategorias();
        $medida     =  $this->objModUs->verMedida();
        $provedor   =  $this->objModUs->verProveedor();
        $estado     =[ 'estandar'  , 'promocion' ]; 
        if( count($categorias) == 0)  return ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
        if( count($categorias) == 0)  return ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
        if( count($medida    ) == 0)  return ['response_status' => 'error', 'response_msg' => 'No hay datos de medida' ];
        if( count($producto  ) == 0)  return ['response_status' => 'error', 'response_msg' => 'El producto no existe' ];
        return  [ 'response_status' => 'OK', 'response_msg' =>  [$categorias , $medida, $provedor, $producto , $estado] ];
    }

    public function editarProducto($a){
        $r = $this->objModUs->editarProducto($a);
        if($r){
            return $this->contruyeLogActividad($a[0], 5 );
        }else{
            return false;
        }
    }


    public function verCategorias()
    {
        return $this->objModUs->verCategorias();
    }
    // CU003-ingresoProducto.php
    public function inserCatidadProducto($a){
        //$cant, $stock, $id
        // $t = $stock + $cant;
        $t = $a[1] + $a[0];
        
        $aT =[
            $t,
            $a[2]
        ];
        return $this->objModUs->inserCatidadProducto($aT);
    }

    //formCategoria.php
    public function verCategoria()
    {
        return $this->objModUs->verCategoria();
    }
    public function verCategoriaId($id)
    {
       return $this->objModUs->verCategoriaId($id);
    }
    public function verPromociones()
    {
        return $this->objModUs->verPromociones();
    }
    //Medida     
    public function verMedida()
    {
        return $this->objModUs->verMedida();
    }
    public function verDatoPorIdMedida($id)
    {
      //  return $this->objModMed->verDatoPorId($id);
    }
    public function verProveedor()
    {
       return $this->objModUs->verProveedor();
    }
    public function verProductos()
    { // CU003-ingresoproducto.php
        return $this->objModUs->verProductos();
    }
    public function verProductosIdCarrito($ID)
    {
        return $this->objModUs->verProductosIdCarrito($ID);
    }
    public function tablaProducto($id)
    {
        return $this->objModUs->verJoin($id);
    }
    public function verProductosId($id_p)
    {
        return $this->objModUs->verProductosId($id_p);
    }
    // U004-crearproductos.php
    public function insertarProducto($a)
{
       $bool = $this->objModUs->insertarProducto($a);  
    if($bool ) {
       //foreach($a as $i => $d){
            $foto    = $a[7];
            $ruta    = $a[8];
            $id_prod = $a[0];
        }
        $destino = '../vista/fonts/img/'.$foto;
        copy($ruta, $destino);
        $bool2 = $this->objModUs->inserTfotoProd( $foto, $id_prod);
        if($bool2){
            $_SESSION['message'] = "Inserto producto";
            $_SESSION['color']   = "success";
            return true;
        }else{
            $_SESSION['message'] = "Error no inserto foto";
            $_SESSION['color']   = "danger";
            return false;      
        }
    }
    

    public function verProductosGrafica()
    {
       return $this->objModUs->verProductosGrafica();
    }
    public function ConteoProductosT(){
       return $this->objModUs->ConteoProductosT();
    }
    public function EliminarProducto($id){
      $r1 = $this->objModUs->EliminarProducto($id);
      if($r1){
          return $this->contruyeLogActividad($id  , 4 );
      }else{
          return false;
      }

    }
    // Catalogo
    public function buscarPorNombreProducto($id)
    {
        return $this->objModUs->buscarPorNombreProducto($id);
    }
    public function verPorCategoria($id)
    {
        return $this->objModUs->verPorCategoria($id);
    }

    //CU006-acomulaciondepuntos.php
    public function verPuntosUs()
    {
        return $this->objModUs->verPuntosUs();
    }

    //metodos de factura
    public function usuariosComprasRealizadas()
    {
        return $this->objModUs->usuariosComprasRealizadas();
    }
    public function verUsuarioFactura($id)
    {
        return $this->objModUs->verUsuarioFactura($id);
    }
    public function verjoinFactura()
    {
        return $this->objModUs->verjoinFactura();
    }
    public function verIntervaloFecha($f1, $f2)
    {
        return $this->objModUs->verIntervaloFecha($f1, $f2);
    }
    public function verDia(){
        return $this->objModUs->verDia();
    }
    public function verSemana(){
        return $this->objModUs->verSemana();
    }
    public function verMes(){
        return $this->objModUs->verMes();
    }

    //modificaion db
    public function verJoinModificacionesDB()
    {
        return $this->objModUs->verJoinModificacionesDB();
    }

    //Metodos de Rol
    public function verRolId($id)
    {
        return $this->objModUs->verRolId($id);
    }
    public function verRol()
    {
        return $this->objModUs->verRol();
    }

    //metodos de ciudad
    public function verCiudad()
    {
        return $this->objModUs->verCiudad();
    }

    //metodos de empresa
    public function verDatoPorId($id){
        return $this->objModUs->verDatoPorId($id);
    }
    public function verEmpresa()
    {
       return $this->objModUs->verEmpresa();
    }

    public function verTelefonosUsuario(){
        return $this->objModUs->verTelefonosUsuario();
    }
    public function verTelefonosUsuarioPorID($id){
        return $this->objModUs->verTelefonosUsuarioPorID($id);
    }
    public function verTelefonosEmpresa(){
        return $this->objModUs->verTelefonosEmpresa();
    }
    public function verTelefonosUsuarioRol($rol){
        return $this->objModUs->verTelefonosUsuarioRol($rol);
    }

    public function eliminarTelefono($id){
        return $this->objModUs->eliminarTelefono($id);
    }
    //metodos de error
    public function verError()
    {
        return $this->objModUs->verError();
    }
    // Metodo inicio de session usuario
    public function verPuntosYusuario($id_us){
        return $this->objModUs->verPuntosYusuario($id_us);
    }
    // formCategoria.php
    public function insertCategoria($a){
        return $this->objModUs->insertCategoria($a);
    }
    public function actualizarDatosCategoria($a){
        $r = $this->objModUs->actualizarDatosCategoria($a);
        if($r){
            return $this->contruyeLogActividad($a[0]  , 7 );
        }else{
            return false;
        }
    }
    public function eliminarCategoria($a){
        $r = $this->objModUs->eliminarCategoria($a);
        if($r){
            return $this->contruyeLogActividad($a[0]  , 6 );
        }else{
            return false;
        }
    }
    // formEmpresa.php
    public function eliminarEmpresa($a){
        $r = $this->objModUs->eliminarEmpresa($a);
        if($r){
            return $this->contruyeLogActividad($a[0] ,8  );
        }else{
            return false;
        }
    }
    //formEmpresa.php
    public function insertEmpresa($a){
        return $this->objModUs->insertEmpresa($a);
    }
    public function verDatoEmpresaPorId($id){
        return $this->objModUs->verDatoEmpresaPorId($id);
    }
    public function actualizarDatosEmpresa($a){
        $r = $this->objModUs->actualizarDatosEmpresa($a);
        if($r){
            return $this->contruyeLogActividad($a[0] , 9 );
        }else{
            return false;
        }
    }
    // formMedida.php
    public function insertMedia($a){
        return $this->objModUs->insertMedia($a);
    }
    public function eliminarDatosMedia($a){
        $r = $this->objModUs->eliminarDatosMedia($a);
        if($r){
            return $this->contruyeLogActividad($a[0]  , 10 );
        }
    }
    public function verMedidaPorId($id){
        return $this->objModUs->verMedidaPorId($id);
    }
    public function actualizarDatosMedida($a){
        $r = $this->objModUs->actualizarDatosMedida($a);
        if($r){
            return $this->contruyeLogActividad($a[0]  , 11);
        }else{
            return false;
        }
    }

    public function selectUsuarios($id){
        return $this->objModUs->selectUsuarios($id);
    }
    public function insertUpdateUsuarioCliente($a){
        return $this->objModUs->insertUpdateUsuarioCliente($a);
    }
    public function verFecha($f){
        return $this->objModUs->verFecha($f);
    }
    public function RangoInforme(){
        return $this->objModUs->consultaRangoInforme();
    }

    // metodo log delete actividad
    public function deleteLog($id_log){
        return $this->objModUs->deleteLog($id_log);
    }
    // muestra todas las notificaciones
    public function verNotificacionesT(){
        return $this->objModUs->consNotificacionesT();
    }

    // elimina notificacion
    public function deleteNotific($id_notific){
        return $this->objModUs->delteNotificacion($id_notific);
    }


    public function validaContraseña($a){
        $passAterior =  $this->objModUs->validarPass( $a[0], $a[1] );
         // validacion de contraseña en base de datos
            if($passAterior){
                if( $a[2] ==  $a[3] ){
                    $r1 = $this->objModUs->cambioPass( $a[0], $a[3] );
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
    public function validarCredecilesCorrreo($a){
        
         $r = $this->objModUs->validarCredecilesCorrreo($a);
         if($a[5] == 'sicloud'){
            if($r){
               $contraseña = 'jav';
               $contenido ='Restablecer contraseña<br>    usuario ;'.$r[0][0].'<br>'.'contraseña '.$contraseña.'<br>'.'Link: http://localhost/sicloud-sa/vista/forgot_password/dist/index.php';
               // datos correo
               $correo = $r[0][8];
               $asunto = 'Restablecer contraseña';
                mail($correo, $asunto, $contenido );
                $_SESSION['message']     = "Se envio mensaje al correo";
                $_SESSION['color']       = "success";  
              
                 $id =   $r[0][0];
                $pass =  $r[0][6];
                $t_doc = $r[0][9];
                $ar[] =   [
                    $id,
                    $pass,
                    $t_doc
                ];
                die();
              
                $USER = $this->objModUs->loginUsuarioModel($ar);
              //  $_SESSION['usuario'] = $USER;

                header( 'location:  ../vista/cambioContraseña.php');
                 die();
            }else{
                $_SESSION['message']     = "Datos incorrectos o usuario no registrado";
                $_SESSION['color']       = "danger";
              // echo 'no encontro datos'; die();
            }
        }else{
            $_SESSION['message']     = "No ingreso correctamente";
            $_SESSION['color']       = "success";
            //echo 'no ingreso correctamente'; die();
        }

    }





    public function insertFactura($a){

        $fecha  = date('Y-m-d'); 
         $iva = ($a[1] * 0.19);
        $aF = [
            $a[1],
            $fecha,
            'cancelado',
            $iva,
            1
        ];
       $this->objModUs->insertFactura($a);
    }




    // notificaciones nav
    public function verNotificaciones($id_rol){
        return  $this->objModUs->verNotificaciones($id_rol);
    } 
    // notificacion leida
    public function notificacionLeida($a){
        return $this->objModUs->notificacionLeida($a);
    }



    public function index()
    {
        die('implemetar index');

    }
}


?>