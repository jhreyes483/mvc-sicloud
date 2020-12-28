<?php
include_once 'class.conexion.php';

class Producto extends Conexion
{
    //definicion accesibilidad de varibles
    protected $ID_prod;
    protected $nom_prod;
    protected $val_prod;
    protected $stok_prod;
    protected $estado_prod;
    protected $CF_categoria;
    protected $CF_tipo_medida;
    protected $db;

    //Definicion de contructor
    public function __construct($_ID_prod, $_nom_prod, $_val_prod, $_stok_prod, $_estado_prod, $_CF_categoria, $_CF_tipo_medida)
    {
        $this->db = self::conexionPDO();
        $this->ID_prod = $_ID_prod;
        $this->nom_prod = $_nom_prod;
        $this->val_prod = $_val_prod;
        $this->stok_prod = $_stok_prod;
        $this->estado_prod = $_estado_prod;
        $this->CF_categoria = $_CF_categoria;
        $this->CF_tipo_medida = $_CF_tipo_medida;
    }

    public function get_ID_prod()
    {
        return   $this->ID_prod;
    }

    public function get_nom_prod()
    {
        return   $this->nom_prod;
    }

    public function get_val_prod()
    {
        return   $this->val_prod;
    }


    public function get_stok_prod()
    {
        return   $this->stok_prod;
    }


    public function get_estado_prod()
    {
        return   $this->estado_prod;
    }

    public function get_CF_categoria()
    {
        return   $this->CF_categoria;
    }

    public function get_CF_tipo_medida()
    {
        return   $this->tipo_medida;
    }
    //Funcion estatica
    static function ningunDatoP()
    {
        return new self('', '', '', '', '', '', '');
    }

