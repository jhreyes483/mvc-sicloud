<?php

include_once 'class.conexion.php';
class Ciudad extends Conexion {


protected $nom_ciudad;
protected $ID_ciudad;
protected  $db;


public function __construct($_nom_ciudad, $_ID_ciudad = '' )
{
  $this->nom_ciudad = $_nom_ciudad;
  $this->ID_ciudad = $_ID_ciudad; 
  $this->db = self::conexionPDO();
}




// METODOS

static function ningunDato(){
  return new self( '', '');

}


//-----------------------------------------------------------------
public function verCiudad(){
  $sql = "SELECT id_ciudad, nom_ciudad FROM ciudad";
  $stm=$this->db->prepare($sql);
  $stm->execute();
  $result=$stm->fetchAll();
  return $result;
}

//-----------------------------------------------------------------
// fin de metodo ver datos ciudad
//----------------------------------------------------------------



//-----------------------------------------------------------------

public function insertCiudad(){
  $sql = "INSERT INTO ciudad (id_ciudad, nom_ciudad) VALUES (:id_ciudad, :nom_ciudad)";
  $stm = $this->db->prepare($sql);
  $stm->bindValue(":id_ciudad", $this->id_ciudad);
  $stm->bindValue(":nom_ciudad", $this->nom_ciudad);
  $insert = $stm->execute();
  if($insert){
      include_once '../controlador/controlodarsession.php';
      $_SESSION['message'] = "Registro Ciudad";
      $_SESSION['color'] = "success";
    }else{ 
      $_SESSION['message'] = "No registro Ciudad";
      $_SESSION['color'] = "success";
  }
}

//-----------------------------------------------------------------
// fin de metodo registrar datos ciudad
//----------------------------------------------------------------

//-----------------------------------------------------------------
public function verCiudadId($ID_ciudad){
  //include_once 'class.conexion.php';
  //$c = new Conexion;
  $sql = "SELECT id_ciudad , nom_ciudad FROM ciudad WHERE ID_ciudad = '$ID_ciudad' ORDER BY nom_ciudad ASC ";
  $stm = $this->db->prepare($sql);
  $stm->execute();
  $result=$stm->fetchAll();
  return $result;
  //$result = $c->query($sql);
  //return $result;
}// fin de metodo ver datos ciudad
  //----------------------------------------------------------------
  }// fin de clase ciudad

$objMod = Ciudad::ningunDato();
$array =  $objMod->verCiudad();

//echo '<pre>'; print_r($array); echo '</pre>';
?>

