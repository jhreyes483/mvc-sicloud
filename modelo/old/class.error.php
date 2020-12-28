<?php

include_once 'class.conexion.php';

class ErrorLog extends Conexion
{

    protected  $descrip_error;
    protected  $fecha;
    protected  $hora;
    protected  $ID_error;
    protected  $db;


    public function __construct($_descrip_error, $_fecha, $_hora, $_ID_error = "")
    {

        $this->descrip_error = $_descrip_error;
        $this->fecha = $_fecha;
        $this->hora = $_hora;
        $this->ID_error = $_ID_error;
        $this->db = self::conexionPDO();
    }

    static function ningunDato()
    {
        return new self("", "", "", "", "");
    }

    public function verError()
    {

        //$c = new Conexion;
        $sql = "SELECT * FROM log_error";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //$insert =  $c->query($sql);
        //return $insert;
    } // fin de ver error

    public function eliminarErrorLog($id)
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
        $consulta1 = $this->db->prepare($sql1);
        $res =  $consulta1->execute();
        if ($res) {
            $sql2 = "DELETE FROM log_error WHERE ID_error = $id";
            $consulta2 = $this->db->prepare($sql2);
            $consulta2->bindValue(":id", $id);
            $res1 = $consulta2->execute();
        }


        //$i = $c->query($sql);


        /* if ($i) {
        $_SESSION['message'] = "Se elimino error";
        $_SESSION['color'] = "danger";
    } else {
        $_SESSION['message'] = "Error al eliminar";
        $_SESSION['color'] = "danger";
    }*/
        header("location: ../vista/formLogError.php");
    }
}
