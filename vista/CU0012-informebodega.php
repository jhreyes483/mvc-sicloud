<?php

include_once '../controlador/controladorrutas.php';
include_once '../controlador/controllerFacturacion.php';
rutFromIni();
$objSession = new Session();
$u      = $objSession->desencriptaSesion();



//comprobacion de rol
$in = false;
switch ($u['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
        break;
    case 2:
        $in = true;
        break;
    case 3:
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
    cardtitulo("Informe de Bodega");
    $objModFact = new ControllerDoc();




?>

    <div class="card card-body text-center col-md-10 mx-auto">
        <!--<div class="container">-->
        <div class=" container-fluid ">
            <div class="card card-body ">
            </div><br>
            <form action="CU0012-informebodega.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <!-- derecha -->
                        <label for="start">Fecha inicial:</label>
                        <div class="form-group"><input class="form-control" type="date" id="start" name="f1" value="2015-01-01" min="0000-00-00" max="9999-99-99"></div>
                        <label for="start">Fecha fin:</label>
                        <div class="form-group"><input class="form-control" type="date" id="start" name="f2" value="<?= date('Y-m-d') ?>"></div>
                    </div><!-- fin primera columna de 6 -->



                    <div class="col-md-6">
                        <!-- Izquierda -->
                        Formato de descarga <br>
                        <select class="form-control">
                            Periodo promedio
                            <option>CSV</option>
                            <option>EXCEL</option>
                            <option>PDF</option>
                            <option>XML</option>
                        </select><br>

                        <div class="form-group"> <input class="btn btn-primary form-control" type="submit" value="Ver informe" name="consulta"> </div>
            </form>
            <a class="btn btn-block btn-primary my-2" href="">Imprimir informe</a>
        </div><!-- fin de segunda columna de 6 -->

    </div><!-- fin de row -->
    </div><!-- fin de container fluid -->
    </div><!-- fin de card -->

    <?php
    if (isset($_POST['consulta'])) {
        extract($_POST);
        $facturas    = $objModFact->verIntervaloFecha($f1, $f2);
        $total       = array_sum(array_column($facturas, 11));
        $v            = new CifrasEnLetras();
        //Convertimos el total en letras
        $letra = ($v->convertirEurosEnLetras($total));
    ?>
        <div class="container">
            <div class="my-4">
                <div class="row">
                    <table id="facturas" class="tablesorter text-center col-md-10 col-sm-10 col-xs-8 mx-auto">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th><i class="far fa-calendar-alt"></i>
                                <i class="fas fa-arrows-alt-v"></i>
                                    Fecha</th>
                                <th><i class="fas fa-arrows-alt-v"></i>Nombre de cliente</th>
                                <th><i class="fas fa-arrows-alt-v"></i>Medio de pago</th>
                                <th><i class="fas fa-arrows-alt-v"></i>Iva</th>
                                <th><i class="fas fa-arrows-alt-v"></i>Total</th>
                                <th><i class="fas fa-arrows-alt-v"></i>Factura No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($facturas as $i => $d) {
                            ?>
                                <tr>
                                    <td><?= $d[8] ?></td>
                                    <td><?= $d[2] . ' ' . $d[3] . ' ' . $d[4] . ' ' . $d[5] ?> </td>
                                    <td><?= $d[10] ?></td>
                                    <td><?= ('$' . number_format(($d[11] * 0.19), 0, ',', '.'))  ?></td>
                                    <td><?= '$' . number_format($d[11], 0, ',', '.');  ?></td>
                                    <td>
                                        <a href="InfFacturas.php?f=<?= $d[7]  ?>" class="btn btn-circle btn-success btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Consultar factura"><?= $d[7] ?> </i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } // fin de while tabla
                            ?>
                                                  </tbody>
                            <tr>
                                <td colspan="3" class="mt-2 lead" align="right">
                                    Total
                                </td>
                                <td colspan="2" class="mt-2 lead" align="right">
                                    <?= '$' . number_format($total, 0, ',', '.');  ?>
                                <td></td>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-dark text-white" colspan="6">
                                    <em><?= ucfirst($letra); ?></em>
                                </td>
                            </tr>
  
                    </table>
                </div>
            </div>
        </div>
<?php
    }
    rutFinFooterFrom();
    rutFromFin();
} // fin de validacion permisos

?>

<script>
    $(document).ready(function() {
        $("table").addClass("table-hover bg-white table-sm table-bordered")
        $("#facturas").tablesorter({
            widgets: ['zebra'],
            sortList: [
                [0, 1]
            ],

        });
    });
</script>