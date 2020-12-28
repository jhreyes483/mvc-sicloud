<?php
include_once 'class.conexion.php';
class Pago extends Conexion{

protected $nom_tipo_pago;
protected $ID_tipo_pago;
protected $db;

public function __construct( $_nom_tipo_pago  , $_ID_tipo_pago = "" )
{
    $this->nom_tipo_pago = $_ID_tipo_pago;
    $this->ID_tipo_pago = $_nom_tipo_pago;
    $this->db = self::conexionPDO();
}

// Metodos

public function verPago(){
//$c = new Conexion;
        $sql = "SELECT *  FROM tipo_pago";
//$dat = $c->query($sql);
//return $dat;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
}


}


















?>