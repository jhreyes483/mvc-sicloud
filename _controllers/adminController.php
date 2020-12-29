<?php
class adminController extends Controller{
    private $db;
    private $param;

    public function __construct(){
        $this->db = $this->loadModel('consultas.sql', 'sql');
        parent::__construct();
        $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
        $this->param = $this->getParam();
    }

    public function index(){
        $this->getSeguridad('S1S');
        $this->_view->setCss(array('google', 'bootstrap.min', 'jav', 'animate', 'font-awesome'));
        $this->datosFijos();
        $this->_view->renderizar('index');
    }

    public function a(){
        // desactiva cuenta de usuario
        $this->db->activarCuenta($this->param[0]);
        $this->datosFijos();
        $this->registraLog($this->param[0], 15);
        $this->_view->renderizar('controlUsuarios');
    }

    public function d(){
        // desactiva cuenta de usuario
        $this->db->desactivarCuenta($this->param[0]);
        $this->datosFijos();
        $this->registraLog($this->param[0], 3);
        $this->_view->renderizar('controlUsuarios');
    }

    public function consulta(){
        //
        $this->datosFijos();
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'bId':
                    // filtro por id usuario
                    if (isset($_POST['documento'])) {
                        $r  = $this->db->selectIdUsuario($this->getsql('documento'));
                        if (count($r) != 0) {

                            $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
                            if ($this->param[0] == 'api') {
                            }
                            $_SESSION['color'] = 'info';
                            $_SESSION['message'] = 'Filtro por documento';
                        } else {
                            $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'Usuario no existe'];
                            if ($this->param[0] == 'api') {
                                $this->getJson($this->_view->tabla);
                            }
                            $_SESSION['color'] = 'danger';
                        }
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'Error al leer el id'];
                        if ($this->param[0] == 'api') {
                            $this->getJson($this->_view->tabla);
                        }
                        $_SESSION['color'] = 'danger';
                    }
                    break;
                case 'estado':
                    // filtro por estado
                    $r = $this->db->selectUsuariosPendientes($this->getInt('estado'));
                    if (count($r) != 0) {
                        $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
                        $_SESSION['color'] = 'info';
                        $_SESSION['message'] = 'filtro por estado';
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg ' => 'No hay usuarios'];
                        $_SESSION['color'] = 'danger';
                    }
                    break;
                case 'consRol':
                    // filtro por rol
                    $r = $this->db->selectUsuarioRol($this->getInt('rol'));
                    if (count($r) != 0) {
                        $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
                        $_SESSION['color'] = 'info';
                        $_SESSION['message'] = 'filtro por rol';
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg ' => 'No hay usuarios'];
                        $_SESSION['color'] = 'danger';
                    }
                break;
                case 'updateUsuario':
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
                  // Controller::ver($array, 1);
                    $bA =   $this->db->actualizarDatosUsuario($this->getSql('ID_us'), $array );
                    if($bA){
                        $bB = $this->registraLog($this->getSql('ID_us'),2);
                    }

                    if( $bB ){
                        $_SESSION['message']  = "Actualizo usuario";
                        $_SESSION['color']    = "success";
                    }else{
                        $_SESSION['message']  = "Error no actualizo usuario"; 
                        $_SESSION['color']    = "danger";
                    }
                break; 

            }
        } else {
        }
        $this->_view->renderizar('controlUsuarios');
        $this->_view->setTable('lis', 3, 0);
    }

    public function controlUsuarios(){
        $this->datosFijos();
        // vista
        $this->getSeguridad('S1S');
        $this->_view->setCss(array('google', 'bootstrap.min', 'jav', 'animate', 'font-awesome'));
        $this->_view->renderizar('controlUsuarios');
        $this->_view->setTable('lis', 3, 0);
    }

    public function datosFijos(){
        $this->db               = $this->loadModel('consultas.sql', 'sql');
        $rols                    = $this->db->verRol();
        $c1                      = $this->db->conteoUsuariosActivos();
        $c2                      = $this->db->conteoUsuariosInactivos();
        $t                       = ($c1 + $c2);
        $this->_view->datosFijos        = [
            $rols, // Rol de usuario para el select
            $c1 ?? 0,
            $c2 ?? 0,
            $t ?? 0
        ];
    }

    public function logError(){
        // vista
        // pendinte crear metodo eliminar log
        $this->getSeguridad('S1LE');
        $r =  $this->db->verError();
        if (count($r) != 0) {
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
        } else {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay log de errores'];
        }
        $this->_view->renderizar('logError');
        $this->_view->setTable('log', 2);
    }

    public function logActividad(){
        //vista
        $this->getSeguridad('S1LA');
        $r = $this->db->verJoinModificacionesDB();
        if (count($r) != 0) {
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
        } else {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay log de actividad'];
        }

        if (isset($_POST['accion']) && $_POST['accion'] == 'deleteLog') {
            $b = $this->db->deleteLog($_POST['id']);
            if ($b) {
                $_SESSION['message'] = 'Elimino registro ';
                $_SESSION['color'] = 'success';
            } else {
                $_SESSION['message'] = 'Error al eliminar registro';
                $_SESSION['color'] = 'danger';
            }
        }



        $this->_view->renderizar('logActividad');
        $this->_view->setTable('actividad', 2, 4);
    }

    public function logNotificacion(){
        $this->getSeguridad('S1LN');

        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'deleteNotific':
                $r = $this->db->delteNotificacion($_POST['id']);
                if ($r) {
                    $_SESSION['message'] = 'Elimino log';            $_SESSION['color']  = 'success';
                } else {
                    $_SESSION['message'] = 'Error al eliminar log';  $_SESSION['color'] = 'danger';
                }
                break;
                case 'notificLeida':
                    $r = $this->db->notificacionLeida($_POST['id']);
                    if($r){
                        $_SESSION['message'] = 'Update exitoso exitosa'; $_SESSION['color']  = 'success';
                   }else{
                        $_SESSION['message'] = 'Error, aupdate'; $_SESSION['color']  = 'danger';
                      
                   }
                break;
            }
            
        }
        $r = $this->db->consNotificacionesT();
        if (count($r) == 0) {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay notificaciones'];
        } else {
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
        }
        $this->_view->renderizar('logNotificacion');
        $this->_view->setTable('notificacion', 4, 5);
    }

    public function edit(){
        $this->getSeguridad('S1CCSM');
        $r      = $this->db->verRol();
        $d      = $this->db->verDocumeto();
        $this->_view->datosF = [ $r, $d ];
        //
        if( $_POST['id'] ){
            $u      = $this->db->selectUsuarios($_POST['id']);
            if(count($u) != 0 ){
                $this->_view->datos = ['response_status' => 'ok' , 'response_msg' => $u ];
            }else{
                $this->_view->datos = ['response_status' => 'error' , 'response_msg' => 'No hay datos de usuario'];
            }
        }else{
            $this->_view->datos = ['response_status' => 'error' , 'No ha ingresado usuario a editar'];
        }
        $this->_view->renderizar('editUsuario');
    }




}
