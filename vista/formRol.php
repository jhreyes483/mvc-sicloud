<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
cardtitulo("Rol");

?>

<script>
    function eliminarR(id_rol){
        var conf = confirm('Esta seguro de eliminar rol con id: ' + id_rol ); 
        if(conf){
            window.location = "../controlador/controlador.php?accion=eliminarRol&&id=" + id_rol;
        }
    }
</script>

<div class="container-fluid col-md col-xl-6">
    <div class="row">

        <!-- formulario de registro -->
        <div class="p-2 col-8 col-sm-6 col-md-4 col-lg-3 col-xl-4  mx-auto">
            <?php if (isset($_SESSION['message'])) { ?>
                <!-- alerta boostrap -->
                <div class="alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
                    <?php
                    echo  $_SESSION['message']  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


            <?php
                setMessage();
                //session_unset();
            } ?>

            <div class="card">
                <div class="card-header">Registro de rol</div>
                <div class="card-body">
                    <form action="../controlador/post.php" method="POST">
                        <div class="form-group"><input class="form-control" type="text" name="nom_rol" placeholder="Rol" required autofocus maxlength="25"></div>
                        <input type="hidden" name="accion" value="insertRol">
                        <div class="form-group"><input class="form-control btn btn-primary" type="submit" name="submit" value="Registrar rol"></div>
                    </form>
                </div><!-- fin card body -->
            </div><!-- fin de card --> <br><br><br><br>
        </div><!-- fin de col 3 -->

        <!-- inicia segunda divicion -->
        <div class="col-md-auto p-2 ">
            <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">
                <thead>

                    <tr>
                        <th>ID rol</th>
                        <th>Categoria</th>
                        <th>Accion</th>
                        <?php 
                        $objModRol = new ControllerDoc();
                        $datos  = $objModRol->verRol();
                        if (isset($datos)) {
                            //while ($row = $datos->fetch_array()) {
                                foreach($datos as $i =>$row){
                        ?>
                    </tr>
                </thead>
                <tbody>

                    <td><?php echo $row['ID_rol_n'] ?></td>
                    <td><?php echo $row['nom_rol'] ?></td>



                    <td>
                        <a href="editarRol.php?id=<?php echo $row['ID_rol_n'] ?> " class="btn btn-circle btn-secondary">
                            <i class="fas fa-marker"></i>
                            <a onclick="eliminarR(<?php echo $row['ID_rol_n'] ?>)" href="#" class="btn btn-circle btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                    </td>
                </tbody>
        <?php

                            } //fin del while
                        }
        ?>
            </table>
        </div><!-- fin de div col table -->
    </div><!-- fin de row -->
</div><!-- Fin container -->

<?php
rutFinFooterFrom();
rutFromFin();
?>