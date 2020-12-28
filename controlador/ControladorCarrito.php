<?php




include_once '../controlador/controladorrutas.php';
include_once '../controlador/controladorsession.php';
conficController();

date_default_timezone_set("America/Bogota");
class ControllerCarrito extends Controller
{
    public function __construct()
    {
        $this->generaPreVenta();
    }

    public function index()
    {
        die('implementar metodo index');
    }



    public function generaPreVenta()
    {

        //rutFromIni();
        $mensaje = "";
        // captura los datos que vienen por pos, desemcrita y almacena en varibles
        if (isset($_POST['btnCatalogo'])) {
            switch ($_POST['btnCatalogo']) {
                case 'Agregar':
                    if (openssl_decrypt($_POST['id'], COD, KEY)) {
                        $ID = openssl_decrypt($_POST['id'], COD, KEY);
                        $mensajeId = "OK ID" . $ID;
                    } else {
                        $mensaje = "Upss.. Id incorrecto";
                    }
                    if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                        $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                        $mensajeNombre = "OK ID" . $NOMBRE;
                    } else {
                        $mensaje = "Upss.. Id incorrecto";
                    }
                    $CANTIDAD = $_POST['cantidad1'];
                    $mensajeCantidad = "OK ID" . $CANTIDAD;

                    if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                        $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                        $mensajePrecio = "OK ID" . $PRECIO;
                    } else {
                        $mensajePrecio = "Upss.. Id incorrecto";
                    }

                    if (is_string(openssl_decrypt($_POST['img'], COD, KEY))) {
                        $IMG = openssl_decrypt($_POST['img'], COD, KEY);
                        $mensajeImg = "OK ID" . $IMG;
                    } else {
                        $mensajePrecio = "Upss.. Id incorrecto";
                    }

                    if (!isset($_SESSION['CARRITO'])) {
                        // ALMACENAR EL VALOR DE LA VARIBLE EN EL ARREGLO $porductos
                        $producto = [
                            'ID' => $ID,
                            'NOMBRE' => $NOMBRE,
                            'CANTIDAD' => $CANTIDAD,
                            'PRECIO' => $PRECIO,
                            'IMG' => $IMG
                        ];

                        // Almacena los datos en session
                        $_SESSION['CARRITO'][0] = $producto; // almacena en la pocion 0 "en el primer elemento del carrito"
                        $_SESSION['message']    =  'Agrego el prodicto ' . $producto['NOMBRE'] . " al carrito de compras";
                        $_SESSION['color']      = 'success';
                    } // fin de isset carrito "primer producto"
                    else {
                        //--------------------------------------------------------------------------
                        //Valida si el producto ya existe en el carrito
                        $idProducto = array_column($_SESSION['CARRITO'], "ID"); // captura todos los id del arreglo
                        if (in_array($ID, $idProducto)) { // verifica si en exiten duplicados
                            $p =  (isset($producto['NOMBRE'])) ? $producto['NOMBRE'] : '';
                            $_SESSION['message'] =  'Error El producto ' . $p . " ya ha sido seleccionado";
                            $_SESSION['color']   = 'danger';
                            break;
                        }
                        //-------------------------------------------------------------------------
                        $numeroProductos = count($_SESSION['CARRITO']);
                        //Recupera los datos que llegaron por post y que se desencriptaron "si ya existe el carrito"
                        $producto = array(
                            'ID' => $ID,
                            'NOMBRE' => $NOMBRE,
                            'CANTIDAD' => $CANTIDAD,
                            'PRECIO' => $PRECIO,
                            'IMG' => $IMG
                        );

                        $_SESSION['CARRITO'][$numeroProductos] = $producto;
                        $_SESSION['message'] =  'Agrego el producto ' . $producto['NOMBRE'] . " al carrito de compras";
                        $_SESSION['color'] = 'success';
                    }
                    $mensaje = print_r($_SESSION, true);
                    break;
                case 'Eliminar':
                    // EVALUACION SI LA ACCION ES ELIMINAR EL PRODUCTO DEL CARRITO
                    openssl_decrypt($_POST['id'], COD, KEY);
                    $ID = openssl_decrypt($_POST['id'], COD, KEY);

                    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                        if ($producto['ID'] == $ID) :
                            // borra el producto
                            unset($_SESSION['CARRITO'][$indice]);
                            $_SESSION['message'] =  'Elimino el producto ' . $producto['NOMBRE'] . ' del carrito de compras';
                            $_SESSION['color'] = 'danger';
                        endif;
                    }
                    break;
            } // Fin de switch
        }
    }
}
