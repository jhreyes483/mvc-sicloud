<?php


include_once '../controlador/controladorrutas.php';
include_once '../controlador/ControladorCarrito.php';
rutFromIni();
$objMod = new ControllerDoc();
$objCar = new ControllerCarrito;
$num = 0;
$datos = $objMod->verProductos();


function selectCategorias(){
    $objMod = new ControllerDoc();
    $categoria = $objMod->verCategorias();

    foreach ($categoria as $row ) {
?>
        <option value="<?= $row['ID_categoria']  ?>"><?= $row['nom_categoria']    ?></option>
<?php }
}


function alerta(){
    if (isset($_SESSION['message'])) {
?>
        <!-- alerta boostrap -->
        <div class="text-center  alert alert-<?= $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
            <?=  $_SESSION['message']  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php  // session_unset();
        setMessage();
    }
}

//================================================================================
// Datos



 // Todos los productos default
if (isset($_REQUEST['busqueda'])) :
    $datos = $objMod->buscarPorNombreProducto($_REQUEST['busqueda']);
endif;
if (isset($_REQUEST['cat'])) :
    $datos = $objMod->verPorCategoria($_GET['cat']);
 
   // $datos = Producto::verPorCategoria($_GET['cat']);
endif;

//---------------------------------------------------------------------

// Grafica de datos

function mostrarCatalogo($datos){
    foreach ($datos as $row) {
    ?>
        <div class="mx-2 col-lg-4 col-md-6  card card-body shadow mx-auto  my-4 shadow cards animate__animated  animate__pulse animate__delay-1s">
            <img class="mx-auto" src="fonts/img/<?= $row['img']; ?>" alt="Card image cap" height="250px" width="240px">

            <div class="">
                <h5 class="card-title"><?= $row['nom_prod']; ?> </h5>
                <p class="card-text lead"><strong><?= "$" . number_format(($row['val_prod']), 0, ',', '.'); ?></strong> </p>
                <p class="card-text text-success"><?= "36 cuotas " . "$" . number_format(($row['val_prod'] / 36), 0, ',', '.') . " Sin interes";
                                                    if ($row['estado_prod'] == "Promoción"){
                                                        echo ",  " .  $row['estado_prod'];
                                                    } ?>
                </p>
                <!-- Formulario de envio e incriptacion ------------------------------------>
                <form action="" method="POST">
                    <label class="card-text lead" for="">Cantidad</label> <input value="1" class=" form-control-sm col-3 col-lg-2 col-md-2 " name="cantidad1" type='number'>
                    <input type="hidden" name="img" id="id" value="<?= openssl_encrypt($row['img'], COD, KEY);  ?>">
                    <input type="hidden" name="id" id="id" value="<?= openssl_encrypt($row['ID_prod'], COD, KEY);  ?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?= openssl_encrypt($row['nom_prod'], COD, KEY);  ?>">
                    <input type="hidden" name="precio" id="precio" value=" <?= openssl_encrypt($row['val_prod'], COD, KEY);  ?>">
                    <div class="row">
                        <input type="submit" class=" btn btn-naranja" value="Agregar" name="btnCatalogo">
                </form>
                <form action="detalleProducto.php" method="POST">
                    <input type="hidden" name="ID" value="<?= openssl_encrypt($row['ID_prod'], COD, KEY);  ?>">
                    <input type="submit" class="btn-block btn btn-naranja" value="Detalle">
                </form>
            </div>
            <!-- -------------------------------------------------- -->
        </div>
        </div>
<?php
 }
}
?>


<!-- HTML -->
<div class="col-md-12 mt-5">
    <div class="row">
        <div class="col-md-12 text-center text-white">
            <?php cardAviso();  ?>
        </div>
    </div>

    <div class="col-lg-11   card card-body mx-auto">

        <div class="card card-body shadow ">
            <div class="row">
                <div class="col-lg-6">
                    <!-- linea 1 -->
                    <form class="form-inline">
                        <div class="ml-5"><label class="text-secondary" href="catalogo.php">Digite producto</label></div>
                        <input class="form-control" type="search" placeholder="Busqueda" aria-label="Search" name="busqueda">
                        <button class="btn btn-outline-success " type="submit">Buscar</button>
                    </form>
                </div><!-- fin de primera divicion -->

                <div class="col-lg-6">
                    <!-- linea 2 -->
                    <form class="form-inline">
                        <em class="ml-5"> <a class="text-secondary" href="catalogo.php">Seleccione categoria</a></em>
                        <div class="form-group">
                            <select name="cat" id="" class="form-control">
                                <?php selectCategorias(); ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-success " type="submit">Buscar</button>
                    </form>
                </div><!-- fin de Segunda divicion -->
            </div><!-- fin de row -->
        </div><!-- fin de card de busqda -->
        <?php alerta(); ?>

        <?php
        print_r($_POST);
        ?>

        <div class="container">
            <div class="row">
                <?php mostrarCatalogo($datos); ?>
            </div>
        </div>
    </div>
</div>

<?php
rutFinFooterFrom();
rutFromFin();
?>