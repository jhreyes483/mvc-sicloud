<?php
include_once 'class.conexion.php';

class Factura extends Conexion{
    protected $ID_factura;
    protected $total;
    protected $fecha;
    protected $b_total;
    protected $iva;
    protected $FK_c_tipo_pago;
    protected $db;

    public function __construct($_ID_factura, $_total, $_fecha, $_b_total, $_iva, $_FK_c_tipo_pago)
    {
        $this->db              = self::conexionPDO();
        $this->ID_factura      = $_ID_factura;
        $this->total           = $_total;
        $this->fecha           = $_fecha;
        $this->b_total         = $_b_total;
        $this->iva             = $_iva;
        $this->FK_c_tipo_pago  = $_FK_c_tipo_pago;
    }




    public function get_ID_factura()
    {
        return $this->ID_factura;
    }

    public function get_total()
    {
        return $this->total;
    }

    public function get_fecha()
    {
        return $this->fecha;
    }



    public function get_b_total()
    {
        return $this->b_total;
    }


    public function get_iva()
    {
        return $this->iva;
    }


    public function get_FK_c_tipo_pago()
    {
        return $this->FK_c_tipo_pago;
    }



    public function verFecha($f)
    {
        
        //$c = new Conexion;
        $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
        from sicloud.det_factura detf
        join sicloud.factura f on f.ID_factura = detf.FK_det_factura
        where f.fecha = '$f'
        group by dia";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
    
    
        //$dat =   $c->query($sql);
        //return $dat;
    } // fin  de ver fecha U

    //  METODOS

    // verjoinFactura

    public function verjoinFactura()
    {
        //include_once 'class.conexion.php';

        $sql = "SELECT  ID_us  ,nom1, ape1 ,nom_prod, f.fecha , nom_tipo_pago , total
            from sicloud.det_factura df
            join sicloud.usuario u on df.CF_us = u.ID_us and df.CF_tipo_doc = u.FK_tipo_doc
            join sicloud.producto p on df.FK_det_prod = p.ID_prod
            join sicloud.factura f on df.FK_det_factura = f.ID_factura
            join sicloud.tipo_pago  tp on f.FK_c_tipo_pago = tp.ID_tipo_pago  order by nom1 asc  ";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(); 
            return $result;
        //$con = new Conexion;
        //$dat =  $con->query($sql);
        //return $dat;
    } // fin de metodo ver join factura


//----------------------------------------------------------
static function ningunDato(){
    return new self('', '', '', '', '', '');
}

    //-------------------------------------------------------------
    //Consulta de que usuarios han realizado compras = Vista = comprasUsuarios.php
    public function usuariosComprasRealizadas()
    {
        $sql = "SELECT U.ID_us , U.nom2 , U.nom1 , U.ape1 , U.ape2 , U.foto , U.correo , DF.FK_det_factura , F.fecha
        from factura F join det_factura DF on F.ID_factura = DF.FK_det_factura
        right join  usuario U on U.ID_us = DF.CF_us
        order by (DF.FK_det_factura) desc, (F.fecha) desc ,(U.nom1) desc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$consulta = $this->db->query($sql);
        //return $consulta;
    }
    //-------------------------------------------------------------

    public function verDia()
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
            from sicloud.det_factura detf
            join sicloud.factura f on f.ID_factura = detf.FK_det_factura
            group by dia";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$dat = $c->query($sql);
        //return $dat;
    }



    public function verSemana()
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "SELECT count(*) as 'cantidad',sum(F.total) as Total, DATE_ADD(
            DATE (F.fecha),
            interval(7 - dayofweek(F.fecha)) day)
            dia_final_semana FROM sicloud.factura F
            group by dia_final_semana
            order by fecha asc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        
        //$i = $c->query($sql);
        //return $i;
    }


    public function verMes()
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "SELECT count(*) as 'cantidad',sum(F.total) as Total, DATE_ADD(
            DATE (F.fecha),
            interval(30 - dayofmonth(F.fecha)) day)
            dia_final_mes FROM sicloud.factura F
            group by dia_final_mes
            order by fecha asc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$i = $c->query($sql);
        //return $i;
    }




    // valida factura en un periodo de fechas

    public function verIntervaloFecha($fechaIni, $fechaFin)
    {
        //include_once 'class.conexion.php';
        //$c = new Conexion;
        $sql = "SELECT * FROM factura
            where fecha <= '$fechaFin' and  fecha >= '$fechaIni' 
            order by fecha asc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$arr = $c->query($sql);
        //return $arr;
    }




    // Ver datos  usuario en factura
    public function verUsuarioFactura($id)
    {

        //$cnx = new Conexion;
        $sql = "SELECT U.nom1, U.nom2, U.ape1, U.ape2 , T.tel , D.dir
            from  usuario U join telefono T on T.CF_us = U.ID_us
            join direccion D on D.CF_us = U.ID_us
            where U.ID_us = '$id'
            limit 1";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $cnx->query($sql);
        //return $result;
    }



    public function verFactura($id)
    {
        //$c = new Conexion;
        $sql = "SELECT   U.nom2 , U.ape1 , U.ape2 , U.correo , U.nom1 , F.ID_factura, F.fecha   , D.dir , TP.nom_tipo_pago , DF.cantidad , Pr.val_prod , TD.nom_doc , U.ID_us
            from factura F join tipo_pago TP on F.FK_c_tipo_pago = TP.ID_tipo_pago
            join det_factura DF on F.ID_factura = DF.FK_det_factura
            join producto Pr on Pr.ID_prod = DF.FK_det_prod
            join usuario U  on U.ID_us =  DF.CF_us
            join direccion D on D.CF_us = U.ID_us
            join tipo_doc TD on U.FK_tipo_doc = TD.ID_acronimo
            where ID_factura = '$id'
            limit 1";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $c->query($sql);
        //return $result;
    }




    public function verFactural($id)
    {
        //$c = new Conexion;
        $sql = "SELECT  U.nom2 , U.ape1 , U.ape2 , U.correo , U.nom1 , F.ID_factura, F.fecha   , D.dir , TP.nom_tipo_pago , DF.cantidad , Pr.val_prod , Pr.nom_prod
            from factura F join tipo_pago TP on F.FK_c_tipo_pago = TP.ID_tipo_pago
            join det_factura DF on F.ID_factura = DF.FK_det_factura
            join producto Pr on Pr.ID_prod = DF.FK_det_prod
            join usuario U  on U.ID_us =  DF.CF_us
            join direccion D on D.CF_us = U.ID_us
            where ID_factura = '$id'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $c->query($sql);
        //return $result;
    }
}
