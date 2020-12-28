<?php 
include_once 'class.conexion.php';
class Rol_us extends Conexion{
protected $FK_rol;
protected $FK_us;
protected $FK_tipo_doc;
protected $fecha_asignacion;
protected $estado;
protected $db;
public function __construct(  $_FK_rol,  $_FK_us,  $_FK_tipo_doc,  $_fecha_asignacion, $_estado  )
{

$this->FK_rol = $_FK_rol;
$this->FK_us =  $_FK_us;
$this->FK_tipo_doc = $_FK_tipo_doc;
$this->fecha_asignacion = $_fecha_asignacion;
$this->estado = $_estado;
$this-> db = self::conexionPDO();

    
}


    //METODOS
    public function insertrRolUs(){
       // include_once 'class.conexion.php';
        
       $sql = "INSERT INTO sicloud.rol_usuario(FK_rol,FK_us,FK_tipo_doc,fecha_asignacion,estado)VALUES('$this->FK_rol' , '$this->FK_us','$this->FK_tipo_doc','$this->fecha_asignacion','$this->estado')";
       $stm = $this->db->prepare($sql);
       $stm->bindValue(":FK_rol",$this->FK_rol);
       $stm->bindValue(":FK_us",$this->FK_us);
       $stm->bindValue(":FK_tipo_doc",$this->FK_tipo_doc);
       $stm->bindValue(":fecha_asignacion",$this->fecha_asignacion);
       $stm->bindValue(":estado",$this->estado);
       $res = $stm->execute();

       //$con = new Conexion;

     //$con->query($sql);
     if($res){ echo "<script>alert('Actualizasion Actualizacion rol usuario')</script>"; echo "<script>window.location.replace('../vista/CU002-registrodeUsuario.php')</script>"; }else{ echo "<script>alert('Error en actualizacion de categoria')</script>"; echo "<script>window.location.replace('../vista/CU002-registrodeUsuario.php')</script>";   }  

     if($res ) {  $_SESSION['message'] = "Se creo rol"; $_SESSION['color'] = "success";      } else {  $_SESSION['message'] = "Erro al crear rol"; $_SESSION['color'] = "danger";} header("location: ../CU002-registrodeUsuario.php ");
    }

    public function insertUpdateRol($idg)
    {
      //include_once 'class.conexion.php';
      //$con = new Conexion;
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $stm = $this->db->prepare($sql1);
      $ejecutar = $stm->execute();
      //$res =   $con->query($sql1);
  
      if ($ejecutar) {
        $sql2 = "UPDATE sicloud.rol_usuario SET FK_rol = '$this->FK_rol' , FK_us = '$this->FK_us' , FK_tipo_doc = '$this->FK_tipo_doc' , fecha_asignacion = '$this->fecha_asignacion' , estado = '$this->estado' WHERE  FK_us = $idg  ";
        $res1 = $this->db->prepare($sql2);
        $update = $res1->execute();
        //$res1 = $con->query($sql2);
      }// if de $res
  
       if ($res1) {
       $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
       $res2 = $this->db->prepare($sql3);
       $update2 = $res2->execute();
       //$con->query($sql3);
       }//if de $res1

       
     if ($res2) {
       $_SESSION['message'] = 'Se actualizo FK';
       $_SESSION['color'] = 'primary';
     } else {
      $_SESSION['message'] = 'Error no se FK';
       $_SESSION['color'] = 'danger';
     }
     header("location: ../vista/CU009-controlUsuarios.php");
     // fin de update usuario

    }// fin de insersion update usuario
} // fin de clase uaurio
