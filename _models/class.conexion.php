<?php
    class Conexion{



     
    static function conexionPDO(){
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_NAME = 'amoblando';
        try {
            $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
            $db = new PDO($dsn, $DB_USER,  $DB_PASS);
        } catch (PDOException $e) {
            echo 'Error al conectarnos al; ' . $e->getMessage();
        }
        return $db;
    }


/*   
static function conexionPDO(){
    $DB_HOST = 'bt7yjhxozyhmylcvdwag-mysql.services.clever-cloud.com';
    $DB_USER = 'udupl2y688c1evuv';
    $DB_PASS = 'WEJgIwWvcoG63wWX7IWs';
    $DB_NAME = 'bt7yjhxozyhmylcvdwag';
    try {
        $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
        $db = new PDO($dsn, $DB_USER,  $DB_PASS);
    } catch (PDOException $e) {
        echo 'Error al conectarnos al; ' . $e->getMessage();
    }
    return $db;
}
 */

 



}


