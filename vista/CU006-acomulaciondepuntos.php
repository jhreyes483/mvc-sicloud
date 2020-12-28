<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
$objSession =new Session();
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
    case 6:
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



cardtitulo("Acumulación de puntos de compra");
$objCon = new ControllerDoc();
?>
<div class="card card-body text-center col-md-8 mx-auto">
    <!--<div class="container">-->
    <div class=" container-fluid ">
        <div class="card card-body mb-2 shadow ">



            <form action="CU006-acomulaciondepuntos.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <!-- derecha -->
                        <label for="start">Fecha:</label>
                        <div class="form-group"><input class="form-control" type="date" id="start" name="trip-start" value="2020-05-22" min="0000-00-00" max="9999-99-99"></div>
                        Id CLiente
                        <div class="form-group"><input type="text" class="form-control" placeholder="Id cliente"></div>
                    </div><!-- col 6 -->

                    <div class="col-md-6">
                        <!-- Izquierda -->
                        Pediodo promedio <br>
                        <select class="form-control">
                            Pediodo promedio
                            <option>Día</option>
                            <option>Mes</option>
                            <option>Año</option>
                        </select><br>

                        <div class="form-group"> <input class="btn btn-primary form-control" type="submit" value="Ver Puntos Acumulados"> </div>

                    </div><!-- col 6 -->
                </div><!-- row -->
        </div><!-- card -->
    </div><!-- card -->
</div><!-- container -->




<div class="col-md-8 mx-auto my-4">
    <table style="width:100%" class=" col-lg-12  table-bordered  table-striped bg-white   mx-auto">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Puntos</th>
                <th scope="col">Fecha</th>
                <th scope="col">P. nombre cliente</th>
                <th scope="col">S. nombre cliente</th>
                <th scope="col">P. apellido cliente</th>
            </tr>
        </thead>

        <?php
        $datos = $objCon->verPuntosUs();
        // $datos = Usuario::verPuntosUs();
       foreach( $datos as $i => $row){


        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['id_puntos']  ?></td>
                    <td><?php echo $row['puntos']  ?></td>
                    <td><?php echo $row['fecha']  ?></td>
                    <td><?php echo $row['nom1']  ?></td>
                    <td><?php echo $row['nom2']  ?></td>
                    <td><?php echo $row['ape1']  ?></td>

                </tr>


            <?php } ?>


            </tbody>
    </table>
</div>


<?php
rutFinFooterFrom();
rutFromFin();
}
?>