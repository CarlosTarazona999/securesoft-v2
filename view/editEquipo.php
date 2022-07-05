<?php

include_once("../ctrl/imgCtrl.php");
include_once("../ctrl/plantillaCtrl.php");
include_once("../ctrl/equipoCtrl.php");

$equipotCtrl=new equipoCtrl;
$reportCtrl=new plantillaCtrl;
$listaequipos=$equipotCtrl->traerEquipodeModel();
$lista_categorias=$equipotCtrl->traerCategoriadeBD();
$listaProducto=$reportCtrl->traerProductodeModel();
//print_r($listaProducto);
//print_r($listaequipos);

if(isset($_GET['id'])){

    $id_equipo = $_GET['id'];
    
    $eqpCtrlObj = new equipoCtrl();

    $equipo = $eqpCtrlObj->EquipoxId($id_equipo);
   //$lista_categorias = $imgCtrlObj->traerCategoriasdesdeModel();
}


?>

<!doctype html>
<html lang="en">
<head>
<title>Reportes de Zabbix</title>  
<?php 
$inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; 
include_once('Extras/head.php'); 
date_default_timezone_set('America/Lima');
?>
</head>
<body>
<?php include($inicio.'/view/Extras/menu.php');?>
<fieldset>
<legend>Actualizar equipos Zabbix</legend>
<div class="form-group row">

<div class="col-sm-1">
  <label class="form-label" style="font-weight: bold;" for="inputid"> Id</label> 
 <input class="form-control" type="text" id="inputid" name="inputid"  value="<?php echo $equipo[0]->equipo_id; ?>" disabled></input>
</div>


<div class="col-sm-3">
  <label class="form-label" style="font-weight: bold;" for="inputProducto"> Producto</label> 
  <select id="inputProducto" name="inputProducto"  class="selProducto form-control">
            <?php
        for ($i=0; $i < count($listaProducto); $i++) { 
          if ($listaProducto[$i]->ProductoZb_nombre == $equipo[0]->ProductoZb_nombre) {
            echo '<option selected value="'.$listaProducto[$i]->ProductoZb_id.'">'.$listaProducto[$i]->ProductoZb_nombre.'</option>';
          }
          else {
            echo '<option value="'.$listaProducto[$i]->ProductoZb_id.'">'.$listaProducto[$i]->ProductoZb_nombre.'</option>';

          }
                 }
        ?>
           </select>
</div>

<div class="col-sm-2">
  <label class="form-label" style="font-weight: bold;" for="inputgrafico">Id de gráfico Zabbix</label>     
  <input class="form-control" type="text" id="inputgrafico" name="inputgrafico"  value="<?php echo $equipo[0]->equipo_grafico; ?>" ></input>
</div>

<div class="col-sm-4">

  <label class="form-label" style="font-weight: bold;" for="inputdetalle">Equipo</label>     
  <input class="form-control" type="text" id="inputdetalle" name="inputdetalle"  value="<?php echo $equipo[0]->equipo_detalle; ?>"></input>


</div>

<div class="col-sm-2">

  <label class="form-label" style="font-weight: bold;" for="inputcategoria">Categoria</label>     
  <select class="form-control" name="inputcategoria" id="inputcategoria">
  <?php
     for ($i=0; $i < count($lista_categorias); $i++) { 
      if($lista_categorias[$i]->categoria_nombre == $equipo[0]->categoria_nombre){
            echo '<option selected value="'.$lista_categorias[$i]->categoria_id.'">'.$lista_categorias[$i]->categoria_nombre.'</option>';
        } else{
            echo '<option value="'.$lista_categorias[$i]->categoria_id.'">'.$lista_categorias[$i]->categoria_nombre.'</option>';
        }
     }
  ?>
  </select>
</div>

<div class="col-sm-10">
 
 </div>

<div class="col-sm-2">
   <br>
   <br>
  <input  class="btn btn-danger" type="button" id="btnActualizar" name="btnActualizar" value="Actualizar Equipo"></input>

 </div>

</div>
</fieldset>

</body>
</html>
<script>

$("#inputcategoria").select2();
$("#inputProducto").select2();
</script>


<script>
     jQuery('input[type=button][name=btnActualizar]').on('click', function() {
        
     
        var formData=new FormData();  

        var id=$("#inputid").val();
        var Producto=$("#inputProducto").val();
        var grafico=$("#inputgrafico").val();
        var detalle=$("#inputdetalle").val();
        var categoria=$("#inputcategoria").val();

    
        formData.append("ajaxId",id);
        formData.append("ajaxProducto",Producto);
        formData.append("ajaxGrafico",grafico);
        formData.append("ajaxDetalle", detalle);
        formData.append("ajaxCategoria",categoria);


        formData.append("ajaxBoton",$("#btnActualizar").val());

        jQuery.ajax({
        url: '../ctrl/router.php',
        data:formData,
        contentType:false,
        processData:false,
        type: "POST",

       success: function(r){   // si todo esta correcto imprimir --todo lo de router se almacena en r
    
      // alert (r);

      var x = r.length;
      // alert (x);
       
       if (x===35) {
        swal({
       title: "Mensaje de sistema",
       html: r,
       text:r,
       icon: "success",
       button: "OK!",
        });
       }
       else{

        swal({
       title: "Mensaje de sistema",
       html: r,
       text:r,
       icon: "error",
       button: "OK!",
        });

       }

       //mostrarTabla();
       }

      });


 
    });

    </script>