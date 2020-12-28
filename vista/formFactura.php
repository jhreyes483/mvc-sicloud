
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

?>
<h3 class="e text-center my-4">Factura</h3>
<!-- col 2 -->
<div class="row">
<div class="col-lg-2 mx-auto">
        <div class="card card-body">
        <?php if(isset($_REQUEST['f'])){  $id = $_REQUEST['f'];   }else{ $id = ""; }   ?>
        <form action="InfFacturas.php" method="get">
            <div class="form-group"><label for="">Digite factura</label> <input type="text" id="txt1" value="<?php echo $id ?>" class="form-control" name="f"  />
        <input class="btn btn-success btn-block" value="Buscar factura" type="submit" >
        </form>
        </div>
        </div>
    </div>
  </div>
  <div id="txtHint"></div>


<?php 
}


rutFinFooterFrom();
rutFromFin();

?>