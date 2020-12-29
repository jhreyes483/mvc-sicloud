<?php

class indexController extends Controller {
// Guarda notificaicones en varible $this->_view->notificacion 

	public function __construct(){
      parent::__construct(1);
      $this->db            = $this->loadModel('consultas.sql', 'sql');
      $this->objSession    = new Session();
      $this->_view->setCss( ['jav','bootstrap.min', 'fontawesome-all.css'] );
      $this->_view->setJs( ['jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'] );
   }
   
	public function index(){
      if(isset($_SESSION['usuario'])){
         session_destroy();
      }
      $this->_view->setJs(array( 'jquery-1.9.0'  ,'login'  ));
      //
      if(isset( $_POST['accion'] )){
         switch ($_POST['accion']) {
            case 'createusuario':
              $this->verficaParametros(  [ 'ID_us','nom1','nom2', 'ape1', 'ape2','fecha', 'pass', 'correo','FK_tipo_doc' ]  );
                  $u = [
                     $this->getSql('ID_us'),  //0 
                     $this->getSql('nom1'),   //1
                     $this->getSql('nom2'),   //2
                     $this->getSql('ape1'),   //3
                     $this->getSql('ape2'),   //4
                     $this->getSql('fecha'),  //5    
                     $this->getSql('pass'),   //6
                     $_FILES['foto']['name'], //7
                     $this->getSql('correo'), //8
                     $this->getSql('FK_tipo_doc'), //9
                     $this->getSql('FK_rol'), //10
                     date('Y-m-d'),           //11
                     0,                       //12
                     $_FILES['foto']['tmp_name'],//13
                     $this->getSql('tel')     //14
                  ];
               // Insert usario
               $bU = $this->db->InsertUsuario($u);  
               if($bU){
               // Insert rol
                  $bR = $this->db->insertrRolUs($u);
               }else{ die('error al insertar usuario'); }
               //
               //$destino = RUTAS_APP['ruta_img'].'us/'.$_FILES['foto']['name']; // verificar si copio
               $destino = 'public/layout1/img/us/'.$_FILES['foto']['name']; // verificar si copio
               copy($_FILES['foto']['tmp_name'] , $destino); 
               // Copia foto
               if($bR){
                  $bF = $this->db->inserTfotoUs(  $_FILES['foto']['name'] ,  $this->getSql('ID_us') ); // update foto de base datos
               }else{ die('error al insertar rol de usuario'); }
               // 
               if($bF){
               // Inserta puntos
                  $aP = [
                     2, // Puntos
                     (date('Y-m-d')),
                     $this->getSql('ID_us'),
                     $this->getSql('FK_tipo_doc')
                  ];
                  $bP = $this->db->insertPuntos($aP); 
               }else{ die('error al insertar foto de usario'); }
               //
               if($bP){
               // Inserta foto
                  $aT =[
                     $this->getSql('tel'),
                     $this->getSql('ID_us')
                  ];
                  $bT = $this->db->insertTelefonoUsuario($aT); 
               }else{ die('error al insertar puntos'); }
               //
               if($bT){
               // Inserta notificiacion
                  $aN=[
                     0, // estado
                     $this->getSql('ID_us'), // descripcion
                     1, // llave foranea de usuario notificacion "llega"
                     1, // tipo de notificacion
                  ];
                  $bT = $this->db->notInsertUsuarioAdmin($aN);
               }else{ 'error al insertar telefono de usario'; }
               //
               if($bT){
                  $response['message'] = 'Usuario agregado correctamente';
                  $_SESSION['color']    = "success";
               }else{ 
                  $_SESSION['message']  = 'ocurrio un error, intenta nuevamente';
                  $_SESSION['color']    = "danger";
               }
               $this->redireccionar('index');
            break;
         }
      }
      //
		$this->_view->renderizar('index', 2); // 1 con js de ur - 2 sin js url 
   }	

   public function entidad(){
      $this->_view->setJs( ['login']  );
      $this->_view->renderizar('entidad', 1);
   }

   public function inicieSesion(){
      $this->_view->setJs( ['login']  );
      $this->_view->renderizar('inicieSesion', 1); 
   }


   
   public function datos(){
      $this->_view->setJs( ['login']  );
      $this->_view->renderizar('datos', 1);
   }

   public function mision(){
      $this->_view->setJs( ['login']  );
      $this->_view->renderizar('mision', 1);
   }

   public function promocion(){
      $this->_view->setJs( ['login']  );
      $this->_view->datos  =  $this->db->verPromociones();
      $this->_view->renderizar('promocion', 1);
   }


   
   public function login(){
      $this->_view->setCss(array( 'font-Montserrat', 'google', 'animate', 'fontawasome-icon.js','reset.min','login'));
      $this->_view->setJs(array('registrar' ));
		$this->_view->renderizar('login', 0);
   }	
   
