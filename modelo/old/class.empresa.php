<?php
include_once 'class.conexion.php';

class Empresa extends Conexion
{
    protected $ID_rut;
    protected $nom_empresa;
    protected $db;

    public function __construct($_ID_rut = '',  $_nom_empresa){
        $this->ID_rut = $_ID_rut;
        $this->nom_empresa = $_nom_empresa;
        $this->db = self::conexionPDO();
    }
    public function get_ID_rut(){
        return $this->ID_rut;
    }
    public function get_nom_empresa(){
        return $this->nom_empresa;
    }
    static function ningunDatoP(){
        return new self('', '', '', '', '', '', '');
    }

    //Metodo insertar 
    public function insertEmpresa(){
        $sql = "INSERT INTO sicloud.empresa_provedor (ID_rut, nom_empresa)VALUES( :ID_rut, :nom_empresa)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":ID_rut", $this->ID_rut);
        $stm->bindValue(":nom_empresa", $this->nom_empresa);
        $insert = $stm->execute();
        if($insert){
            echo '<script>alert("inserto datos")</script>';
          //  include_once '../assest/session/sessiones.php';
            $_SESSION['message'] = "Registro Empresa";
            $_SESSION['color'] = "success";
         }else{ 
            echo '<script>alert("Registro Fallido")</script>';

            $this->ver($insert);
            $_SESSION['message'] = "No registro Empresa";
            $_SESSION['color'] = "success";
        }
    }



    // ver empresa
    public  function verEmpresa(){
        $sql = "SELECT * FROM sicloud.empresa_provedor";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
    }


    public function ver($dato, $sale=0, $float= false, $email=''){
        echo '<div style="background-color:#fbb; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding:7px; border-radius:7px; margin-top:10px">';
        if(is_array($dato) || is_object($dato) ){
            echo '<pre><br><b>&raquo;&raquo;&raquo; DEBUG</b><br>'; print_r($dato); echo '</pre>'; 
        }else{
            if(isset($dato)){
                echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
            }else{
                echo 'LA VARIABLE NO EXISTE';
            }
        }
        echo '</div>';
        if($sale==1) die();
    }

    // Eliminar 
    public function eliminarEmpresa($id){
        $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
        $consulta1 = $this->db->prepare($sql1);
        $res =  $consulta1->execute();
        if($res){
            $sql2 = "DELETE  FROM sicloud.empresa_provedor WHERE ID_rut = :id ";
            $consulta2=$this->db->prepare($sql2); 
            $consulta2->bindValue(":id", $id);
            $res1 = $consulta2->execute();
       }
   
       if($res1){
            $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
            $consulta3=$this->db->prepare($sql3);
            $res2 = $consulta3->execute();
       }

        if ($res2) {
            $_SESSION['message'] = "Elimino empresa";
            $_SESSION['color'] = "danger";
        } else {
            $_SESSION['message'] = "Elimino empresa";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/formEmpresa.php ");
    }
   
    public function verDatoPorId($id){
        $sql = "SELECT * FROM sicloud.empresa_provedor WHERE ID_rut = '$id' ";
        $consulta= $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
    }

    public function actualizarDatosEmpresa($id){ 
        $sql = "UPDATE sicloud.empresa_provedor SET nom_empresa = :nom_empresa WHERE ID_rut = :ID ";
        $consulta = $this->db->prepare($sql);
        $consulta->bindValue(":ID", $id);
        $consulta->bindValue(":nom_empresa", $this->nom_empresa);
        $result = $consulta->execute();
        if ($result = true) {
            echo '<script>alert("inserto datos");</script>';
           // $_SESSION['message'] = "Actualizacion exitosa";
           // $_SESSION['color'] = "primary";
        } else {
            echo '<script>alert("no actualizo");</script>';
           // $_SESSION['message'] = "Fallo actualizacion";
           // $_SESSION['color'] = "danger";
        }
        header("location: ../vista/FormEmpresa.php");
    }


}//fin de clase probedor
