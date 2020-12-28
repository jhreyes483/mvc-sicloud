<?php
include_once 'class.conexion.php';

// creacion de clase
class Proveedor extends Conexion{
  //accecsivilidad
  protected $ID_rut;
  protected $nom_empresa;
  protected $db;
  //Constructor
  public function __construct($_ID_rut, $_nom_empresa){
    $this->ID_rut = $_ID_rut;
    $this->nom_empresa = $_nom_empresa;  
    $this->db = self::conexionPDO();
  }
  public function get_ID_rut (){
    return $this->ID_rut; 
  }
  public function get_nom_empresa (){
    return $this->nom_empresa; 
  }
  static function ningunDatoP(){
      return new self('','');
  }
  //metodo visualizar datos 
  public function verProveedor(){
      $sql = "SELECT * FROM empresa_provedor";
      $c = $this->db->prepare($sql);
      $c->execute();
      $r = $c->fetchAll();
      return $r;
  }

}

?>