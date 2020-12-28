<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();

cardtitulo("Empresa");
?>

<script>
    function eliminarEm(id_em) {
        var confirmacion = confirm('Esta seguro de eliminar empresa con id: ' + id_em + ' ?');
        if (confirmacion) {
            window.location = "../controlador/api.php?apicall=eliminarEmpresa&&id=" + id_em;
        }
    }
</script>

<div class="container-fluid col-md col-xl-7">
    <div class="row">
        <!-- formulario de registro -->
        <div class="p-2 col-8 col-sm-6 col-md-4 col-lg-3 col-xl-4  mx-auto">
<?php
if (isset($_SESSION['message'])) {
?>

                <!-- alerta boostrap -->
                <div class="alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
                    <?=  $_SESSION['message']  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php setMessage();
            } ?>
            <div class="card">
                <div class="card-header">Registro Empresa</div>
                <div class="card-body">
                    <form action="../controlador/api.php" method="POST">
                        <div class="form-group"><input class="form-control" type="text" name="ID_rut" placeholder="Rut" required autofocus maxlength="20"></div>
                        <div class="form-group"><input class="form-control" type="text" name="nom_empresa" placeholder="Empresa" required autofocus maxlength="50"></div>
                        <input type="hidden" name="apicalp" value="insertEmpresa">
                        <div class="form-group"><input class="form-control btn btn-primary" type="submit"  value="Registrar empresa"></div>
                    </form>
                </div><!-- fin card body -->
            </div><!-- fin de card -->
        </div><!-- fin de div formulario -->

        <!-- inicia segunda divicion -->
        <div class="col-md-auto p-2 ">
            <table class=" table table-bordered  table-striped bg-white table-sm mx-auto   text-center">
                <thead>

                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Accion</th>
<?php
$objModEmp = new ControllerDoc();
//$medida = Medida::ningunDatoM();
$datos  = $objModEmp->verEmpresa();
if (isset($datos)) {
    // while ($row = $datos->fetch_array()) { 
    foreach ($datos as $i => $row) {
?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los nombres que estan son los mismos de los atributos de la base de datos de lo contrario dara un error -->
                    <td><?= $row['ID_rut'] ?></td>
                    <td><?= $row['nom_empresa'] ?></td>
                    <td>
                        <form action="formEdicionEmpresa.php" method="POST">
                            <button type="submit" class="btn btn-circle btn-secondary"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="Editar Empresa">
                            <input type="hidden" name="id" value="<?= $row['ID_rut'] ?>">
                        </form>
                        <i class="fas fa-marker"></i></button>
                        <a onclick="eliminarEm(<?= $row['ID_rut'] ?>)" href="#" class="  btn btn-circle btn-danger"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminar Empresa">
                        <i class="far fa-trash-alt"></i></a>
                    </td>
                </tbody>
<?php
                    } //fin del while
                } // fin de ver empresa
?>
            </table>


        </div><!-- fin de response table -->
    </div><!-- fin de row -->
</div><!-- Fin container -->

<?php
rutFinFooterFrom();
rutFromFin();
?>