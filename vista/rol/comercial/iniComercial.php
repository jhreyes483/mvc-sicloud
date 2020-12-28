<?php
include_once '../../../controlador/controladorrutas.php';
rutFromIniN3();
$objSession =new Session();
$u = $objSession->desencriptaSesion();

//comprobacion de rol
$in = false;
switch ($u['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
    break;
    case 4:
        $in = true;
    break;
    case 0:
        $in = true;
    break;
    default:
        echo "<script>alert('No tiene permiso para ingresar a este modulo');</script>";
        echo "<script>window.location.replace('index.php');</script>";
    break;
}
if ($in == false) {
    echo "<script>alert('No tiene permiso para ingresar a este modulo');</script>";
    echo "<script>window.location.replace('index.php');</script>";
} else {

    //--------------------------------------------------------------------------


?>
    <div class="my-4">
        <?php

        ?>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <!-- alerta boostrap -->
        <div class=" col-md-4 text-center mx-auto alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
            <?php echo  $_SESSION['message']  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


    <?php setMessage();
    } 
    cardtitulo("Modulo Comercial");
    cardAviso();
    ?>


    <div class="col-md-10 my-4 mx-auto">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-10 mx-auto">
                <div id="carousel-1" class="carousel slide  " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../../fonts/slideprod0.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../../fonts/slideprod1.jpg" alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr class="border ">

    <div class="col-md-10 mt-5 my-4 mx-auto">
        <div class="row">
            <div class="col-md-10 card card-body mx-auto shadow p-3 mb-5 bg-white rounded">
                <div class="card card-body shadow p-3 mb-5 bg-white rounded text-center lead">
                    <h5 class="my-4">USUARIOS</h5>
                    <div class="row mx-3">
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../CU009-controlUsuarios.php">Control de Usuarios</a>
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../CU006-acomulaciondepuntos.php">Acomulacion de Puntos</a>
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../CU005-facturacion.php">Facturacion</a>
                    </div>
                </div>

                <div class="card card-body shadow p-3 mb-5 bg-white rounded text-center lead">
                    <h5 class="my-4">PRODUCTOS</h5>
                    <div class="row mx-3">
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../catalogo.php?ops=1">Catalogo de productos</a>
                    </div>
                </div>

                <div class="card card-body shadow p-3 mb-5 bg-white rounded text-center lead">
                    <h5 class="my-4">INFORMES</h5>
                    <div class="row mx-3">
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../CU0011-informeventas.php">Informes de Venta</a>
                        <a class="btn btn-primary btn-block text-decoration-none " href="../../CU0014-alertas.php">Alertas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
//} //fin de validar permisos
rutFromFinN3();
}
?>