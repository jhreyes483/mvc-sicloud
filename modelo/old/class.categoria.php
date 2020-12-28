<?php
include_once 'class.conexion.php';

class Categoria extends Conexion{
    protected $nom_categoria;
    protected $ID_categoria;
    private $db;

    public function __construct($_nom_categoria, $_ID_categoria =  "")
    {

        $this->nom_categoria = $_nom_categoria;
        $this->ID_categoria = $_ID_categoria;
        $this->db = self::conexionPDO();
    }

    //GET
    public function get_nom_categoria(){
        return $this->nom_categoria;
    }

    
    public function get_ID_categoria(){
        return $this->ID_categoria;
    }


    //METODOS

    // retorna ningun dato
    static function ningunDatoC()
    {
        return new self('', '');
    }


    // Insertar datos           C
    public function insertCategoria()
    {
        $sql = "INSERT INTO sicloud.categoria (nom_categoria ) VALUES (:nom_categoria )";
        $consultar = $this->db->prepare($sql);
        $consultar->bindValue(":nom_categoria", $this->nom_categoria);
        $insert = $consultar->execute();
         if ($insert) { echo "<script>alert('Registro de categoria exitoso')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>"; }
         else{ echo "<script>alert('Error de registro categoria')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>";   } 
        if ($insert) {
            $_SESSION['message'] = "Se creo categoria";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['message'] = "No creo categoria";
            $_SESSION['color'] = "danger";
        }
        header("location:../vista/formCategoria.php ");
    }

    // Ver categorias           R
    public function verCategoria(){
        $sql = "SELECT * FROM categoria";
        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        $result = $consulta->fetchAll(); 
        return $result;
    }


        // Eliminar categoria           D
    public function eliminarCategoria($id_get){       
        $sql1 = "SET FOREIGN_KEY_CHECKS = 0";
        $consulta2 =$this->db->prepare($sql1);
        $rest1 = $consulta2->execute();
        if ($rest1) {
            $sql2 = "DELETE FROM sicloud.categoria WHERE  ID_categoria = :id ";
            $consulta3=$this->db->prepare($sql2); 
            $consulta3->bindValue(":id", $id_get);
            $rest2=$consulta3->execute();
        }
        if ($rest2) {
            $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
            $consulta4 = $this->db->prepare($sql3);
            $rest3=$consulta4->execute();

        if ($rest3) { echo "<script>alert('Elimino el registro')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>"; }
        else{ echo "<script>alert('Error al eliminar el registro categoria')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>";   } 
          //  if ($rest3) {
          //      $_SESSION['message'] = "Elimino categoria";
          //      $_SESSION['color'] = "danger";
          //  } else {
          //      $_SESSION['message '] = "No se Elimino categoria";
          //      $_SESSION['color'] = "danger";
          //  }
            header("location: ../vista/formCategoria.php");
        }
    } // fin de metodo eliminar categoria



     // Actualizar datos             U
     public function actualizarDatosCategoria($id_get){
        $sql = "UPDATE sicloud.categoria SET nom_categoria = :nom_categoria  WHERE ID_categoria = :ID_categoria ";
        $consulta = $this->db->prepare($sql);
        $consulta->bindValue(":ID_categoria", $this->$id_get);
        $consulta->bindValue(":nom_categoria", $this->nom_categoria);
        $result = $consulta->execute();



         if($result){ echo "<script>alert('Actualizasion categoria exitoso')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>"; }else{ echo "<script>alert('Error en actualizacion de categoria')</script>"; echo "<script>window.location.replace('../vista/formCategoria.php')</script>";   }  
        // if ($result) {
        //     $_SESSION['message'] = "Se actualizo categoria";
        //     $_SESSION['color'] = "primary";
        // } else {
        //     $_SESSION['message'] = "No se actualizo categoria";
        //     $_SESSION['color'] = "danger";
        // }
         header("location: ../vista/formCategoria.php");
     }

     public function verCategoriaId($id){
         $sql = "SELECT * 
         FROM categoria
         WHERE ID_categoria = :ID_categoria";
         $consulta = $this->db->prepare($sql);
         $consulta->bindValue(":ID_categoria", $id);
         $consulta->execute();
         $result = $consulta->fetchAll();
         return $result;
     }
    // Ver categorias por id    R
    //static function verCategoriaId($id)

    //Capturar id
    public function capturarId(){
        //include_once 'class.conexon.php';
        //$con = new Conexion;
        $sql = "SELECT * FROM sicloud.categoria ORDER BY ID_categoria DESC LIMIT 1 ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$datos = $con->query($sql);
        //while ($row = $datos->fetch_array());
        //$id = $row['ID_categoria'];
        //return $id;
    } // fin de metodo capturar ID

    // Ver categiria sin conexion
    public function verCategorias(){
        //include_once 'class.conexon.php';
        //$d = new Conexion;
        $sql = "SELECT * FROM categoria
        order by nom_categoria asc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $d->query($sql);
        //return $result;
    } // fin de ver categoria


}
