<?php
/*  ******************************************************************
 *  Desarrollado: JCPI                        Fecha: 2015-10-20
 *  Configuración Model, se observa el objeto y la conexion a la BD
 *  ****************************************************************/


class Model{
   var $_db;
   public function __construct($param) {
     include_once($_SERVER['DOCUMENT_ROOT'].'/_models/mySQL.php');
	   $this->_db = new mySQL($param);
   }
}
?>