    //query insertar producto                                     C
    public function insertarProducto($a)
    {
        $sql = "INSERT INTO sicloud.producto (ID_prod, nom_prod, val_prod, stok_prod, estado_prod, CF_categoria, CF_tipo_medida)
        VALUES(?, ? ,? , ? ,? ,? ,?)";
        //      $sql = "INSERT INTO sicloud.tipo_medida(nom_medida, acron_medida)VALUES('$this->nom_medida','$this->acron_medida')";
        //$ejecucion = $db->query($sql);
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $a[0]);
        $stm->bindValue(2, $a[1]);
        $stm->bindValue(3, $a[2]);
        $stm->bindValue(4, $a[3]);
        $stm->bindValue(5, $a[4]);
        $stm->bindValue(6, $a[5]);
        $stm->bindValue(7, $a[6]);
        $ejecucion = $stm->execute();
        if ($ejecucion) {
            $_SESSION['message'] = "Se creo producto";
            $_SESSION['color'] = "success";
            return true;
        } else {
            $_SESSION['message'] = "No se creo producto";
            $_SESSION['color'] = "danger";
            return false;
        }
        // header("location: ../CU004-crearProductos.php");
    } // fin de javaScript



    //query ver productos                                        R
    public function verProductos()
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT P.ID_prod , P.img , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , C.nom_categoria , M.nom_medida
                from sicloud.producto P join sicloud.categoria C on C.ID_categoria = P.CF_categoria
                join sicloud.tipo_medida M on P.CF_tipo_medida = M.ID_medida
                order by  P.stok_prod  desc , P.nom_prod asc;";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //$result = $db->query($sql);
        //return $result;
    } // fin de ver productos


    public function verProductosGrafica()
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT  nom_prod , stok_prod  FROM producto order by stok_prod";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //$result = $db->query($sql);
        //return $result;

    }

    //query ver productos                                        R
    public function verPromociones()
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT P.ID_prod , P.img , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , C.nom_categoria , M.nom_medida
            from sicloud.producto P join sicloud.categoria C on C.ID_categoria = P.CF_categoria
            join sicloud.tipo_medida M on P.CF_tipo_medida = M.ID_medida where estado_prod = 'Promoción'
            order by P.nom_prod asc ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //$result = $db->query($sql);
        //return $result;
    } // fin de ver productos

    //query ver productos                                       
    public function verProductosId($id)
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT P.ID_prod , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , C.nom_categoria, T_M.nom_medida
           from producto P 
           join categoria C on P.CF_categoria = C.ID_categoria 
           join tipo_medida T_M on P.CF_tipo_medida = T_M.ID_medida 
           WHERE ID_prod = '$id' ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //SELECT * FROM SICLOUD.producto  WHERE ID_prod = '9808953743';
        //$result = $db->query($sql);
        //return $result;
    } // fin de ver productos por id


    public function verJoin($id)
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT C.ID_categoria , C.nom_categoria, 
           P.ID_prod , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , P.estado_prod , 
           T.ID_medida , T.nom_medida , T.acron_medida, EP.nom_empresa
           FROM SICLOUD.categoria C 
           JOIN SICLOUD.producto P ON C.ID_categoria = P.CF_categoria 
           JOIN sicloud.tipo_medida T ON T.ID_medida = P.CF_tipo_medida
           JOIN det_producto DP ON P.ID_prod = DP.FK_prod
           JOIN empresa_provedor EP ON DP.FK_rut = EP.ID_rut 
           WHERE  P.ID_prod = '$id' LIMIT 1";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
        //$sql = "SELECT C.ID_categoria , C.nom_categoria , P.ID_prod , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , P.estado_prod, T.ID_medida , T.nom_medida , T.acron_medida FROM SICLOUD.categoria C JOIN SICLOUD.producto P on ID_categoria = CF_categoria JOIN sicloud.tipo_medida T WHERE ID_prod = '$id'   LIMIT 1 ";
        //$a =  $db->query($sql);
        //return $a;
    }



    //EDITAR PRODUCTO                                             U
    public function editarProducto($id)
    {
        //include_once 'class.conexion.php';
        //$con = new Conexion;
        $sql = "UPDATE sicloud.producto SET ID_prod = '$this->ID_prod' , nom_prod = '$this->nom_prod' , val_prod = '$this->val_prod' , stok_prod = '$this->stok_prod' , estado_prod = '$this->estado_prod', CF_categoria = '$this->CF_categoria' , CF_tipo_medida = '$this->CF_tipo_medida'  WHERE ID_prod = '$id' ";
        $stm = $this->db->prepare($sql);
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":ID_prod", $this->ID_prod);
        $stm->bindValue(":nom_prod", $this->nom_prod);
        $stm->bindValue(":val_prod", $this->val_prod);
        $stm->bindValue(":stok_prod", $this->stok_prod);
        $stm->bindValue(":estado_prod", $this->estado_prod);
        $stm->bindValue(":CF_coategoria", $this->CF_categoria);
        $stm->bindValue(":CF_tipo_medida", $this->CF_tipo_medida);
        $r = $stm->execute();
        //$r = $con->query($sql);
        if ($r) {
            $_SESSION['message'] = "Actualizacion de producto exitosa";
            $_SESSION['color'] = "primary";
        } else {
            $_SESSION['message'] = "Error al actualizar producto";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/CU004-crearProductos.php?accion=verProducto");
    } // fin de editar productos



    //ELIMINAR PRODUCTO                                    D
    public function eliminarProducto($id)
    {
        //include_once 'class.conexion.php';
        //$con = new Conexion;
        $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
        $consulta1 = $this->db->prepare($sql1);
        $res =  $consulta1->execute();

        if ($res) {
            $sql2 = " DELETE FROM producto  WHERE ID_prod = '$id'  ";
            $consulta2 = $this->db->prepare($sql2);
            $consulta2->bindValue(":id", $id);
            $res1 = $consulta2->execute();
            //$res1 = $con->query($sql2);
        }

        if ($res1) {
            $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
            $consulta3 = $this->db->prepare($sql3);
            $res2 = $consulta3->execute();
            //$res2 = $con->query($sql3);
        }

        if ($res2) {
            $_SESSION['message'] = "Elimino producto";
            $_SESSION['color'] = "danger";
            return true;
        } else {
            $_SESSION['message'] = "Error al eliminar producto";
            $_SESSION['color'] = "danger";
            return false;
        }
        header("location: ../vista/CU004-crearProductos.php?accion=verProducto");
    }


    public function inserCatidadProducto($cant, $stock, $id)
    {
        // include_once 'class.conexion.php';
        //$c = new Conexion;
        $t = $stock + $cant;
        // UPDATE sicloud.producto SET stok_prod = '8' WHERE ID_prod = '0529063441';
        $sql = "UPDATE sicloud.producto SET stok_prod = '$t' WHERE ID_prod = '$id' ";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(":stok_prod", $this->stok_prod);
        $stm->bindValue(":ID_prod", $this->ID_prod);
        $result = $stm->execute();
        //$c->query($sql);


        if ($result) {
            $_SESSION['message'] = "Agrego existencia";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['message'] = "Error al agregar existencia";
            $_SESSION['color'] = "danger";
        }
        header("location: ../vista/CU003-ingresoProducto.php?accion=verProducto");
    }

    public function verProductosAlfa($id)
    {
        // include_once 'class.conexion.php';
        // $c = new Conexion;
        $sql = "SELECT nom_prod , stok_prod , nom_categoria  from sicloud.producto sp
            join sicloud.categoria sc on sp.CF_categoria = sc.ID_categoria 
            WHERE ID_categoria = $id 
            order by nom_prod asc";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        //$dat = $c->query($sql);
        //return $dat;
    }

    public function ConteoProductosT()
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "SELECT nom_prod , sum(stok_prod) as total FROM sicloud.producto GROUP BY nom_prod
        UNION
        SELECT estado_prod, sum(stok_prod) as total
        FROM sicloud.producto";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        // $dat = $c->query($sql);
        //return $dat;
    }

    // METODO para ver los productos de una categoria 
    public function verPorCategoria($id)
    {
        $sql = "SELECT  P.ID_prod ,  P.nom_prod ,P.img , P.val_prod , P.stok_prod , P.estado_prod  , P.CF_tipo_medida , 
            C.ID_categoria , C.nom_categoria
            FROM producto P JOIN categoria C ON  P.CF_categoria = C.ID_categoria
            where C.ID_categoria = :id
            order by P.nom_prod asc";
        $consulta = $this->db->prepare($sql);
        $consulta->bindValue(':id', $id);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        //$consulta = $c->query($sql);
        //return $consulta;
    }

    // METODO
    //-----------------------------------------------------------------
    //Imagenes en pantalla
    public function listaProductosImg()
    {
        //   include_once '../../plantillas/inihtmlN3';
        include_once   '../controlador/controaldorsession.php';
        include_once   'class.conexion.php';
        // $cnx = new Conexion;
        $sql = "SELECT * from producto";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result; //$result = $cnx->query($sql);

        //foreach ($result as $row) {
        // $lista[]=$row;
        //  while($row = $result->fetch_assoc()){
        //$datos =   $result->fetch_all();
        //return $datos;
    } // Fin de metodo ver imagenes de cataligo


    //-----------------------------------------------------------------


    //-----------------------------------------------------------------
    //busquda de producto por primera letra
    public function primeraLetra($letra)
    {
        //include_once   'clases/class.conexion.php';
        //  $cnx = new Conexion;
        $sql = "SELECT * from producto where nom_prod LIKE '$letra%'";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        //$array = $cnx->query($sql);
        //return $array;
    }





    //----------------------------------------------------------------
    //imput bscador
    public function buscarPorNombreProducto($buscar)
    {
        //include_once   'clases/class.conexion.php';
        //$cnx = new Conexion;
        $sql = "SELECT  P.ID_prod ,  P.nom_prod ,P.img , P.val_prod , P.stok_prod , P.estado_prod  , P.CF_tipo_medida , C.ID_categoria , C.nom_categoria
            FROM producto P JOIN categoria C ON  P.CF_categoria = C.ID_categoria
            WHERE (ID_prod LIKE '%$buscar%' or nom_prod  LIKE '%$buscar%') order by nom_prod";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        //$array = $cnx->query($sql);
        //return $array;
    }


    public function inserTfoto($destino, $id)
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "UPDATE  producto SET img = ('$destino') where ID_prod = '$id'";
        //$e = $c->query($sql);
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        if ($result) {
            header("location: ../vista/CU004-crearproductos.php");
        }
    }


    public function verProductosIdCarrito($id)
    {
        //include_once 'class.conexion.php';
        //$db = new Conexion;
        $sql = "SELECT P.img , P.ID_prod , P.nom_prod , P.stok_prod , P.descript , P.val_prod , P.estado_prod , C.nom_categoria, T_M.nom_medida
                from producto P join categoria C on P.CF_categoria = C.ID_categoria 
                join tipo_medida T_M on P.CF_tipo_medida = T_M.ID_medida WHERE P.ID_prod = '$id' ";
        $consulta = $this->db->prepare($sql);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
        //            SELECT * FROM SICLOUD.producto  WHERE ID_prod = '9808953743';
        //$result = $db->query($sql);
        //return $result;

    }
}// FIN DE CLASES PRODUCTO
