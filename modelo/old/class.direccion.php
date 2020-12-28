<?php

include_once 'class.conexion.php';

class Direccion extends Conexion{
    protected $dir;
    protected $CF_us;
    protected $CF_tipo_doc;
    protected $FK_barrio;
    protected $FK_localidad;
    protected $FK_ciudad;
    protected $CF_rut;
    protected $db;

    public function __construct( $_dir , $_CF_us , $_CF_tipo_doc , $_FK_barrio , $_FK_localidad , $_FK_ciudad , $_CF_rut ){

        $this->dir = $_dir;
        $this->CF_us = $_CF_us;
        $this->CF_tipo_doc = $_CF_tipo_doc;
        $this->FK_barrio = $_FK_barrio;
        $this->FK_localidad = $_FK_localidad;
        $this->FK_ciudad = $_FK_ciudad;
        $this->CF_rut = $_CF_rut;
        $this->db = self::conexionPDO();

    }

//Metodos


public function InsertDireccionUsuario(){
    include_once 'class.conexion.php';
    $c = new conexion;
    $sql = "INSERT INTO sicloud.direccion ( dir,CF_us,CF_tipo_doc,FK_barrio,  FK_localidad, FK_ciudad)values('$this->dir' , '$this->CF_us', '$this->CF_tipo_doc','$this->FK_barrio', '$this->FK_localidad'  , '$this->FK_ciudad')";
    $stm = $this->db->prepare($sql);
    $stm -> bindValue (":dir", $this->dir);
    $stm -> bindValue (":CF_us",$this->CF_us);
    $stm -> bindValue (":CF_tipo_doc",$this->CF_tipo_doc);
    $stm -> bindValue (":FK_barrio",$this->FK_barrio);
    $stm -> bindValue (":FK_localidad",$this->FK_localidad);
    $stm -> bindValue (":FK_ciudad",$this->FK_ciudad);
    $insert = $stm->execute();

    if($insert){
        echo '<script>alert("inserto datos")</script>';
      //  include_once '../assest/session/sessiones.php';
        $_SESSION['message'] = "Registro Direccion";
        $_SESSION['color'] = "success";
     }else{ 
        echo '<script>alert("Registro Fallido")</script>';

   
        $_SESSION['message'] = "No registro Empresa";
        $_SESSION['color'] = "success";
    }
}
   
    //echo $sql;
    //INSERT INTO sicloud.direccion ( dir,CF_us,CF_tipo_doc,FK_barrio, FK_localidad, FK_ciudad)values('calle 24 No. 8-80','1', 'CC','78','8','1');
    //echo $sql;
    //$insert = $c->query($sql);

    
}