   public function logOut(){
      $s = new Session;
      $s->destroy();
      $this->redireccionar('index');
   }
   
   public function ingreso(){
      $this->_view->setJs(['fontawesome-all']);
      $b = $this->validaCredenciales();
      if(!$b){
         $this->_view->setCss(array( 'font-Montserrat', 'google', 'animate', 'fontawasome-icon.js','reset.min','login'));
         $this->_view->setJs(array('registrar' ));
         $this->_view->renderizar('login', 0);
      }
   }
   
   public function registro(){
      $this->_view->setJs(array( 'jquery-1.9.0','login' ));
      $d =  $this->db->verDocumeto();
      $r =  $this->db->verRol();
      $this->_view->datos = [ $d, $r ];
      $this->_view->renderizar('registro', 1);
   }
   
   private function validaCredenciales(){    
      //if(isset($_POST['empresa']) && isset($_POST['usuario']) && isset($_POST['clave'])){
         //extract($_POST);
         //$empresa   = filter_var($empresa, FILTER_SANITIZE_EMAIL);
         //Se codifican las credenciales para guardar en cookies
         //$empresaENC = base64_encode($empresa); 
         //$userENC    = base64_encode($usuario); 
         //if(!isset($_POST['desde'])){
            //if(isset($_POST['recEmp']) && $_POST['recEmp']=='1')    setcookie("C_RE", $empresaENC, strtotime('+7 days'), '/; samesite=strict');   
            //else setcookie ("C_RE", "", time() - 3600); //borro
            //if(isset($_POST['recUser']) && $_POST['recUser']=='1') setcookie("C_RU", $userENC, strtotime('+7 days'), '/; samesite=strict');    
            //else setcookie ("C_RU", "", time() - 3600); //borro
            //}
      if($_POST['nDoc'] != ''){
         $USER= $this->db->loginUsuarioModel([
         $this->getSql('nDoc'),
         $this->getSql('pass'),
         $this->getSql('tDoc')
         ]);
         if( isset($USER) && ($USER) ){ 
            $_SESSION['usuario']  =  $this->objSession->encriptaSesion($USER);
            $this->session        =  $this->objSession->desencriptaSesion();
            // GENERA VARIBLE DE SESSION CON EL CODIGO DEL MENU
            $_SESSION['s_menu']    = $this->generaMenu();
                                     $this->verificarAcceso();
         }else{
            $response['menssage']  = $_SESSION['message'] = 'Credenciales no validas';
            $_SESSION['color']     = "danger";
            return false;
         }
      }
      $con  = $this->loadModel('consultas.sql', 'sql');
      $r = $con->verCategoria();
      $this->_view->categoria = ['response_status'=>'ok','response_msg'=> $r];         
         ///EMPRESA VALIDADA, PUEDE SEGUIR
         //Validacion de zona horaria
         /*
         if($r->row[4] != 'co'){
            $partes = explode('.', $_SERVER['HTTP_HOST']);
            if($r[4]!=$partes[0]) 
               return ['response_status'=>'error','response_msg'=>'El acceso de esta Empresa no puede ser por esta URL'];
         }
         //Validaci�n del estatus del cliente
         if($r->row[6]!=0){ 
            return ['response_status'=>'error','response_msg'=>'Servicio Suspendido'];
         }
         */ 
         //OOOOJJJJOOOO registrar intentos de ingreso fallidos
      }
     // return $this->validaUser([$r->row[0], $usuario, $clave]);
   }





/*
      //egc. Determino si el usuario es empleado o cliente
      if($r->row[0]==='N'){
         $innerTipoUser = "INNER JOIN dt_clientes E ON S.identificacion = E.cli_nit";
         //$_SESSION['s_sexo']='o';
      }else{
         $innerTipoUser = "INNER JOIN dt_empleado E ON S.identificacion = E.emp_cedula";
      }
      //Valido Clave
      $r    = $con->m_consulta(3, [$innerTipoUser, $par[1], $par[2]]);
      if($r->num_rows==0){
         return ['response_status'=>'error','response_msg'=>'Credenciales inv�lidas'];
      }
      session_regenerate_id(); 
      $empced 	      = $r->row[0];
      $modulo			= $r->row[1];
      $centroprod		= $r->row[2];
      $centroprodnom	= $r->row[3]; 
      if($modulo==='N') {//Si es Cliente VIP tomo datos	
      }else{  
      }
      return ['response_status'=>'ok','response_msg'=>''];
   }
      */
?>
