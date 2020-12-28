<?php

include_once 'class.conexion.php';


class Documento extends Conexion{

    // tipo de acceso

    protected $id_acronimo;
    protected $nom_doc;
    protected $db;
    //constructor
    public function __construct($_id_acronimo, $_nom_doc)
    {
        $this->id_acronimo = $_id_acronimo;
        $this->nom_doc = $_nom_doc;
        $this->db = Conexion::conexionPDO();
    }


    //static
    static function ningunDatoD(){
        return new self('','');
    }


    public function verDocumeto(){
        $sql = "SELECT * FROM tipo_doc";
        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        $result =  $consulta->fetchAll();
        return $result;
    }

}

?>

