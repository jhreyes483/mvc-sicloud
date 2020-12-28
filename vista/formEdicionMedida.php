<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();

//-----------------------------------------------------------------------------------
cardtitulo("Editar medida");
$objModMed = new ControllerDoc();

//Accion editar 
if ((isset($_POST['id']))) {
    extract($_POST);
    $datos = $objModMed->verMedidaPorId($id);
        foreach($datos as $i => $d){
?>
        <div class="container-fluid col-md col-xl-6">
            <div class="row">
                <div class="p-2 col-8 col-sm-6 col-md-4 col-lg-3 col-xl-4  mx-auto">
                    <div class="card">
                        <div class="card-header">Registro</div>
                        <div class="card-body">
                            <form action="../controlador/api.php"  method="POST">
                                <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="Medida" value="<?= $d[1]  ?>" required autofocus maxlength="35"></div>
                                <div class="form-group"><input class="form-control" type="text" name="acron" placeholder="Acronimo" value="<?= $d[2]  ?>" required autofocus maxlength="5"></div>
                                <input type="hidden" name="apicalp" value="insertUdateMedia">
                                <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                                <div class="form-group"><input class="form-control btn btn-primary" type="submit" value="Actualizar medida"></div>
                            </form>
                        </div><!-- fin card body -->
                    </div><!-- fin de card -->
                </div><!-- fin de col 2 -->
            </div><!-- fin de columnas -->
        </div><!-- Fin de container -->

<?php
    } //fin de while
} //fin de get
?>


<?php
rutFinFooterFrom();
rutFromFin();
?>