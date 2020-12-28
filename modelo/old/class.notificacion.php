<?php
include_once 'class.conexion.php';
class Notificacion extends Conexion
{

    protected $estado;
    protected $descript;
    protected $FK_rol;
    protected $FK_not;
    protected $ID_not;
    protected $db;

    public function __construct($_estado, $_descript, $_FK_rol, $_FK_not)
    {
        $this->estado = $_estado;
        $this->descript = $_descript;
        $this->FK_rol = $_FK_rol;
        $this->FK_not = $_FK_not;
        $this->db = self::conexionPDO();
    }

    //METODOS 


    //Insertar notificacion--------------------------------------------------------------
    public function insertNotific()
    {
        include_once 'class.conexion.php';
        $c = new Conexion;
        $sql = "INSERT into sicloud.notificacion( estado, descript, FK_rol , FK_not ) 
                VALUES ('$this->estado', $this->descript , '$this->FK_rol', '$this->FK_not')";
       /* $stm = $this->db->prepare($sql);
        $stm -> bindValue (":estado",$this->estado);
        $stm -> bindValue (":descript",$this->descript);
        $stm -> bindValue (":FK_rol",$this->FK_rol);
        $stm -> bindValue (":FK_not",$this->FK_rol);
        $insert = $stm->execute();*/
        echo $sql;
        if ($insert) {
            $_SESSION['message'] =  'Se a notificacion';
            $_SESSION['color'] = 'success';
        } else {
            $_SESSION['message'] =  'Error no al insertar notificacion';
            $_SESSION['color'] = 'danger';
        }
    } // fin de insert notificacion----------------------------------------------------


    //notificacion leida-----------------------------------------------------------------
    static function notificacionLeida($id)
    {
        include_once 'class.conexion.php';
        $c = new Conexion;
        $sql = "UPDATE sicloud.notificacion SET estado = '$id'
    where ID_not = '1'";
      //  $stm = $this->db->prepare($sql);
        $leer = $c->query($sql);
        if ($leer) {
            $_SESSION['message'] =  'Leyo la notificacion';
            $_SESSION['color'] = 'success';
        } else {
            $_SESSION['message'] =  'No pudo leer la notificacion';
            $_SESSION['color'] = 'danger';
        }
    } // fin de leer notificacion----------------------------------------------------

    //ver notificacion------------------------------------------------------------------
    static function verNotificacion($id_rol)
    {
        include_once 'class.conexion.php';
        $c = new Conexion;
        $sql = "SELECT N.ID_not , N.estado , N.descript , N.FK_rol , N.FK_not ,  t.nom_tipo
    FROM notificacion N join tipo_not T ON N.FK_not = T.ID_tipo_not
    join rol R ON N.FK_rol = ID_rol_n
    WHERE R.ID_rol_n = '$id_rol' and  N.estado = '0'";
        $result =  $c->query($sql);
        return $result;
    } // fin de ver notificaiones por rol------------------------------------------------


    //conteo de mensajes------------------------------------------------------------------
    static function conteoNotificaciones($id_rol)
    {
        include_once 'class.conexion.php';
        $c = new Conexion;
        $sql = "SELECT N.ID_not , N.estado , N.descript , N.FK_rol , N.FK_not ,  t.nom_tipo
    FROM notificacion N join tipo_not T ON N.FK_not = T.ID_tipo_not
    join rol R ON N.FK_rol = ID_rol_n
    WHERE R.ID_rol_n = '$id_rol' and  N.estado = '0'";
        $result =  $c->query($sql);
        $count = $result->num_rows;
        return $count;
    } // fin de conteo de notificaciones------------------------------------------------




    // notificacion de nueva cuenta a admin-----------------------------------------------
    public function notInsertUsuarioAdmin()
    {
        include_once 'class.conexion.php';
        $c = new Conexion;
        $sql =  "INSERT into sicloud.notificacion( estado, descript, FK_rol , FK_not ) 
    VALUES ( '$this->estado', '$this->descript' , '$this->FK_rol', '$this->FK_not')";
        $c->query($sql);

        // return $p

    } // fin de notificacion admin------------------------------------------------------




    // eliminar notificaciones de usuario --------------------------------------------------
    public function deleteNotificacionAdmin($ID_not)
    {
        include_once 'class.conexion.php';
        $con = new Conexion;

        $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
        $res =   $con->query($sql1);

        if ($res) {
            $sql2 = "DELETE from sicloud.notificacion where ID_not = '$ID_not' ";
            $res1 = $con->query($sql2);
        } // fin de if $res

        if ($res1) {
            $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
            $res2 = $con->query($sql3);

            //if ($result) { echo "<script>alert('Elimino el registro')</script>"; echo "<script>window.location.replace('../forms/formCategoria.php')</script>"; }else{ echo "<script>alert('Error al eliminar el registro categoria')</script>"; echo "<script>window.location.replace('../forms/formCategoria.php')</script>";   } 
            if ($res2) {
                $_SESSION['message'] = "Se elimino notificacio";
                $_SESSION['color'] = "danger";
            } else {
                $_SESSION['message '] = "No elimino notificacion";
                $_SESSION['color'] = "danger";
            } // fin de if de message
        } // fin de if $res2

    } // fin de metodo eliminar notificaciones-----------------------------------------------------------


}// FIN DE CLASE USUARIO
