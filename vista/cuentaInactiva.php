<?php
include_once '../controlador/controladorrutas.php';
rutIniInactiva();

?>
<!-- col 12 -->
<br><br><br><br><br>
<div class = "col-md-12 ">
    <div class="row">
        <div class = "col-md-3"></div>
        <div class = "col-md-6">
            <div class = " radix  card card-body text-center bk-rgb borde-1-card ">
                <h3 class = "card-title">Cuenta desactivada</h3><br><br>
                <h5 class = "card-text">Usted ha registrado exitosamente sus datos, sin embargo requiere activación por parte del administrador o no ha iniciado sesion correctamente</h5><br><br>
            </div>
        </div>
        <div class = "col-md-3"></div>
    </div>
</div><br><br><br><br>
<?php
rutFinFooterFrom();
rutFromFin();
?>