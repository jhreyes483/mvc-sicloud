<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
$us = false;
$em = false;
//include_once '../controlador/controladorforms.php';
$objModRol = new ControllerDoc();
$a = $objModRol->verTelefonosUsuarioPorID(1);
// verTelefonosUsuarioPorID

if( isset($_POST['accion'])){
    switch ($_POST['accion']) {
        case 'bId':
            $datosTabla = $objModRol->verTelefonosUsuarioPorID($_POST['documento']  );
            $us =  true;
            $em = false;
        break;
        case 'empresa':
            $datosTabla = $objModRol->verTelefonosEmpresa();
            $em = true;
            $us = false;
        break;
        case 'usuario':
            $datosTabla = $objModRol->verTelefonosUsuario();
            $em = false;
            $us = true;
        break;
        case 'rolTelefono':
            $datosTabla = $objModRol->verTelefonosUsuarioRol($_POST['rol']);
            $em = false;
            $us = true;
        break;
 }
    
}
?>
<script>



    function eliminarT(id_us) {
            var confirmation = confirm('Esta seguro que desea eliminarTelefono: ' + id_us + ' ?');
            if (confirmation) {
               window.location = "../controlador/api.php?apicall=eliminarTelefono&&id=" + id_us;
            }
        }
</script>
<?php cardtituloS("Directorio telefonico") ?>



<div class="card card-body col-md-8 mx-auto my-2 text-center">
    <div class="card-title">Filtros</div>

    <div class="row">



        <!-- Primera fila  4 de 12 col-->
        <div class="card card-body col-md-4 shadow">
            <h6>Busqueda por ID Usuario</h6>
            <div class="card card-body mx-auto col-10 my-2 shadow border">
                <!-- form por id -->
                <form action="formTelefono.php" method="POST">
                    <div class="form-group"><input type="text" class="form-control " placeholder="ID usuario " name="documento"></div>
                    <input type="hidden" value="bId" name="accion">
                    <div class="form-group "><input class="btn btn-primary form-control " type="submit" value="Buscar id"></div>
                </form>
                <!-- fin de form por id -->



            </div><!-- fin de card -->
        </div><!-- fin de primera divicion -->
        <!-- -------------------------------------------------------------- -->

        <!-- Segunda fila 8 de  12 col-->
        <div class="card card-body col-md-4 shadow">
            <h6>Busqueda por entidad</h6>
            <div class="card card-body mx-auto col-10 my-2 shadow border">
                <form action="formTelefono.php" method="POST">
                    <div class="form-group">
                        <select name="accion" class="form-control">
                            <option value="empresa">Empresas</option>
                            <option value="usuario">Usuario</option>
                        </select>
                    </div>

                    
                    <div class="form-group "><input class="btn btn-primary form-control " type="submit" value="Registros"></div>
                </form><!-- fin de form estado filtro estado de cuenta -->
            </div><!-- fin de card -->
        </div><!-- fin de segundsa divicion -->


        <!-- -------------------------------------------------------------- -->


        <!-- Tercera fila 12 de 12 col bootstrap-->
        <div class="card card-body col-md-4 shadow">
            <h6>Busqueda por rol</h6>
            <div class="card card-body mx-auto col-10 my-2 shadow border">
                <!-- formulario de filtro por rol -->
                <div class="form-group">
                    <form action="formTelefono.php" method="POST">
                        <select name="rol" class="form-control ">
                            <?php
                          
                            $datos = $objModRol->verRol();
                            foreach ($datos as $i => $row) {
                            //while ($row = $datos->fetch_array()) 
                            
                            ?>
                                <option value="<?php echo $row['ID_rol_n'] ?>"><?php echo $row['nom_rol'] ?></option>
                            <?php
                            }  ?>
                        </select>
                </div><!-- fin de form control -->
                <input type="hidden" name="accion" value="rolTelefono">
                <div class="form-group"><input class="form-control btn btn-primary" name="consultaRol" type="submit" value="Filtrar por rol"></div>
                </form><!-- fin form ver por rol -->
            </div><!-- fin de card -->
        </div><!-- fin de tercera divicion -->

        <!-- -------------------------------------------------------------- -->

    </div><!-- fin de row -->
</div>





<!-- alerta boostrap -->
<div class="alert text-center col-md-4 mx-auto alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
    <?php
    echo  $_SESSION['message']  ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php
setMessage();
// }
?>
<?php


