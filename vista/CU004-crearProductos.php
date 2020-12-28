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
    case 2:
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

//------------------------------------------------------------------------------------


$objCon = new ControllerDoc();
cardtitulo("Registro producto");
?>
<div class="card card-body text-center  col-md-10 mx-auto ">
    <div class=" container-fluid ">
        <div class="card card-body shadow p-3 mb-4 bg-white"> <br>
            <div class="row">

                <div class="col-md-4">
                    <!-- inicio de divicion 1 -->
                    <form action="../controlador/api.php?apicall=insertProducto" method="POST" enctype="multipart/form-data">
                        <!-- derecha -->

                        <div class="form-group"><label for="">ID Producto</label><input class="form-control" type="text" placeholder="ID producto" name="ID_prod"></div>
                        <div class="form-group"><label for="">Nombre Producto</label><input class="form-control" type="text" class="form-control" placeholder="Nombre producto" name="nom_prod"></div>
                        <div class="form-group"><label for="">Valor Producto</label><input class="form-control" type="number" class="form-control" placeholder="Valor" name="val_prod"></div>
                   <!-- 
                       <input type="hidden" name="accion" value="insertProducto">
                    -->     
                        <div class="form-group"> <input class="btn btn-primary form-control" type="submit" name="submit" value="Registrar producto"> </div>

                </div><!-- fin de primera divicion-->

                <div class="col-md-4">
                    <!-- inicio de 2 divicion -->
                    <!-- Izquierda -->



                    <label for="">Estado de Precio</label>
                    <div class="form-group">
                        <select name="estado_prod" class="form-control">
                            <option value="Promoción">Promoción </option>
                            <option value="Estandar" vado>Estandar</option>
                        </select>
                    </div>

                    <div class="form-group"><label for="">Stock Inicial</label><input type="number" class="form-control" placeholder="Stock inicial" name="stok_prod" required autofocus></div>
                    <div class="form-group"><label for="">ID factura Proveedor</label><input type="text" class="form-control" placeholder="Factura proveedor" name="num_fac_ing" autofocus></div>
                    Imagen:  
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="foto">
                    <label class="custom-file-label" for="customFile">Seleccione una imagen desde su equipo</label>
                </div><br><br>
                
                    <?php if($_SESSION['usuario']['ID_rol_n'] ==  1 || $_SESSION['usuario']['ID_rol_n'] ==  2 ){ ?>
                    <a class="btn btn-block btn-primary by-2" href="CU003-ingresoproducto.php">Ingresar productos</a>

                    <?php } ?>


                </div><!-- fin de segunda divicion-->

                <div class="col-md-4">

                    <div class="form-group"><label for="">Categoria de producto</label>
                        <select class="form-control" name="CF_categoria">
                            <?php
                   

                             $datos =   $objCon->verCategorias();
                            foreach( $datos as $i => $row ) {

                            ?>
                                <option value="<?= $row['ID_categoria'] ?>"><?= $row['nom_categoria'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div><!--  fin de form-group Producto -->


                    <div class="form-group"><label for="">Medida</label>
                        <select class="form-control" name="CF_tipo_medida">
                            <?php
                            
                            
                           
                            $datos =  $objCon->verMedida();
                            foreach($datos as $i => $row ){
                            ?>
                                <option value="<?= $row['ID_medida'] ?>"><?= $row['nom_medida'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div><!--  fin de form-group Medida -->

                    <div class=" form-group"><label for="">Provedor</label>
                        <select class="form-control" name="FK_rut">
                            <?php
                            $datos   = $objCon->verProveedor();
                            foreach($datos as $i => $row) {
                            ?>
                                <option value="<?= $row['ID_rut']  ?>"> <?= $row['nom_empresa']  ?> </option>
                            <?php  } ?>
                        </select>
                    </div><!--  fin de form-group Provedor-->

                    <!-- BOTON A ENLACE TABLA -->
                    <div class="form-group "><a class="btn btn-primary form-control" href="CU004-crearProductos.php?accion=verProducto">Ver productos existentes</a></div>
                    </form>
                </div><!-- fin de tercera divicion -->
            </div><!-- row -->
        </div><!-- fin card body interno -->
    </div><!-- fin de container fluid -->
</div><!-- Card externo --> <br>

<?php
if (isset($_SESSION['message'])) {
?>
    <!-- alerta boostrap -->
    <div class="col-md-4 mx-auto alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
        <?php
        echo  $_SESSION['message']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
    setMessage();
}
?>

<?php
if (isset($_GET['accion'])) {
    //echo print_r($_GET);
    if ($_GET['accion'] == 'verProducto'); {
?>
<div class="container">
            <div class="card card-body bg-while col-lg-12 shadow  mx-auto">
                <div class="row">
                    <table class="table table-striped table-hover bg-bordered bg-light table-sm col-lg-12 col-sm-4 col-xs-12 mx-auto text-center shadow p-3 mb-5 bg-white">
                        <thead>
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Valor Producto</th>
                                <th>Stock </th>
                                <th>Estado del producto</th>
                                <th>categoria</th>
                                <th>Imagen</th>
                                <th>Medida</th>
                                <?php if($_SESSION['usuario']['ID_rol_n'] == 1 || $_SESSION['usuario']['ID_rol_n'] == 1 ){   ?>
                                    <th>Accion</th><?php }  ?>
                            </tr>
                        </thead>
                        <?php
                       // $datos = Producto::verProductos();
                       $datos = $objCon->verProductos();
                        foreach( $datos as $i => $row ){
                            $p  =  $row['stok_prod'];

                            $c = "text";
                            if ($p < 2) {
                                $c = "danger";
                            } elseif ($p <= 6) {
                                $c = "warning";
                            } elseif ($p >= 7) {
                                $c = "success";
                            }
                            $c = "bg-" . $c;

                        ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['nom_prod'] ?></td>
                                    <td><?php echo "$".number_format(($row['val_prod']),0, ',','.' )   ; ?></td>
                                    <td class=" <?php echo  $c  ?>"><?php echo $row['stok_prod'] ?></td>
                                    <td><?php echo $row['estado_prod'] ?></td>
                                    <td><?php echo $row['nom_categoria'] ?></td>
                                    <td><img class="card card-body  mx-auto" src="fonts/img/<?= $row['img']; ?>" alt="Card image cap" height="130px" width="150px"></td>
                                    <td><?php echo $row['nom_medida'] ?></td>
                                    <?php if($_SESSION['usuario']['ID_rol_n'] == 1 || $_SESSION['usuario']['ID_rol_n'] == 1 ){   ?>
                                    <td>
                                        <a class = "btn  btn-success" href="CU003-ingresoProducto.php?consulta=Validar+exitencia&&p=<?= $row['ID_prod']?>">ingreso</a>
                                    </td><?php }  ?>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        } // fin de while tabla
                        ?>
                    </table>
            <?php  } // fin de while 
            ?>
        </table>
</div>
</div>
</div>

<?php

    } // fin de accion ver producto
//} // fin de asset get accion
rutFinFooterFrom();
rutFromFin();
// fin de validacion sesion y permisos de perfil
}
?>