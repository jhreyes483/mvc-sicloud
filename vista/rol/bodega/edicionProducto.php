<?php
include_once '../../../controlador/ControladorSession.php';
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

include_once '../../../global/plantillas/plantilla.php';
include_once '../../../global/plantillas/cuerpo/inihtmlN3.php';
include_once '../../../global/plantillas/nav/navN3.php';
?>

    <table class="table table text-center table-striped  table-bordered bg-white table-sm col-md-8 col-sm-4 col-xs-12 mx-auto">
        <thead>
            <tr>
                <th>ID producto</th>
                <th>Nombre producto</th>
                <th>Valor producto</th>
                <th>Stock producto</th>
                <th>Estado</th>
                <th>Categoria</th>
                <th>Tipo medida</th>
                <th>Accion</th>
            </tr>
        </thead>
        <?php

        $datos = Producto::verProductos();
        while ($row = $datos->fetch_array()) {

        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['ID_prod']  ?></td>
                    <td><?php echo $row['nom_prod'] ?></td>
                    <td><?php echo $row['val_prod'] ?></td>
                    <td><?php echo $row['stok_prod'] ?></td>
                    <td><?php echo $row['estado_prod'] ?></td>
                    <td><?php echo $row['CF_categoria'] ?></td>
                    <td><?php echo $row['CF_tipo_medida'] ?></td>
                    <td>
                        <a class="btn btn-dark mx-auto icon-edit " href="editarProducto.php?id=<?php echo $row['ID_prod'] ?>"><i class="fas fa-marker"></i></a>
                        <a class="btn btn-danger icon-trash " href="../metodos/get.php?accion=EliminarProducto&&id=<?php echo $row['ID_prod'] ?>"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>



        <?php  } // fin de while 
        ?>
    </table>


<?php
    include_once '../../../global/plantillas/cuerpo/inihtml.php';
} // fin de validar permisos
?>