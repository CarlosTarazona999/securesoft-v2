<?php
require_once ( $_SERVER['DOCUMENT_ROOT'].'/zabbiX/ctrl/checklogin.php' );
?>
<div class="form-horizontal col-lg-12" style="padding-top:10px">
<div class="form-group row"> 
    <div class="col-sm-5" style="padding-top:10px">
           <span class="target-user"><?php echo $msje;?></span>
      </div>
    <div class="col-sm-7 text-center">
    <a href="/home" style="font-family: arial black;" class="btn btn-danger" title="Inicio"><i class="fas fa-home" style="font-size:24px;color:#fff"></i> Inicio</a>
    <a href="panel.php" style="font-family: arial black;" class="btn btn-warning" title="Plantilla"><i class="fas fa-sync fa-spin" style="font-size:24px;color:#fff"></i> Plantillas</a>
    <a href="img.php" style="font-family: arial black;" class="btn btn-info" title="Imagen"><i class="fas fa-camera" style="font-size:24px;color:#fff"></i> Gráficos</a>
    <a href="index.php" style="font-family: arial black;" class="btn btn-secondary" title="reportes"><i class="fas fa-clipboard" style="font-size:24px;color:#fff"></i> Reportes</a>
    <a href="imgUpdate.php" style="font-family: arial black;" class="btn btn-dark" title="Imagen"><i class="fas fa-database" style="font-size:24px;color:#fff"></i> Registro de Gráficos</a>


</div>
</div>