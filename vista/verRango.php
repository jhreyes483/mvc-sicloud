<?php

include_once '../controlador/controladorrutas.php';
rutFromIni();

$obj = new ControllerDoc();

$dia           = $obj->verDia();
$totalD         = array_sum(array_column($dia, 1 ));
$cD             = count($dia);
$pD             =  floor ( ($totalD/$cD) ); 
$promedioDia   = number_format($pD, 2, ',', '.');


$semana           = $obj->verSemana();
$totalS          = array_sum(array_column($semana, 1 ));
$cS              = count($semana);
$pS              = floor ( ($totalS/$cS) ); 
$promedioSemana  = number_format($pS, 2, ',', '.');

$mes             = $obj->verMes();
$totalM          = array_sum(array_column($mes, 1 ));
$cM              = count($mes);
$pM              = floor ( ($totalM/$cM) ); 
$promedioMensual = number_format($pM, 2, ',', '.');


cardtitulo(" Informes de ventas");

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

/* 
    $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
from sicloud.det_factura detf
join sicloud.factura f on f.ID_factura = detf.FK_det_factura
group by dia";
     $consulta = $this->db->prepare($sql);
     $consulta->execute();
     $result = $consulta->fetchAll();
    //$dat = $c->query($sql);
    //$col = $dat->num_rows;
    // numero de columnas de dia

$r = 0;
   */





?>

<div class="container-fluid my-4 ">

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 mx-auto">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Promedio (Diario)</div>



              <div class="h5 mb-0 font-weight-bold text-gray-800">$<?= $promedioDia ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 mx-auto">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Promedio (Mensual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$<?= $promedioMensual ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>





  <div class="card col-md-4 mx-auto">
    <div class="card-body">
      <i class="fas fa-calendar fa-2x text-gray-300"></i>
      <h5 class="card-title text-center ">Seleccione Informe</h5>
      <!-- INI--FORM PRODUCTO--------------------------------------------------------------------------------- -->
      <form action="verRango.php" method="POST">
        <select name="ventas" class="form-control">

          <option value="dia">Por Dia</option>
          <option value="semana">Por Semana</option>
          <option value="mes">Por Mes</option>

        </select>
        <input type="hidden" name="accion" value='verRango'>
        <br> <input class="btn btn-primary btn-block my-2" type="submit" name="consulta" value="consulta">

    </div>
  </div>
  </form>




  <div class="col-md-4 p-2 mx-auto my-4 ">
    <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


      <?php


      if (isset($_POST['ventas'])) {
        if ($_POST['ventas'] == 'dia') {

      ?>
          <thead>
            <tr>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Dia</th>
            </tr>
          </thead>
          <?php

          $datos = $obj->verDia();
  

/*
$con = $d['total'] + $d['total'];
echo $con;
*/
          foreach ($datos as $i => $row) {
          ?>
            <tbody>
              <tr>
                <td> <?= $row['cantidad']  ?></td>
                <td> <?= $row['total']  ?></td>
                <td> <?= $row['dia']  ?></td>
              </tr>
            </tbody>
          <?php   }
          ?>

    </table>



  <?php } // fin de consulta por dia


        //------------------------------------------FIN DE CONSULTA POR DIA-------------------------------------------


        if ($_POST['ventas'] == 'semana') {

  ?>

    <div class="col-md-4 p-2 mx-auto my-4 ">
      <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


        <thead>
          <tr>
            <th>Cantidad de ventas por semana</th>
            <th>Total</th>
            <th>Dia cierre ventas</th>
          </tr>
        </thead>

        <?php
          $datos = $obj->verSemana();
          foreach ($datos as $i => $row) {
            //while ($row = $datos->fetch_array()) {
        ?>


          <tbody>
            <tr>
              <td> <?= $row['cantidad']  ?></td>
              <td> <?= $row['Total']  ?></td>
              <td> <?= $row['dia_final_semana']  ?></td>
            </tr>
          </tbody>


        <?php   } //while
        ?>

      </table>

    <?php } // fin de consulta por 

    ?>

    </div><!-- fin de tabla responce -->



    <!-- fin busqueda por semana-------------------------------------------------------------------------------- -->



    <?php

        if ($_POST['ventas'] == 'mes') {

    ?>

      <div class="col-md-4 p-2 mx-auto my-4 ">
        <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


          <thead>
            <tr>
              <th>Cantidad de ventas por Mes</th>
              <th>Total</th>
              <th>Dia cierre ventas</th>
            </tr>
          </thead>

          <?php
          $datos = $obj->verMes();

          
          foreach ($datos as $i => $row) {
            //while ($row = $datos->fetch_array()) {
          ?>


            <tbody>
              <tr>
                <td> <?= $row['cantidad']  ?></td>
                <td> <?= $row['Total']  ?></td>
                <td> <?= $row['dia_final_mes']  ?></td>
              </tr>
            </tbody>
          <?php   } //while
          ?>
        </table>
      </div>
  </div>
</div>
</div>
</div>
</div>
</div>
v

<?php } // fin de consulta por 
      } // fin de isset consulta




      rutFromFin();;

?>