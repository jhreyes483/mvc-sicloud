<?php
include_once '../controlador/controladorsession.php';
include_once '../modelo/class.notificacion.php';





?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top navbar navbar-expand-lg fixed-top sticky-top">
  <a class="navbar-brand ml-4" href="#">
    <img src="fonts/logoportal.png" width="250" height="65" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mx-auto">
      <li class="nav-item active">
        <a class="nav-link lead px-4 my-3 " href="../index.php"> INICIO<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle lead px-4 my-3" href="Vision-home.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          FERRETERIA
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="CU000-quienessomos.php">QUIENES SOMOS</a>
          <a class="dropdown-item" href="CU000-misionyvision.php">MISION Y VISION</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link lead px-4 my-3" id="catalogo"; href="../controlador/controlador.php?ops=1">CATALOGO<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link lead px-4 my-3" href="Promociones.php">PROMOCIONES<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link lead pl-4 my-3" href="CU000-contact.php">CONTACTO<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown active">








<!-- icono de notificacion mensaje -->

<a class="nav-link mx-3" href="#" id="messagesDropdown" role="button" aria-expanded="false">
      
      <!-- Counter - Messages -->

    </a>






<!-- --------------------------------------------------------------------------------------- -->
<!-- Carrito -->
<?php
        if (isset($_SESSION['CARRITO'])) {
          $numeroProductos = count($_SESSION['CARRITO']);

        ?>
          <a href="mostrarCarrito.php">
            <!-- icono carrito -->
            <svg  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3 " fill="white" xmlns="http://www.w3.org/2000/svg">
              <path style="color :#ffff;" fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg >
          </a>
          <span class="badge badge-danger badge-counter"><?php echo $numeroProductos  ?></span>
        <?php   } ?>
<!-- ---------------------------------------------------------------------------------------- -->



        <!-- icono de notificacion campana -->

        <a class="" id="messagesDropdown" data-toggle="modal" data-target="#exampleModal" role="button" aria-expanded="true">

          <i class="fas fa-bell fa-fw" style="color :#ffff;"></i>
          <!-- Counter - Messages -->
          <?php if (isset($_SESSION['usuario'])) {
          //  $c = Notificacion::conteoNotificaciones($_SESSION['usuario']['ID_rol_n'])       ?>
            <span class="badge badge-danger badge-counter"><?php // echo $c;
                                                          } ?></span>
        </a>

        <!-- ----------------------------------------------------------------------------------- -->



        <span class="sr-only">(current)</span>
        </a>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">

          <strong><?php if (isset($_SESSION['usuario'])) {
                    echo  $_SESSION['usuario']['nom1'];
                    ?></strong>
<img class="img-profile ml-3 rounded-circle" src="fonts/us/<?php echo $_SESSION['usuario']['foto'] ;   ?>" height="65" width="70">
                    <?php    } ?>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">
            <?php if (isset($_SESSION['usuario'])) {echo "Hola " . $_SESSION['usuario']['nom1'] . " " . $_SESSION['usuario']['ape1'] . "<br>";}  ?>
            <?php if(isset($_SESSION['usuario']['puntos'])){   echo "Puntos ".$_SESSION['usuario']['puntos'];  }  ?>
            <div class="dropdown-divider"></div>
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            <em><strong><?php if (isset($_SESSION['usuario'])) {
                          echo $_SESSION['usuario']['nom_rol'];
                        } ?></strong></em>
          </a>
          <a class="dropdown-item" href="misDatos.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
            Mis datos
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 "></i>
            Compras
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../controlador/controladorsession.php?cerrar=2" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
            Salir
          </a>
        </div>
      </li>




    </ul>
  </div>
</nav>

