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
    include_once 'plantillas/plantilla.php';
    include_once 'plantillas/cuerpo/inihtmlN1.php';
    include_once 'plantillas/nav/navN1.php';
    rutFromFin();
?>


    <script>
        $(document).ready(function() {
            $("table").addClass("table-hover bg-white table-sm table-bordered")
            $("#cantidad").tablesorter({
                widgets: ['zebra'],
                sortList: [
                    [1, 0]
                ],
            });
        });
    </script>
    <div class="my-4">
        <?php
        cardtitulo("Conteo de productos");
        ?>
    </div>

    <div class="col-md-4 p-2 mx-auto my-4 ">
        <table id="cantidad" class="tablesorter table table-bordered  table-striped bg-white table-sm mx-auto text-center">
            <thead>
                <tr>
                    <th><i class="fas fa-arrows-alt-v"></i>Producto</th>
                    <th><i class="fas fa-arrows-alt-v"></i>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $objP = new ControllerDoc();
                $datos = $objP->ConteoProductosT();
                foreach ($datos as $i => $row) {
                ?>
                    <tr>
                        <td> <?= $row['nom_prod']  ?></td>
                        <td> <?= $row['total']  ?></td>
                    </tr>

                <?php    }  ?>
            </tbody>
        </table>
    </div><!-- fin de div tabla responce -->

<?php
} // fin de validar permisos
rutFinFooterFrom();

?>