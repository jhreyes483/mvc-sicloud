<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
$objSession = new Session();
$objP       = new ControllerDoc();
$datos      = $objP->verProductos();
$s          = $objSession->desencriptaSesion();
$modulo     = (isset($_GET['edit'])) ?  'Editar producto' : 'Stock de productos';


cardtitulo($modulo);

if (isset($_SESSION['message'])) {  ?>
    <!-- alerta boostrap -->
    <div class="alert text-center col-md-4 mx-auto alert-<?= $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
        <?php
        echo  $_SESSION['message']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    setMessage();
}
rutFromFin();

?>


<script>
    $(document).ready(function() {
        $("table").addClass("table-hover bg-white table-sm table-bordered")
        $("#stock").tablesorter({
            widgets: ['zebra'],
            sortList: [
                [2, 1],
                [0, 0]
            ],
            headers: {
                5: {
                    sorter: false
                },
                7: {
                    sorter: false
                }
            }
        });
    });
</script>



<table id="stock" class="col-md-10 col-sm-10 col-xs-12 text-centar mx-auto">
    <thead class="bg-dark text-white">
        <tr>
            <th><i class="fas fa-arrows-alt-v"></i> Nombre Producto</th>
            <th><i class="fas fa-arrows-alt-v"></i>Valor Producto</th>
            <th><i class="fas fa-arrows-alt-v"></i>Stock </th>
            <th><i class="fas fa-arrows-alt-v"></i>Estado del producto</th>
            <th><i class="fas fa-arrows-alt-v"></i>categoria</th>
            <th>Imagen</th>
            <th><i class="fas fa-arrows-alt-v"></i>Medida</th>
            <th>Ingresar a inventario</th>
            <?php
            if (isset($_GET['edit'])) echo '<th>Edicion de producto</th>';
            ?>

            <?php if ($_SESSION['usuario']['ID_rol_n'] == 1 || $_SESSION['usuario']['ID_rol_n'] == 1) {   ?>
                <th>Accion</th><?php }  ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos as $i => $row) {
            $p  =  $row['stok_prod'];
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
            <tr>
                <td><?php echo $row['nom_prod'] ?></td>
                <td><?php echo "$" . number_format(($row['val_prod']), 0, ',', '.'); ?></td>
                <td class=" <?php echo  $c  ?>"><?php echo $row['stok_prod'] ?></td>
                <td><?php echo $row['estado_prod'] ?></td>
                <td><?php echo $row['nom_categoria'] ?></td>
                <td><img class="card card-body  mx-auto" src="fonts/img/<?= ($row['img'] != '') ?  $row['img'] : imgProducto; ?>" alt="Card image cap" height="130px" width="150px"></td>
                <td><?php echo $row['nom_medida'] ?></td>

                <?php// if ($s['usuario']['ID_rol_n'] == 1 || $s['usuario']['ID_rol_n'] == 1) {   ?>
                <td>
                    <a class="btn btn-success mx-auto text-center" href="CU003-ingresoProducto.php?consulta=Validar+exitencia&&p=<?php echo $row['ID_prod'] ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="Ingresar productos a inventario">
                        <i class="fas fa-tags"></i>
                        ingreso</a>
                </td>

                <?php
                if (isset($_GET['edit'])) {
                ?>
                    <td>
                        <form action="editarProducto.php" method="POST">
                            <button class="btn-circle btn btn-dark mx-auto" type="submit" data-bs-toggle="tooltip" data-bs-placement="right" title="Editar producto">
                                <i class="fas fa-marker"></i></button>
                            <input type="hidden" name="id" value="<?= $row['ID_prod'] ?>">
                        </form>
                        <?php if ($s['usuario']['ID_rol_n'] == 1) {
                        ?>
                            <form action="../controlador/api.php" method="POST">
                                <button type="submit" class="btn-circle btn btn-danger mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>
                                <input type="hidden" name="id" value="<?= $row['ID_prod'] ?>">
                                <input type="hidden" name="apicalp" value="EliminarProducto">
                            </form>
                    </td>
            <?php
                        }
                    }
            ?>
            </tr>
        <?php
        } // fin de tabla StockGenera
        ?>
    </tbody>
    <tr>
        <td class="text-center mx-auto" colspan="4">
            <?php
            if (isset($_GET['edit'])) echo '    <td colspan="10">
    <a href="CU004-crearProductos.php" class="btn btn-primary">Crear producto</a>
    </td>
    </tr>';
            ?>
        </td>
    </tr>
</table>

<div class="col-lg-10 mb-4 mx-auto my-4">
    <!-- Project Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 shadow p-3 mb-5 bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo "Producos" ?></h6>
        </div>
        <div class="card-body">
            <?php
            //FIN DE EVENTOS-----------------------------------------------------------------------------------------------------------
            foreach ($datos as $i => $row) {
                //while ($row = $prod->fetch_array()) {
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
        </div><!-- fin de card body -->
    </div><!-- fin de col categoria  -->
</div>

<?php
rutFinFooterFrom();

?>