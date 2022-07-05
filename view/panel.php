<?php 
include_once("../ctrl/plantillaCtrl.php");

$reportCtrl=new plantillaCtrl;
$listafrecuencia=$reportCtrl->traerReportedeModel();
$listaProducto=$reportCtrl->traerProductodeModel();
//print_r($listafrecuencia);
//print_r($listaProducto);

?>
<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8"/>
 <title>Reportes de Zabbix</title>
 <?php 
$inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; 
include_once('Extras/head.php'); 
date_default_timezone_set('America/Lima');
?>
</head>       
<body>
<?php include($inicio.'/view/Extras/menu_plantilla.php');?>
<fieldset>
<legend>Registro de Plantillas de los reportes de Zabbix</legend>
<form action="" class="form-horizontal col-lg-12" method="POST">
<div id="top" class="form-group row"> 

<div id="frecuencia" class="col-sm-2">
        <label class="font-weight-bold" for="inputfrecuencia">Frecuencia</label>
            <select class="form-control" name="inputfrecuencia" id="inputfrecuencia">
                <option value="DIA">Diario</option>
                <option value="MEN">Mensual</option>
                <option value="RPS">Semanal</option>
                <option value="QUI">Quincenal</option>
           </select>
</div>

<div id="Producto" class="col-sm-3">
        <label class="font-weight-bold" for="inputProducto">Producto</label>
            <select class="form-control" name="inputProducto" id="inputProducto">       
            <?php
            
        for ($i=0; $i < count($listaProducto); $i++) { 
          echo '<option value="'.$listaProducto[$i]->ProductoZb_sigla.'">'.$listaProducto[$i]->ProductoZb_nombre.'</option>';
        }
     ?>
           </select>
</div>

<div id="plantilla" class="col-sm-4">
   <label  class="form-label" style="font-weight: bold;" for="inputplantilla" >Insertar plantilla (word)</label> <br>
    <input  class="form-control"  type="file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="inputplantilla" id="inputplantilla" placeholder="No se encontro archivo" required></input>
 </div>  

 
     <div class="col-sm-1">
     <br>
     <br>
     <input  class="btn btn-primary" data-bs-toggle="button" type="button" id="btnGuardar" name="btnGuardar" value="Registrar"></input>

    </div>

    <div class="col-sm-1">
     <br>
     <br>
     <input  class="btn btn-primary" data-bs-toggle="button" type="button" id="btnActualizar" name="btnActualizar" value="Actualizar"></input>

    </div>


</div>

</form>
</fieldset>

<fieldset style="border:1px solid #ccc; padding:20px">
<legend>Registro de Plantillas</legend>
<div>
    <div class="form-group row">
          <div class="col-sm-3">
            <input class="form-control" type="text" id="inputbuscar" name="inputbuscar" placeholder="Plantilla a Buscar" required>
          </div>

          <div class="col-sm-4">
              <input  type="button" id="btnBuscar" name="btnBuscar" class="btn btn-info" value="Buscar">
         
         
         
            </div>
    </div>
    
 <div id="divResultado"></div>
</fieldset>

</body>     
</html>
<script>
$("#inputfrecuencia").select2();
$("#inputProducto").select2();
</script>

<script>
/*jQuery(document).ready(function(){
  
  mostrarTabla();

});*/

function mostrarTabla(){
        //recibe datos desde formulario
    
        jQuery.ajax({
        url: '../ctrl/router.php',
        type: "POST",
        success: function(r){
            $("#divResultado").html(r);       
        }

        });

   }

   jQuery('input[type=button][name=btnGuardar]').on('click', function() {
        
        var formData=new FormData();  

        var plantilla=$("#inputplantilla")[0].files[0];
        var Producto=$("#inputProducto").val();
        var frec=$("#inputfrecuencia").val();
        
        formData.append("ajaxPlantilla", plantilla);
        formData.append("ajaxProducto",Producto);
        formData.append("ajaxFrec",frec);
  
        formData.append("ajaxBoton",$("#btnGuardar").val());

        jQuery.ajax({
        url: '../ctrl/router.php',
        data:formData,
        contentType:false,
        processData:false,
        type: "POST",

       success: function(r){ 
         
      //  var respuesta=r.value;
        var x = r.length;
     //  alert (x);
       if (x===33) {
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

    

     // alert (r);

      
       mostrarTabla();
       }

      });


 
    });


    jQuery('input[type=button][name=btnBuscar]').on('click', function() {

var valoraBuscar = $("#inputbuscar").val();
var valorBoton = $("#btnBuscar").val();

jQuery.ajax({

url: '../ctrl/router.php',
data: {ajaxBuscar:valoraBuscar,ajaxBoton:valorBoton}, //obs a ajaxboton
type: "POST",
success: function(r){
console.log(r);
$("#divResultado").html(r);  

     }

 });

 });




 jQuery('input[type=button][name=btnActualizar]').on('click', function() {
        
     
        var formData=new FormData();  
        var plantilla=$("#inputplantilla")[0].files[0];
        var Producto=$("#inputProducto").val();
        var frec=$("#inputfrecuencia").val();
    
        formData.append("ajaxPlantilla", plantilla);
        formData.append("ajaxProducto",Producto);
        formData.append("ajaxFrec",frec);
     
        formData.append("ajaxBoton",$("#btnActualizar").val());

        jQuery.ajax({
        url: '../ctrl/router.php',
        data:formData,
        contentType:false,
        processData:false,
        type: "POST",

       success: function(r){   // si todo esta correcto imprimir --todo lo de router se almacena en r
    
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
