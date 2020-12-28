<?php
/*************************************************************************************************
 * 	Fecha: 2020-12-10
 *		Descripci�n: 	Clase View
 *							Reestructura la vista, trae datos y archivos necesarios desde el controller
 *************************************************************************************************/

class View{
   private $_controlador;
   private $_js;
   private $_css;
   private $_img;
   private $_ico;

   public function __construct(Request $peticion){
      $this->_controlador = $peticion->getControlador();
      $this->_js  = [];
      $this->_css = [];
      $this->_img = [];
      $this->_ico = [];
   }

   public function renderizar_vista($vista, $item = false){
      $rutaView = ROOT. 'views/' . $this->_controlador . '/' . $vista.'.phtml';

      if(is_readable($rutaView)){
         include_once $rutaView;
      }else{
         throw new Exception('Error en la Vista: '. $rutaView);
      }
   }

   public function renderizar($vista, $item = false, $finaliza=0){
      
      $menu = [['id'=>'inicio', 'titulo'=>'INICIO', 'enlace'=>BASE_URL]];
      
      if(Session::get('autenticado') == 0){
         $menu[] =  array('id'=>'login',     'titulo'=>'INICIAR SESI�N',   'enlace'=>BASE_URL.'login');
      }else{
         $menu[] = array('id'=>'bitacora',      'titulo'=>'BITACORA',         'enlace'=>BASE_URL.'bitacora');
         
      }

   	$js  = count($this->_js)? $this->_js:[];
      $css = count($this->_css)? $this->_css:[];
      $img = count($this->_img)? $this->_img: [];
      $ico = count($this->_ico)? $this->_ico:[];

      //recursos gen�ricos
      $_layoutParams = array(
         'ruta_css'  => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/css/',
         'ruta_js'   => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/js/',
         'ruta_img'  => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/img/',
         'ruta_ico'  =>  BASE_URL .'public/'.DEFAULT_LAYOUT.'/ico/',
         'menu'      => $menu,
         'js'        => $js,
         'img'       => $img,
         'ico'       => $ico,
         'css'       => $css
      );
      
      $rutaView ='_views/'. $this->_controlador . '/' .$vista.'.phtml';
      echo '<br>ruta -> '.$rutaView.'<br>';
      echo 'vista ->'. $vista.'<br>';
      if(is_readable($rutaView)){
         include_once ROOT.'_views/index/header.php';
 
         include_once  $rutaView;
         include_once ROOT.'_views/index/footer.php';
    	}else{
      	throw new Exception('Error de Vista - ');
      }
      if($finaliza!=0) die();
  	}

	public function setCss(array $css){
		if(is_array($css) && count($css)){
      	for($i=0; $i < count($css); $i++){
      		$this->_css[] = $css[$i]. '.css';
         }
     	}else{
      	throw new Exception('Error de css');
    	}
	}

   public function setJs(array $js){
      if(is_array($js) && count($js)){
         for($i=0; $i < count($js); $i++){
            $this->_js[] = $js[$i]. '.js';
         }
      }else{
         throw new Exception('Error de js');
      }
   }

   public function setImg(array $img){
      if(is_array($img) && count($img)){
         for($i=0; $i < count($img); $i++){
            $this->_img[] = $img[$i];
         }
      }else{
         throw new Exception('Error de imagen');
      }
   }

   public function setIcon(array $ico){
      if(is_array($ico) && count($ico)){
         for($i=0; $i < count($ico); $i++){
            $this->_ico[] = $ico[$i]. '.png';
         }
      }else{
         throw new Exception('Error de icono');
      }
   }
}


?>
