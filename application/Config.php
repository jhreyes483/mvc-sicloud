<?php




//controlador por defecto de nuestra aplicacion
define('BASE_URL', 'http://localhost/sicloud-sa/');  
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'fonts');



define('APP_NAME', 'Sistema de Gesti�n Empresarial');
//define('APP_SLOGAN', 'Cualquier slogan');
define('APP_COMPANY', 'GRUPO INEDITTO SAS');
//define('SESSION_TIME', 60);

define('RUTA_ICONO', '/ico/');
define('RUTA_IMG', '/img/');
define('RUTA_IMG_LAYOUT', 'public/'.DEFAULT_LAYOUT.'/img/');

/*define('DB_HOST', 'itt.kom');
define('DB_USER', 'juan');
define('DB_PASS', 'jcpi');
define('DB_NAME', 'ittpruebas');
define('DB_CHAR', 'utf8');*/




define('RUTAS_APP', [
    'ruta_css'  => BASE_URL .'vista/'.DEFAULT_LAYOUT.'/css/',
    'ruta_js'   => BASE_URL .'vista/'.DEFAULT_LAYOUT.'/js/',
    'ruta_img'  => BASE_URL .'vista/'.DEFAULT_LAYOUT.'/img/',
    'ruta_ico'  => BASE_URL .'vista/'.DEFAULT_LAYOUT.'/ico/'
])
?>