if ((isset($datosTabla))) {


    if ($us ==  true) {
        echo 'here';
?>

        <div class="col-lg-12">
            <div class="table-responsive">

                <table id="example" style="width:100%" class=" col-lg-12  table-bordered  table-striped bg-white   mx-auto">
                    <thead>

                        <tr>
                            <th>ID usario</th>
                            <th>P. Nombre</th>
                            <th>P. Apellido</th>
                            <th>Rol</th>
                            <th>Telefono</th>
                            <th>Accion</th>
                        </tr>

                        <?php

                        //while ($row = $datos->fetch_array()) {
                        foreach ($datosTabla as $i => $row) {
                        ?>
                            </tr>
                    </thead>
                    <tbody>
                        <!-- Los nombres que estan en [''] son los mismos de los atributos de la base de datos de lo contrario dara un error -->
                        <td><?php echo $row['ID_us'] ?></td>
                        <td><?php echo $row['nom1'] ?></td>
                        <td><?php echo $row['ape1'] ?></td>
                        <td><?php echo $row['nom_rol'] ?></td>
                        <td><?php echo $row['tel'] ?></td>
                        <td>
                            <a href="EditarUsuario.php?ID_us= <?php echo $row['ID_us'] ?> " class="btn btn-secondary btn-circle"><i class="fas fa-marker"></i></a>
                            <?php if ($_SESSION['usuario']['ID_rol_n'] == 1) {     ?>
                                <a onclick="eliminarT(<?= $row['ID_us'] ?>)"    href="#" class="btn btn-circle btn-danger"><i class="far fa-trash-alt"></i></a>
                            <?php }  ?>
                        </td>
                    </tbody>
                <?php

                        } // fin de while de muestra telefono usario
                    } // fin de comprobasion de $us = true


                    if ($em ==  true) {
                ?>
                <div class="col-lg-12">
                    <div class="table-responsive">

                        <table id="example" style="width:100%" class=" col-lg-12  table-bordered  table-striped bg-white   mx-auto">
                            <thead>

                                <tr>
                                    <th>ID empresa</th>
                                    <th>Empresa</th>
                                    <th>Telefono</th>
                                    <th>Accion</th>
                                </tr>

                                <?php

                                //while ($row = $datos->fetch_array()) {
                                foreach ($datosTabla as $i => $row) {
                                ?>

                                    </tr>
                            </thead>
                            <tbody>
                                <!-- Los nombres que estan en [''] son los mismos de los atributos de la base de datos de lo contrario dara un error -->
                                <td><?php echo $row['ID_rut'] ?></td>
                                <td><?php echo $row['nom_empresa'] ?></td>
                                <td><?php echo $row['tel'] ?></td>
                                <td>
                                    <a href="EditarUsuario.php?id= <?php echo $row['ID_us'] ?> " class="btn btn-secondary btn-circle"><i class="fas fa-marker"></i></a>
                                    <?php if ($_SESSION['usuario']['ID_rol_n'] == 1) {     ?>
                                        <a href="../controlador/controlador.php?accion=aprobarUsuario&&id= <?php echo $row['ID_us']   ?>" class="btn btn-circle btn-success"><i class="fas fa-check-square"></i> </a>
                                        <a href="../controlador/controlador.php?accion=desactivarUsuario&&id=  <?php echo $row['ID_us']   ?>  " class="btn btn-circle btn-danger"><i class="far fa-trash-alt"></i></a>
                                    <?php }  ?>
                                </td>
                            </tbody>
                <?php
                                } // fin de while muestra telefonos de empresa
                            } // fin de comprobasion de $us = true




                        } // fin de isset datos
                ?>
                        </table>
                    </div>
                </div><!-- div de tablas -->


            </div>


        </div><!-- fin de primera divicion -->



        <div class="card card-body col-md-12 mx-auto my-4 text-center">
            <div class="row">

                <!-- -------------------------------------------------------------- -->

                <div class=" col-md-3  mx-auto">
                    <a class="btn-block btn btn-dark" href="">Imprimir</a>
                </div>
                <div class=" col-md-3  mx-auto">
                    <a class="btn-block btn btn-dark" href="">Exportar</a>
                </div>
                <div class=" col-md-3  mx-auto">
                    <a class="btn-block btn btn-dark" href="../CU009-controlUsuarios.php">Control usuario</a>
                </div>
                <div class=" col-md-3  mx-auto">
                    <a class="btn-block btn btn-dark" href="">Directorio direcciones</a>
                </div>

                <!-- -------------------------------------------------------------- -->
            </div>
        </div>

        <?php
rutFinFooterFrom();
rutFromFin();
        // fin de validadcion y ejecucion de permisos por rol
        ?>