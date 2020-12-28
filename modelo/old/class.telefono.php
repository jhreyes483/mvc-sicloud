<?php   

include_once 'class.conexion.php';
include_once '../controlador/controladorforms.php';
class Telefono extends Conexion{

protected $us;
protected $em;
protected $tel;
protected $CF_us;
protected $CF_tipo_doc;
protected $CF_rut;
protected $db;


public function __construct(  $_tel, $_CF_us , $_CF_tipo_doc , $_CF_rut, $us, $em )
{
    $this->tel = $_tel;
    $this->CF_us = $_CF_us;
    $this->CF_tipo_doc = $_CF_tipo_doc;
    $this->CF_rut = $_CF_rut;
    $this->us = $us;
    $this->em = $em;
    $this->db = self::conexionPDO();;
}


// METODOS

static function ningunDato(){
    return new self ("","","","","","");
}


public function insertTelefonoUsuario(){
    //include_once '../clases/class.conexion.php';
    //$c = new Conexion;
    $sql = "INSERT INTO sicloud.telefono ( tel,CF_us)values('$this->tel', '$this->CF_us ')";
    $stm = $this->db->prepare($sql);
    $stm -> bindValue (":tel",$this->tel);
    $stm -> bindValue (":CF_us",$this->CF_us);
    $insert = $stm->execute();
    //echo $sql;
    //$insert = $c->query($sql);
       
   if($insert){   
    $_SESSION['message'] =  'A registrado telefono para su cuenta, si desea ingresa otro telefono, favor digite';
    $_SESSION['color'] = 'success'; 


    }else{
        $_SESSION['message'] =  'No registro telefono';
        $_SESSION['color'] = 'danger'; 
        }

        header("location: ../vista/formTelefono.php ");
}// fin de insert telefono usuario

// muestra los datos por id------------------------------------------------------------
public function verTelefonosUsuarioPorID($id){
//include_once '../clases/class.conexion.php';
//$c = new Conexion;
    $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
        from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
        join usuario U on R_U.FK_us = U.ID_us
        join telefono T on  U.ID_us = T.CF_us
        where CF_us = :id";
        $consulta= $this->db->prepare($sql);
        $consulta->bindValue(':id', $id);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
//echo $sql;
//$result= $c->query($sql);
//return $result;
}
// Fin de mostrar datos por id
//-----------------------------------------------------------------------------------------


// muestra los datos por id------------------------------------------------------------
public function verTelefonosUsuario(){
    //include_once 'class.conexion.php';
    //$c = new Conexion;
    $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
    from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
    join usuario U on R_U.FK_us = U.ID_us
    join telefono T on  U.ID_us = T.CF_us";
    $consulta= $this->db->prepare($sql);
    $result = $consulta->execute();
    $result = $consulta->fetchAll();
    return $result;
    //echo $sql;
    //$result= $c->query($sql);
    //return $result;
    }
    // Fin de mostrar datos por id
    //------------------------------------------------------------------------------------------


// muestra los datos por rol------------------------------------------------------------
public function verTelefonosUsuarioRol($rol){
    //include_once '../clases/class.conexion.php';
    //$c = new Conexion;
    $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
            from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
            join usuario U on R_U.FK_us = U.ID_us
            join telefono T on  U.ID_us = T.CF_us
            where R_U.FK_rol = :rol";

    $consulta= $this->db->prepare($sql);
    $consulta -> bindValue (":rol",$rol);
    $result = $consulta->execute();
    $result = $consulta->fetchAll();
    return $result;
    //echo $sql;
    //$result= $c->query($sql);
    //return $result;
    }
    // Fin de mostrar telefono rol
    //------------------------------------------------------------------------------------------

    

    
// muestra telefonos de empresa------------------------------------------------------------
public function verTelefonosEmpresa(){
    //include_once '../clases/class.conexion.php';
    //$c = new Conexion;
    $sql = "SELECT E_P.ID_rut , E_P.nom_empresa , T.tel
    from empresa_provedor  E_P join telefono T on E_P.ID_rut = T.CF_rut;";
    $consulta= $this->db->prepare($sql);
    $result = $consulta->execute();
    $result = $consulta->fetchAll();
    return $result;
    //echo $sql;
    //$result= $c->query($sql);
    //return $result;
    }
    // Fin de ver telefonos empresas
    //------------------------------------------------------------------------------------------
  
    public function verTelefonos(){
    $us = false; $em = false;

    //--- EVENTOS DE FORMULARIO----------------------------------------------------------------------

    // Filtro por id
    if ((isset($_GET['accion'])) &&  ($_GET['accion'] == 'bId')) {
        if ($_GET['documento'] > 0) {
            $us = True; $em = false;
            $id = $_GET['documento'];
            $objModTel = new ControllerDocForm();
            $datos = $objModTel->verTelefonosUsuarioPorID($id);
            //$datos = $telefono->selectIdUsuario($id);
            $_SESSION['message'] = "Filtro por id";
            $_SESSION['color'] = "info";
        } else {
            $_SESSION['message'] = "No ha digitado el ID del usuario";
            $_SESSION['color'] = "danger";
        } // fin de consulta por id
    } // fin de isset accion



    // Filtro por entidad
    if ((isset($_POST['accion'])) &&  ($_POST['accion'] == 'entidad')) {
        $us = true; $em = false;
        if ((isset($_POST['entidad']))) {
            if ($_POST['entidad'] == "a") {
                $entidad = 1;
                $objModTel = new ControllerDocForm();
                $datos = $objModTel->verTelefonosUsuario();
                $_SESSION['message'] = "Filtro por telefono de usuario";
                $_SESSION['color'] = "info";
            } else {
                $us = false; $em = true;
                $entidad = 0;
                $objModTel = new ControllerDocForm();
                $datos = $objModTel->verTelefonosEmpresa();
                $_SESSION['message'] = "Filtro por telefono de empresa";
                $_SESSION['color'] = "info";
            }
        } // fin consulta por entidad
    } // fin isset accion


    // Filtro por rol de usuario
    if (isset($_POST['consultaRol'])) {
        $us = True; $em = false;
        $rol = $_POST['rol'];
        $objModTel = new ControllerDocForm();
        $datos= $objModTel->verTelefonosUsuarioRol($rol);
    } // fin de isset consulta rol


    //if (isset($_SESSION['message'])) {  */ 
  }


  public function eliminarTelefono($idg){
   
    $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
    $consulta2 = $this->db->prepare($sql1);
         $rest1 =  $consulta2->execute();   
    if ($rest1) {
       $sql2 = "DELETE FROM sicloud.telefono WHERE CF_us =:CF_us ";   
       $consulta3 = $this->db->prepare($sql2);
       $consulta3->bindValue(":CF_us",$idg);
        $res2 = $consulta3->execute();  
    }   
    if ($res2) {
       $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
       $consulta4 = $this->db->prepare($sql3);
        $res3 = $consulta4->execute();
    }
    if ($res3) {
        

       $_SESSION['message'] = $_SESSION['usuario']['nom1'] . 'Elimino telefono';
       $_SESSION['color'] = 'success';
       return true;
    } else {

       $_SESSION['message'] = 'No elimino telefono';
       $_SESSION['color'] = 'danger';
       return false;
    }
 }


}// fin de la clase telefono


// $objMod = Telefono::ningunDato();
// $a = $objMod->verTelefonosUsuarioPorID(1);
// echo '<pre>'; print_r($a);  echo '</pre>';


?>