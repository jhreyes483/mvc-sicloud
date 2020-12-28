<?php

include_once 'class.conexion.php';
class Modificacion extends Conexion{


protected $descrip;
protected $fecha;
protected $hora;
protected $FK_us;
protected $FK_doc;
protected $FK_modific;
protected $db;

public function __construct(  $_descrip, $_fecha, $_hora, $_FK_us, $_FK_doc, $_FK_modific)
{

    $this->descrip=$_descrip;
    $this->fecha=$_fecha;
    $this->hora=$_hora;
    $this->FK_us=$_FK_us;
    $this->FK_doc = $_FK_doc;
    $this->FK_modific = $_FK_modific;
    $this->db = self::conexionPDO();
}


//METODOS
static function ningunDato(){
    return new self("","","","","","");
}

//------------------------------------------
//Ver fecha actual
public function fechaActual()
{
  //include_once 'class.conexion.php';
  //$c = new Conexion;
  $sql = "SELECT CURDATE() as fecha";
   $stm= $this->db->prepare($sql);
        $result = $stm->execute();
        $result = $stm->fetchAll();
        return $result;
  //$dat =  $c->query($sql);
  //$datos = $dat->fetch_assoc();
  //$fecha =  $datos['fecha'];
  $fecha = $result['fecha'];
  return $fecha;
}
//------------------------------------------
//------------------------------------------
//Ver fecha hora
public function horaActual()
{
  //include_once 'class.conexion.php';
  //$c = new Conexion;
  $sql = "  SELECT DATE_FORMAT(NOW( ), '%H:%i:%S' )as hora ;";
  $stm =$this->db->prepare($sql);
  $result = $stm->execute();
  $result = $stm->fetchAll();
  //$dat =  $c->query($sql);
  //$datos = $dat->fetch_assoc();
  $hora =  $result['hora'];
  return $hora;
}
//------------------------------------------


//------------------------------------------
//insertar modificacion 
public function insertModificacion(){
    //include_once 'class.conexion.php';
    //$c =  new Conexion;
    $sql = "INSERT into sicloud.modific(descrip , fecha , hora ,FK_us , FK_doc , FK_modific) value ( '$this->descrip' , '$this->fecha' , '$this->hora' , '$this->FK_us' , '$this->FK_doc' , '$this->FK_modific')";
     // insert into sicloud.modific(descrip , fecha , hora ,FK_us , FK_doc , FK_modific) value ( null , '2019-07-14' , '20:30:05' , '2' , 'CC' , '1'  ),
    $stm = $this->db->prepare($sql);
    $stm->bindValue(":descrip",$this->descrip);
    $stm->bindValue(":fecha",$this->fecha);
    $stm->bindValue(":hora",$this->hora);
    $stm->bindValue(":FK_us",$this->FK_us);
    $stm->bindValue(":FK_doc",$this->FK_doc);
    $stm->bindValue(":FK_modific",$this->FK_modific);
    $insert = $stm->execute();
     //$insert = $c->query($sql);
    //echo $sql;
    if ($insert) {
        $_SESSION['message'] = "Se inserto registro de modificacion";
        $_SESSION['color'] = "success";
      } else {
        $_SESSION['message'] = "No se inserto registro de modificacion";
        $_SESSION['color'] = "success";
      }
}// fin de insersion modificacion
//------------------------------------------


//------------------------------------------
//ver join de modificaciones
public function verJoinModificacionesDB(){
    //include_once 'class.conexion.php';
    //$c =  new Conexion;


    $sql = "SELECT M.ID_modifc , M.descrip , M.fecha , M.hora , M.FK_us , M.FK_doc  ,  U.nom1 , U.ape1 ,  T_M.nom_modific , R.nom_rol  
        from tipo_modific T_M JOIN modific M on T_M.ID_t_modific =  M.FK_modific
        JOIN usuario U ON M.FK_us = U.ID_us
        JOIN rol_usuario R_U on U.ID_us = R_U.FK_us
        JOIN rol R on R_U.FK_rol = R.ID_rol_n";
         $consulta= $this->db->prepare($sql);
         $result = $consulta->execute();
         $result = $consulta->fetchAll();
         return $result;
     //insert into sicloud.modific(descrip , fecha , hora ,FK_us , FK_doc , FK_modific) value ( null , '2019-07-14' , '20:30:05' , '2' , 'CC' , '1'  ),
     //$consulta=  $c->query($sql);
     //return $consulta;
   
      
}// fin de join modificacion
//------------------------------------------

//select ID_modifc , M.descrip , M.fecha , M.hora , M.FK_us , M.FK_doc , M.FK_modific, T_M.nom_modific   
//from modific M JOIN tipo_modific T_M ON T_M.ID_t_modific = M.FK_modific;


}// fin de clase modificacion

?>