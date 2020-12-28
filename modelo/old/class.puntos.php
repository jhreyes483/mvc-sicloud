<?php
include_once 'class.conexion.php';

class Puntos extends Conexion{

protected $puntos ;
protected $fecha;
protected $db;



public function __construct( $_puntos,  $_fecha   )
{

    $this->puntos = $_puntos;
    $this->fecha = $_fecha;

    $this->db = self::conexionPDO();
        
}

//metodo

public function insertPuntos( $FK_us , $FK_tipo_doc)
{
  //include_once 'class.conexion.php';
  //$c = new Conexion;
  $sql = "INSERT INTO puntos ( puntos , fecha , FK_us , FK_tipo_doc)VALUE(  '$this->puntos' , '$this->fecha' , '$FK_us' , '$FK_tipo_doc')";
  $stm = $this->db->prepare($sql);
  $stm->bindValue(":puntos",$this->puntos);
  $stm->bindValue(":fecha",$this->fecha);
  
  // $c->query($sql);


//   INSERT INTO puntos ( puntos , fecha , FK_us , FK_tipo_doc)VALUE(  '1' , '1990-08-15' , '1' , 'CC'   );

}// fin de insert punto
}// fin de clase usaurio

?>