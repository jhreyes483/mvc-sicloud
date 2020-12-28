<?php   

include_once 'class.conexion.php';

class Rol extends Conexion {


protected $nom_rol;
protected $ID_rol;
protected $db;

public function __construct(  $_nom_rol, $_ID_rol = ""  )
{
    $this->nom_rol = $_nom_rol;
    $this->ID_rol = $_ID_rol;
    $this->db = self::conexionPDO();
}

public function get_nom_rol(){
    return $this->nom_rol;
}

public function get_id_rol(){
    return $this->ID_rol;
}


// funcion que no devuelve datos                R
static function ningunDato(){
    return new self ('','');
   }// fin de lectura ningun dato

// insertar roles                                C  
public function insertRol(){

    $sql = "INSERT INTO sicloud.rol ( nom_rol )VALUES( :nom_rol )";
    $rol = $this->db->prepare($sql);
    $rol->bindValue(':nom_rol',$this->nom_rol);
    //  $stm->bindValue(":nom_empresa", $this->nom_empresa);
    $bool =$rol->execute();
   
   if($bool){   
       $_SESSION['message'] =  'Se a creado el rol';
       $_SESSION['color'] = 'success'; 


}else{
    $_SESSION['message'] =  'Error no se a creado rol';
    $_SESSION['color'] = 'danger'; 

}

header("location: ../vista/formRol.php ");
 
}//fin de insertRol




// metodo ver roles                            R
public function verRol(){
       $sql = "SELECT * FROM sicloud.rol";
       $consulta = $this->db->prepare($sql);
       $consulta->execute();
       $result = $consulta->fetchAll();
       return $result;
   }// fin de lectura rol


  
   // metodo ver rol por id                   R
   public function verRolId($id){
    //include_once 'class.conexion.php';
      // $con = new Conexion;
       $sql = "SELECT * FROM sicloud.rol WHERE ID_rol_n = $id";
       $consulta = $this->db->prepare($sql);
       $consulta->execute();
       $result = $consulta->fetchAll();
       return $result;
       //$r = $con->query($sql);
       //return $r;
   }// fin de ver rol por ID


   // Actualizar datos                       U
public function insertUpdateRol($id){ 
    //include_once 'class.conexion.php';

      //  $con = new Conexion;
        $sql = "UPDATE sicloud.rol SET nom_rol = '$this->nom_rol'  WHERE ID_rol_n = $id";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":nom_rol",$this->nom_rol);
        $stm->bindValue(":ID_rol_n",$this->ID_rol);
        $ri = $stm->execute();
        //$ri = $con->query($sql);
        if($ri){ echo "<script>alert('Se actualizo Rol exitioso');</script>"; echo "<script>window.location.replace('../vista/formRol.php');</script>"; }else{  echo "<script>alert('Error al actualizar rol ');</script>"; echo "<script>window.location.replace('../vista/formRol.php');</script>"; }
      
     if($ri){
         $_SESSION['message'] = "Se actualizo el rol";
         $_SESSION['color'] = "primary";

     }
     header("location: ../forms/formRol.php ");
    }// fin de insert update rol       
    
    
// Borrar rol                               D
public function eliminarRol($id){ 
    //include_once 'class.conexion.php';
  

    //$con = new Conexion;
    $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
    $stm = $this->db->prepare($sql1);
    $res = $stm->execute();
    //     $res =   $con->query($sql1);

    if($res){
        $sql2 = " DELETE FROM sicloud.rol WHERE ID_rol_n = $id  ";
        $stm = $this->db->prepare($sql2);
        $res1 = $stm->execute();
        //$res1 = $con->query($sql2); 
    }

    if($res1){
        $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
        $stm = $this->db->prepare($sql3);
        $res2 = $stm->execute();
        // $res2 = $con->query($sql3);
    }

  
    if($res2){ echo "<script>alert('Se elimino Rol exitioso');</script>"; echo "<script>window.location.replace('../vista/formRol.php');</script>"; }else{  echo "<script>alert('Error al eliminar rol ');</script>"; echo "<script>window.location.replace('../vista/formRol.php');</script>"; }
    if($res2){
        $_SESSION['message'] = "Se elimino el rol";
        $_SESSION['color'] = "danger";

    }else{}
    header("location:../vista/formRol.php ");
}

} // fin de clase rol

?>