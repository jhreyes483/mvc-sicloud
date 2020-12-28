<?php

include_once 'class.conexion.php';
 


class Tienda extends Conexion{
   
public function listaProductos(){
    include_once   '../controlador/controladorsession.php';
    //$cnx=new Conexion;
    $sql = "SELECT * from productos";
    $consulta= $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
    //$result= $cnx->query($sql);


    // $result->fetch_array();
   //  while( $row = $result)


    foreach ($result as $row) {
        $lista[]=$row;
    }
    return $lista;
}

}

?>