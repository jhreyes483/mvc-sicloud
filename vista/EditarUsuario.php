<?php
include_once '../controlador/controladorrutas.php';
rutFromIni();
$objSession = new Session;
$us = $objSession->desencriptaSesion();

$id = $_GET['ID_us'];
$objCon =  new ControllerDoc();
$datosUsusario  = $objCon->selectUsuarios($id);
$datosRol       = $objCon->verRol();
$datosDocumento = $objCon->selectDocumento();

foreach(  $datosRol as $rol ){
    $ID_rol_n =   $rol['ID_rol_n'];
    $nom_rol  =   $rol['nom_rol'];
}


foreach( $datosUsusario as $row ){
    $foto          = $row['foto'];
    $ID_us         = $row['ID_us'];
    $nom1          = $row['nom1'];
    $nom2          = $row['nom2'];
    $ape1          = $row['ape1'];
    $ape2          = $row['ape2'];
    $fecha         = $row['fecha'];
  //  $pass          = $row['pass'];
    $foto          = $row['foto'];
    $correo        = $row['correo'];
    $FK_tipo_doc   = $row['FK_tipo_doc'];
    $ID_rol_n      = $row['ID_rol_n'];
 
 } 


?>
<?php

$objCon =  new ControllerDoc();
$datosRol  =  $objCon->verRol();



cardtitulo("Actualizar datos de Usuarios");

?>
<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body mx-auto">
            <h5></h5>
            <form class="form-group" action="../controlador/api.php?apicall=actualizarUsuario&&id=<?= $_GET['ID_us'] ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card text-center card-title">
                        </div><br>
                        <div class="col-md-12">
                            <div class="row">
                                <!-- contenedor -->
                                <!-- inicion fila selector de documento y rol -->
                                <div class="col-md-6">
   <h5>Seleccione el tipo de documento: </h5>
    <select class="form-control" name="FK_tipo_doc">
<?php 
/// select de documento usaurio
$doc = $FK_tipo_doc;

foreach ($datosDocumento as $d ):

if(isset($doc) && $doc==$d['ID_acronimo'] ) 
 echo "selected"; 
?>
<option value="<?= $d[0] ?>"><?= $d[1] ?></option>
<?php  
endforeach;  
?>
    </select>

                                 </div><!-- fin de columna de 6 -->
                                  <div class="col-md-6">

<?php
if ($us['usuario']['ID_rol_n'] == 1):
?>
   <h5>Seleccione rol "Asignar rol"</h5>
                                 <div class="form-group">
   <select name="FK_rol" class="form-control">
<?php /// select de rol usuario


foreach( $datosRol as $row):
?>
         <option 
<?php 
if(isset($ID_rol_n) && $ID_rol_n == $row['ID_rol_n']) 
echo 'selected';
?>   value="    <?=  $row['ID_rol_n']  ?>">
                <?=  $row['nom_rol']   ?>
       </option>                     
<?php 
endforeach;
endif;
?>
</select>
                                   </div><!-- fin de form-group select de  -->
                                </div><!-- fin de columna de 6 -->
                            </div><!-- row fin de fila -->
                        </div><!-- fin contenedor  de selectores -->
                        <?php

   ?>
                        
     

                            <div class="mx-auto text-center my-4">
                                <h5>Foto de perfil</h5>
                                <img class="img-profile ml-3 rounded-circle " src="../vista/fonts/us/<?= $foto   ?>" width="120" height="140">
                                </div>
                               
                                <h5>Numero de identificacion: </h5>
                                <!-- 
                                <?// "Id anterior".$id;  ?>

                                 -->
      
                                <input class="form-control" type=»number» readonly=»readonly» name="ID_us" value="<?=  $ID_us  ?>" required autofocus maxlength="11">
                            
                    </div><br>
                </div>
                
              
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer nombre: </h5>
                        <input class="form-control" type="text" name="nom1" value="<?= $nom1 ?>" required autofocus maxlength="20">
                    </div>

                    <div class="col-md-6">
                        <h5>Segundo nombre: </h5>
                        <input class="form-control" type="text" name="nom2" value="<?= $nom2   ?>" required autofocus maxlength="20">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer apellido: </h5>
                        <input class="form-control" type="text" name="ape1" value="<?= $ape1  ?>" required autofocus maxlength="20">
                    </div>

                    <div class="col-md-6">
                        <h5>Segundo apellido: </h5>
                        <input class="form-control" type="text" name="ape2" value="<?= $ape2 ?>" required autofocus maxlength="20">
                    </div>
                </div><br>
                <h5>Fecha de nacimiento: </h5>
                <input class="form-control" type="date" name="fecha" value="<?= $fecha ?>"><br>
                <h5>Digite su contraseña: </h5>
             <!-- 
                  <input class="form-control" type="password" name="pass" value=" required autofocus maxlength="25"><br>
             -->  

                <h5> Foto </h5>
                <input class="form-control" type="text" name="foto" value="<?= $foto ?>" required autofocus maxlength="25"><br>
                <h5> Correo </h5>
                <input class="form-control" type="email" name="correo" value="<?= $correo  ?>" required autofocus maxlength="25"><br>
            <input type="hidden" name="accion" value="insetUpdateUsuario">
            <input class="btn btn-primary form-control" type="submit" name="submit" value="Actualizar datos"><br><br><br>
            <a class="btn btn-primary form-control btn-block" href="./CU009-controlUsuarios.php">Lista usuario</a>
            </form>
        </div>
    </div>
</div>
<?php

?>
          
        </div>
    </div>
</div>
</div>
</div>
<?php 
rutFinFooterFrom();
rutFromFin();
?>