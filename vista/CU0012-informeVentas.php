<?php

include_once '../controlador/controladorrutas.php';
rutFromIni();
$objSession =new Session();
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
                    <div class="form-group"><input class="form-control" type="date" id="start" name="f2" value="<?= date('Y-m-d') ?>" ></div>
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
    $facturas   = $objModFact->verIntervaloFecha($f1, $f2);
?>


    <div class="container">
        <div class="my-4">
            <div class="row">
                <table class="table table-striped table-hover bg-bordered bg-light table-sm col-md-8 col-sm-8 col-xs-8 mx-auto">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                           
                            
                            <th>fecha</th>
                            <th>Nombre de cliente</th>
                            <th>total</th>
                            <th>Iva</th>
                            <th>Medio de pago</th>
                            <th>Factura No.</th>
                        </tr>
                    </thead>
                    <?php 
                        foreach($facturas as $i => $d){

                    ?>
                        <tbody>
                            <tr>       
                                <td ><?=$d[8] ?></td>
                                <td><?= $d[2].' '.$d[3] .' '.$d[4].' '.$d[5] ?> </td>
                                <td><?= $d[11] ?></td>
                                <td><?= ($d[11] * 0.19) ?></td>
                                <td><?= $d[10] ?></td>

                                <td>
                                
                                <a href="InfFacturas.php?f=<?= $d[7]  ?>" 
                                    class="btn btn-circle btn-success btn"
                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Consultar factura"
                                    ><?=$d[7] ?>  </i>
                                </a>


                                </td>
                                
                                

                            </tr>
                        </tbody>
                    <?php
                    } // fin de while tabla
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php
}
rutFinFooterFrom();
rutFromFin();
}// fin de validacion permisos

?>