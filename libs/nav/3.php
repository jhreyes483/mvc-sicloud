<?php 
$rol = [ 1=>'Administrador',2=>'Cliente',3=>'Empleado'];
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
   <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="<?= RUTAS_APP['ruta_img'] ?>logo/logo-amoblando.svg" alt="" /></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         Menu
         <i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav text-uppercase ml-auto">
           
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services"><?= $rol[$_SESSION['usuario']['fk_rol']]  ?></a></li>

            <div class="dropdown show">
               <li class="nav-item" id="dropdownMenuLink" data-toggle="dropdown"><a class="nav-link js-scroll-trigger <?= (in_array($_GET['c'] ,['8','6','7'] ) ? 'text-warning':'' )  ?> " href="#" role="button" aria-haspopup="true" aria-expanded="false">SALAS</a></li>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=8'?>">SALA L</a>
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=6'?>">SOFA CAMA</a>
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=7'?>">SOFA</a>
               </div>
            </div>
            <div class="dropdown show">
               <li class="nav-item" id="dropdownMenuLink" data-toggle="dropdown"><a class="nav-link js-scroll-trigger <?= (in_array($_GET['c'] ,['9'] ) ? 'text-warning':'' )  ?> " href="#" role="button" aria-haspopup="true" aria-expanded="false">ALCOBAS</a></li>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=9'?>">CAMAS</a>
               </div>
            </div>
            <div class="dropdown show">
               <li class="nav-item " id="dropdownMenuLink" data-toggle="dropdown"><a class="nav-link js-scroll-trigger <?= (in_array($_GET['c'] ,['10', '11','12','13'] ) ? 'text-warning':'' )  ?> " href="#" role="button" aria-haspopup="true" aria-expanded="false">COMEDORES</a></li>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=10'?>">JUEGO DE COMEDORES</a>
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=11'?>">MESAS </a>
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=12'?>">SILLAS</a>
                  <a class="dropdown-item" href="<?=BASE_URL.'index/catalogo?c=13'?>">BIFFES</a>
               </div>
            </div>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">CONTACTENOS</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger"  href="<?=BASE_URL.'index/cerrar'?>">CERRAR SESION</a></li>
         </ul>
      </div>
   </div>
</nav>