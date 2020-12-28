<?php 
include_once 'class.conexion.php';

class Barrio extends Conexion{
protected  $nom_barrio;
protected  $FK_localidad;
protected  $FK_ciudad;
protected  $ID_barrio;
protected  $db;

public function __construct(  $_nom_barrio , $_FK_localidad , $_FK_ciudad , $_ID_barrio = "")
{
    $this->nom_barrio = $_nom_barrio;
    $this->FK_localidad = $_FK_localidad;
    $this->FK_ciudad = $_FK_ciudad;
    $this->ID_barrio = $_ID_barrio;
    $this->db = self::conexionPDO();
}


// METODOS

// ver barrios por id de localidad 
static function verBarrioPorLocalidad($FK_localidad ){
    include_once 'class.conexion.php';
    $c = new Conexion;
    $sql  = "SELECT * FROM barrio WHERE FK_localidad = '$FK_localidad'";
    $result = $c->query($sql);
    return $result;
}// fin de ver barrio por id
//---------------------------------------------------------------------


// ver barrios por id de localidad 
static function verBarrio(){
    include_once 'class.conexion.php';
    $c = new Conexion;
    $sql  = "SELECT * FROM barrio";
    $result = $c->query($sql);
    return $result;
}// fin de ver barrio por id
//---------------------------------------------------------------------


}


?>