<?php

include_once 'class.conexion.php';
//creacion de clase
class Medida extends Conexion
{
    //Definir accesibilidad 
    protected $nom_medida;
    protected $acron_medida;
    protected $id_medida;
    protected $db;
    
    //Definir contractor
    public function __construct($_nom_medida, $_acron_medida, $_id_medida = ""){
        $this->nom_medida = $_nom_medida;
        $this->acron_medida = $_acron_medida;
        $this->id_medida = $_id_medida;
        $this->db = self::conexionPDO();
    }

    //get
    public function get_nom_medida()
    {
        return $this->nom_medida;
    }

    public function get_acron_medida()
    {
        return $this->nom_medida;
    }

    public function get_id_medida()
    {
        return $this->id_medida;
    }

    static function ningunDatoM(){
        return new self('', '','');
    }

    //METODO Insertsar medida
    public function insertMedia()
    {


        $sql = "INSERT INTO sicloud.tipo_medida(nom_medida, acron_medida)VALUES( :nom_medida,  :acron_medida)";
        // v$ejecucion = $db->query($sql);
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":nom_medida", $this->nom_medida);
        $stm->bindValue(":acron_medida", $this->acron_medida);
        $insert = $stm->execute();
        if ($insert ) {
            $_SESSION['message'] = "Se creo medida";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['message'] = "error al crear medida";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/formMedida.php");
    } // fin de insertar medida



    //CREACION DE METODOS acceso sin ser una extancia

    //metodo mostrar datos
    public function verMedida()
    {
        //include_once 'class.conexion.php';
        //$conexion = new Conexion;
        $sql = "SELECT * FROM  tipo_medida";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $conexion->query($sql);
        //return $result;
    }

    //mostrar datos por ID
    public function verDatoPorId($id)
    {
        //include_once 'class.conexion.php';
        //$conexion = new Conexion;
        $sql = "SELECT * FROM  tipo_medida WHERE ID_medida = $id ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;//$result = $conexion->query($sql);
        //return $result;
    }

    //Actualizar datos 
    public function actualizarDatosMedida($id)
    {
       // include_once 'class.conexion.php';
       // $c = new Conexion;
        $sql = "UPDATE tipo_medida SET nom_medida = '$this->nom_medida'  , acron_medida = '$this->acron_medida' WHERE ID_medida = '$id' ";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":id",$this->id_medida);
        $stm->bindValue(":nom_medida",$this->nom_medida);
        $stm->bindValue(":acron_medida",$this->acron_medida);
        $result = $stm->execute();
        //"UPDATE sitio_t SET nom_sitio = '$sitio', Fk_capital = '$FK_capital'  WHERE id_sitio = $id "
        //$ejecucion = $c->query($sql);
        if ($result) {
            $_SESSION['message'] = "Se actualizo medida";
            $_SESSION['color'] = "primary";
        } else {
            $_SESSION['message'] = "error al actualizar medida";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/formMedida.php");
    }


    //eliminar registros
    public function eliminarDatosMedia($id)
    {
        //include_once 'class.conexion.php';
       // $con = new Conexion();
        $sql = "DELETE FROM tipo_medida WHERE ID_medida = '$id' ";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":id",$this->id_medida);
        $result = $stm->execute();
        // $ejecucion = $con->query($sql);
        if ($result) {
            $_SESSION['message'] = "Elimino medida";
            $_SESSION['color'] = "danger";
        } else {
            $_SESSION['message'] = "Error Elimino medida";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/formMedida.php");
    }
}
