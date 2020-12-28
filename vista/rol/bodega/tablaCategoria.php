<?php

include_once '../../../controlador/ControladorSession.php';
$objSession =new Session();
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
    include_once '../../plantillas/plantilla.php';
    include_once '../../plantillas/cuerpo/inihtmlN3.php';
    include_once '../../plantillas/nav/navN3.php';

    /*
    include_once '../../clases/class.categoria.php';
    include_once '../../clases/class.producto.php';
*/
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


    <div class="card col-md-4 mx-auto">
        <div class="card-body">
            <h5 class="card-title text-center ">Seleccione Categora</h5>
            <!-- INI--FORM PRODUCTO--------------------------------------------------------------------------------- -->
            <form action="tablaCategoria.php" method="GET">
                <select name="p" class="form-control">
                    <?php
                    $datos = Categoria::verCategoria();
                    while ($row = $datos->fetch_array()) {

                    ?>
                        <option value="<?php echo $row['ID_categoria'] ?>"><?php echo $row['nom_categoria'] ?></option>

                    <?php } ?>
                </select>
                <br> <input class="btn btn-primary btn-block my-2" type="submit" name="consulta" value="consulta">

            </form>
            <a class="btn btn-primary btn-block" href="../../forms/formCategoria.php">Crear Categoria</a>
        </div> <!-- fin de div card -->
    </div>
    <!-- fin producto-------------------------------------------------------------------------------- -->


    <?php
    if (isset($_GET['consulta'])) {
        $id = $_GET['p'];
    ?>
        <div class="col-md-4 p-2 mx-auto my-4 ">
            <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Stok</th>
                        <th>Categoria</th>
                    </tr>
                </thead>

                <?php
                $datos = Producto::verProductosAlfa($id);
                while ($row = $datos->fetch_array()) {
                ?>

                    <tbody>
                        <tr>
                            <td> <?php echo $row['nom_prod']  ?></td>
                            <td> <?php echo $row['stok_prod']  ?></td>
                            <td> <?php echo $row['nom_categoria']  ?></td>
                        </tr>
                    </tbody>
                <?php    }  ?>
            </table>
        </div><!-- fin de div tabla responce -->



<?php

    } // fin de isset consulta
} // fin de validar permisos

include_once '../../plantillas/cuerpo/finhtml.php';
?>