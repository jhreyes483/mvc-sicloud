<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
cardtitulo("Log error");
?>

<div class="container col-md-8 col-xl-7">
    <div class="row">
        <!-- formulario de registro --
            <?php
            if (isset($_SESSION['message'])) {
            ?>

                <! alerta boostrap -->
                <div class="alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
                    <?php
                    echo  $_SESSION['message']  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php setMessage();
            } ?>
    </div>
</div>
          

        <!-- inicia segunda divicion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 p-2 mx-auto">
            <table class=" table table-bordered  table-striped bg-white table-sm text-center">
                <thead>

                    <tr>
                        <th>ID error</th>
                        <th>descrip error</th>
                        <th>fecha</th>
                        <th>hora</th>
                        <?php 
                        //$medida = Medida::ningunDatoM();
                        $objModError = new ControllerDoc();
                        $datos  =  $objModError->verError();
                        if (isset($datos)) {
                            //while ($row = $datos->fetch_array()) {
                                foreach($datos as $i => $row){
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los nombres que estan son los mismos de los atributos de la base de datos de lo contrario dara un error -->
                    <td><?php  echo $row['ID_error'] ?></td>
                    <td><?php  echo $row['descrip_error'] ?></td>
                    <td><?php  echo $row['fecha'] ?></td>
                    <td><?php  echo $row['hora'] ?></td>
                    <td>
                        <a href="../controlador/controlador.php?accion=eliminarError&&id=<?php echo $row['ID_error'] ?>" class="btn btn-circle btn-danger"><i class="far fa-trash-alt"></i></a>

                        <!--  get.php?accion=editarMedia?id= -->
                        <!-- edit.php?id=<?//php  echo  $row['id_sitio']  ?> -->
                    </td>
                </tbody>
        <?php

                           } //fin del while
                      } // fin de ver empresa
        ?>
            </table>

</div></div>
        </div><!-- fin de response table -->
    </div><!-- fin de row -->
</div><!-- Fin container -->

<?php
rutFinFooterFrom();
rutFromFin();
?>