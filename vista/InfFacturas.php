<?php
include_once '../controlador/controladorrutas.php';
include_once '../controlador/controllerFacturacion.php';
include_once '../controlador/controlador.php';
rutFromIni();
$objConF    = new ControllerFactura();
$objSession = new Session();
$u = $objSession->desencriptaSesion();


//comprobacion de rol
$in = false;
switch ($u['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
        break;
    case 3:
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


    if (isset($_GET)) {
        extract($_GET);
        $aC = $objConF->verFactura($f);
        if ($aC['response_status'] == 'OK') {
            $aU = $aC['response_msg'][0];
            $aP = $aC['response_msg'][1];
        } else {
            die('<div class="col-lg-6 col-12 col-sm-12 shadow-lg mx-auto text-center my-4  alert alert-danger alert-dismissible fade show" role="alert">
        <h1>' . $aC['response_msg'] . '</h1> <br> 
        <a class="btn btn-outline-primary"  href="#">Seleccione otra factura</a>
     </div>');
        }
?>

        <?php
        if (count($aU) != 0) {
            foreach ($aU as $row) {
        ?>
                <div class=" card mx-auto container-fluid my-4 col-lg-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="fonts/capsulelogo.PNG" alt="" style="width: 430px; height: 165px;">
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="card p-2">Factura <br><?php echo $row['ID_factura'] ?></div>
                            <div class="card p-3">Fecha: <?php echo $row['fecha'] ?></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10 card card-body">
                            <div class=" row form-group mx-2 my-4 ">
                                <?php echo $row['nom_doc'] . ":   " . $row['ID_us']; ?> <br>
                                CLIENTE <?php echo ":   " . $row['nom1'] . " " . $row['nom2'] . " " . $row['ape1'];  ?><br>
                                E-MAIL <?php echo ":   " . $row['correo'];  ?><br>
                                DIRECCION <?php echo ":   " . $row['dir']; ?> <br>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="row">
                                <div class="col-lg-12 card card-body">ORDEN DE COMPRA <br>N-A</div>
                                <div class="col-lg-12 card card-body">MEDIO DE PAGO<?php echo "<br>" . $row['nom_tipo_pago'];          ?> </div>
                                <div class="col-lg-12 card card-body">TIPO <br> <?= $row[12] ?> </div>
                            <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-12 card card-body">
                            <table class=" table table-bordered table-striped bg-white table-sm shadow">
                                <thead>
                                    <tr>
                                        <td class="col-3">DESCRIPCION</td>
                                        <td>CANT.</td>
                                        <td>VR.UNIT</td>
                                        <td>IVA</td>
                                        <td>TOTAL</td>
                                        <?php
                                        if (isset($aP)) {
                                            foreach ($aP as $row) {
                                        ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="col-3"><?php echo $row['nom_prod']    ?></td>
                                    <td><?php echo $row['cantidad']   ?></td>
                                    <td><?php echo  "$" . number_format(($row['val_prod']), 0, ',', '.')    ?></td>
                                    <td><?php echo "$" . number_format(((0.19 * ($row['val_prod'] * $row['cantidad']))), 0, ',', '.')   ?></td>
                                    <td> <?php echo "$" . number_format((($t = $row['cantidad'] * $row['val_prod'])), 0, ',', '.')
                                            ?></td>

                                <?php   } // verfactural
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <table class="table table-bordered table-striped ">
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 card">
                            <h5>VALOR EN LETRAS</h5>
                            <?php
                                            $v = new CifrasEnLetras();
                                            //Convertimos el total en letras
                                            $totalpagar = $t;
                                            $letra = ($v->convertirEurosEnLetras($aU[0][11]));
                            ?>
                            <div>
                                <span><?= ucfirst($letra)?></span>
                            </div>
                        </div>
                        <div class="col-lg-4 card card-body">
                            <h4>$ <?= number_format($aU[0][11], 0, ',', '.') ?> </h3>
                        </div>
                    </div>
                </div>

            <?php   }
                                    } else {  ?>
            <div class="row">
                <div class="col-lg-2 mx-auto my-4">
                    <div class="card card-body text-center">
                        <?php echo "No hay registros ";  ?>
                    </div>
                </div>
            </div>
<?php }
                                }
                            }


                            rutFinFooterFrom();
                            rutFromFin();
?>