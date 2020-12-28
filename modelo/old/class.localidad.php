<?php   
include_once 'class.conexion.php';
class Localidad extends Conexion{

protected $nom_localidad;
protected $FK_ciudad;
protected $ID_localidad;
protected $db;


public function __construct($_nom_localidad , $_FK_ciudad , $_ID_localidad = ""   )
{
    $this->nom_localidad = $_nom_localidad;
    $this->FK_ciudad = $_FK_ciudad;
    $this->ID_localidad = $_ID_localidad;
    $this->db=self::conexionPDO();
}//fin de metodo constructor

// METTODOS

//---------------------------------------------------------------------
// Lista de localidades 
public  function verLocalidadId($ID_ciudad){
//include_once 'class.conexion.php';
//$c = new Conexion;
$sql = "SELECT ID_localidad , nom_localidad FROM localidad WHERE FK_ciudad = '$ID_ciudad'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
//$r = $c->query($sql);
//return $r;
}
}// fin de localidad
?>