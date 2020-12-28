<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();

cardtitulo("Editar producto");
$objCon = new ControllerDoc();

if (isset($_POST)) {
    extract($_POST);
    $aC = $objCon->ControllerEditaProductos($id);
    if ($aC['response_status'] == 'OK') {
        $categoria =  $aC['response_msg'][0];
        $medida    =  $aC['response_msg'][1];
        $proveedor =  $aC['response_msg'][2];
        $producto  =  $aC['response_msg'][3];
        $estado    =  $aC['response_msg'][4];
    } else {
        die('<h1>' . $aC['response_msg'] . '<h1>');
    }
}

if (isset($_SESSION['message'])) {
?>
    <!-- alerta boostrap -->
    <div class="col-lg-4 mx-auto alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
        <?php echo  $_SESSION['message']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    setMessage();
}
?>

<div class="card card-body text-center  col-md-10 mx-auto p-2 ">
    <div class=" container-fluid ">
        <div class="card card-body shadow mb-5"> <br>
            <div class="row">
                <?php
                foreach ($producto as $row) {
                ?>
                    <div class="col-md-4">
                        <!-- inicio de divicion 1 -->
                        <form action="../controlador/api.php" method="POST">
                            <!-- derecha -->
                            <div class="form-group"><label for="">ID Producto</label><input class="form-control" value="<?= $row['ID_prod'] ?>" type="text" placeholder="ID producto" value="<?php $row['ID_prod']  ?> " ; name="ID_prod"></div>
                            <div class="form-group"><label for="">Nombre Producto</label><input class="form-control" value="<?= $row['nom_prod']  ?>" type="text" class="form-control" placeholder="Nombre producto" name="nom_prod"></div>
                            <div class="form-group"><label for="">Valor Producto</label><input class="form-control" type="number" value="<?= $row['val_prod']  ?>" class="form-control" placeholder="Valor" name="val_prod"></div>
                            <input type="hidden" name="apicalp" value="updateProducto">
                            <div class="form-group"> <input class="btn btn-primary form-control" type="submit" name="submit" value="actualizar Producto"> </div>
                    </div><!-- fin de primera divicion-->

                    <div class="col-md-4">
                        <!-- inicio de 2 divicion -->
                        <!-- Izquierda -->
                        <div class="form-group">
                            <label for="">Selecciones estado</label>
                            <select name="estado_prod" class="form-control">
                                <?php
                                foreach ($estado as $e) {
                                ?>
                                    <option <?= ($e == $producto[0][4]) ? 'selected' : ''; ?> value="<?= $e ?>"><?= $e ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group"><label for="">Stock Inicial</label><input type="number" class="form-control" value="<?php echo $row['stok_prod'] ?>" name="stok_prod" required autofocus></div>
                        <div class="form-group"><label for="">ID factura Proveedor</label><input type="text" class="form-control" value="<?php echo "22" ?>" name="num_fac_ing" autofocus></div>
                        <div class="form-group"><label for="">Fecha de resepcion</label><input type="date" class="form-control" placeholder="Proveedor" value="2020-05-22" min="0000-00-00" max="9999-99-99" name="fecha"></div>
                    </div><!-- fin de segunda divicion-->
                    <div class="col-md-4">
                        <div class="form-group"><label for="">Categoria de producto</label><br>
                        <?php  }  ?>
                        <select class="form-control" name="CF_categoria">
                            <?php


                            foreach ($categoria as $c) {
                            ?>
                                <option <?= ($c['ID_categoria'] == $producto[0]['CF_categoria']) ? 'selected' : ''; ?> value="<?= $c['ID_categoria'] ?>"><?= $c['nom_categoria'] ?></option>
                            <?php } ?>
                        </select>
                        </div><!--  fin de form-group Producto -->


                        <div class="form-group"><label for="">Medida</label>
                            <select class="form-control" name="CF_tipo_medida">
                                <?php
                                foreach ($medida as $m) {
                                ?>
                                    <option <?= ($m[0] ==  $producto[0][8]) ? 'selected' : ''; ?> value="<?= $m[0] ?>"><?= $m[1] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div><!--  fin de form-group Medida -->
                        <div class=" form-group"><label for="">Provedor</label>
                            <select class="form-control" name="FK_rut">
                                <?php
                                foreach ($proveedor as $p) {
                                ?>
                                    <option <?= ($p[0]  == $producto[0][9]) ? 'selected' : '';  ?> value="<?= $p[0]  ?>"> <?= $p[1]  ?> </option>
                                <?php  } ?>
                            </select>
                        </div><!--  fin de form-group Provedor-->
                        <!-- BOTON A ENLACE TABLA -->
                        <div class="form-group "><a class="btn btn-primary form-control" href="edicionProductoTabla.php">Ver productos existentes</a></div>
                        </form>
                    </div><!-- fin de tercera divicion -->
            </div><!-- row -->
        </div><!-- fin card body interno -->
    </div><!-- fin de container fluid -->
</div><!-- Card externo -->





<?php
rutFinFooterFrom();
rutFromFin();

?>
<script>

</script>