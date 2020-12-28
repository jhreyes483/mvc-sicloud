<?php

include_once '../controlador/controladorrutas.php';
rutFromIni();
$objSession = new Session();
$u = $objSession->desencriptaSesion();

//comprobacion de rol
$in = false;
switch ($u['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
        break;
    case 2:
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
        echo "<script>window.location.replace('../index.php');</script>";
        break;
}
if ($in == false) {
    echo "<script>alert('No tiene permiso para ingresar a este modulo');</script>";
    echo "<script>window.location.replace('../index.php');</script>";
} else {

?>
    <div class="my-4">
        <?php
        cardtitulo("Vista por categoria");
        ?>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <!-- alerta boostrap -->
        <div class="col-md-4 mx-auto alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
            <?php
            echo  $_SESSION['message']  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        setMessage();
    }
    ?>

    <div class="row col-lg-10 mx-auto">
        <div class="card col-md-4 mx-auto">
            <div class="card-body">
                <h5 class="card-title text-center ">Seleccione Categoria</h5>
                <!-- INI--FORM PRODUCTO--------------------------------------------------------------------------------- -->
                <form action="tablaCategoria.php" method="GET">
                    <select name="p" class="form-control">
                        <?php
                        $objc = new ControllerDoc();
                        $datos = $objc->verCategorias();
                        foreach ($datos as $i => $row) {
                            //while ($row = $datos->fetch_array()) {

                        ?>
                            <option value="<?= $row['ID_categoria'] ?>"><?= $row['nom_categoria'] ?></option>

                        <?php } ?>
                    </select>
                    <br> <input class="btn btn-primary btn-block my-2" type="submit" name="consulta" value="consulta">

                </form>
                <?php
                if (($u['usuario']['ID_rol_n'] == 1) || ($u['usuario']['ID_rol_n'] == 2)) {
                    echo '<a class="btn btn-primary btn-block" href="formCategoria.php">Crear Categoria</a>';
                }
                ?>
            </div> <!-- fin de div card -->
        </div>

        <!-- fin producto-------------------------------------------------------------------------------- -->
        <?php
        if (isset($_GET['consulta'])) {
            $id = $_GET['p'];
        ?>
            <div class="col-md-6 mx-auto my-4 ">
                <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">

                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Stok</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>

                    <?php
                    $objp = new ControllerDoc();
                    $datos = $objp->verPorCategoria($id);
                    foreach ($datos as $i => $row) {
                        //while ($row = $datos->fetch_array()) {
                    ?>
                        <tbody>
                            <tr>
                                <td> <?= $row['nom_prod']  ?></td>
                                <td> <?= $row['stok_prod']  ?></td>
                                <td> <?= $row['nom_categoria']  ?></td>
                            </tr>
                        </tbody>
                    <?php   }  ?>
                </table>
            </div><!-- fin de div tabla responce -->
    </div>
    <div class="card card-body col-lg-10 mx-auto my-4">
        <div class="card card-body col-lg-10 shadow mx-auto">
            <?php

            foreach ($datos as $i => $row) {
                $p  =  $row['stok_prod'];
                $po  = 10 * $row['stok_prod'];
                $po = $po . "%";
                $c = "text";
                if ($p < 2) {
                    $c = "danger";
                } elseif ($p <= 6) {
                    $c = "warning";
                } elseif ($p >= 7) {
                    $c = "success";
                }
                $c = "bg-" . $c;
            ?>
                <h4 class="small font-weight-bold"><?= $row['nom_prod']  ?> <span class="float-right"><?= " Cantidad de productos; " . $p ?></span> </h4>
                <div class="progress mb-4">
                    <div class="progress-bar <?= $c ?>" role="progressbar" style="width:<?= $po; ?>" aria-valuenow=<?= $c ?> aria-valuemin="0" aria-valuemax="100"></div>


                </div>
            <?php
            } // fin de while producto
            ?>
        </div>

    </div>
    </div>




<?php

        } // fin de isset consulta
    } // fin de validar permisos
    rutFinFooterFrom();
    rutFromFin();
?>