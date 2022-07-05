<?php
include_once("../ctrl/plantillaCtrl.php");
include_once("../ctrl/imgCtrl.php");
include_once("../ctrl/equipoCtrl.php");

$reportCtrl=new plantillaCtrl;
$equipoCtrlObj=new equipoCtrl;

$listafrecuencia=$reportCtrl->traerReportedeModel();
$listaProducto=$reportCtrl->traerProductodeModel();
$listaplantillas=$reportCtrl->traerPlantilladeModel();
$listacategoria=$equipoCtrlObj->traerCategoriadeBD();

//print_r($listacategoria);
//print_r ($listaplantillas);
?>

<style>
  table{
table-layout: fixed;
width: 250px;
}

th, td {
border: 1px solid black;
width: 100px;
word-wrap: break-word;
}
</style>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8"/>
<title>Reportes de Zabbix</title>
<?php 
$inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; 
require_once $inicio.'/view/Extras/head.php';
//require_once $inicio.'/view/Extras/includes.php';
//require_once ($inicio.'/model/database.php');
require_once ($inicio.'/ctrl/functions.php');
require_once ($inicio.'/vendor/autoload.php');
date_default_timezone_set('America/Lima');
?>
</head>
<body>

<?php $inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; include($inicio.'/view/Extras/menu_equipo.php');?>
<fieldset>
    <legend>Registro de equipos </legend>
    <form action="" class="form-horizontal col-lg-12" method="POST">

    <div id="top" class="form-group row"> 

       <div class="col-sm-3">
            <label class="font-weight-bold" for="inputProducto">Producto</label>
            <select id="inputProducto" name="inputProducto"  class="selProducto form-control">
            <?php
        for ($i=0; $i < count($listaProducto); $i++) { 
          echo '<option value="'.$listaProducto[$i]->ProductoZb_id.'">'.$listaProducto[$i]->ProductoZb_nombre.'</option>';
        }
        ?>
           </select>
        </div>

     

        
        <div class="col-sm-2">
          <label class="font-weight-bold" for="inputgrafico">Id de Gráfico</label>
            <input class="form-control"  name="inputgrafico" id="inputgrafico">
        </div>

        <div class="col-sm-4">
          <label class="font-weight-bold" for="inputequipo">Nombre de Equipo</label>
            <input class="form-control"  name="inputequipo" id="inputequipo">
        </div>
        
        <div class="col-sm-3">
          <label class="font-weight-bold" for="inputcategoria">Categoria</label>
          <select id="inputcategoria" name="inputcategoria"  class="selProducto form-control">
            <?php
        for ($i=0; $i < count($listacategoria); $i++) { 
          echo '<option value="'.$listacategoria[$i]->categoria_id.'">'.$listacategoria[$i]->categoria_nombre.'</option>';
        }
        ?>
           </select>
        </div>
       
        <div class="col-sm-10">
         
        </div>

        <div id="divbuttons" class="col-sm-2 text-right" style="padding:0">  
            <input style="padding: 10px 20px;font-family: arial black;margin:15px 15px 5px 0px" class="btn btn-primary" id="btnGuardar" type="button" name="btnGuardar" value="Guardar"> 
        </div>
      
    </div>

    </form> 

    </fieldset>
    <fieldset style="border:1px solid #ccc; padding:20px">
<legend>Registro de Equipos</legend>
<div>
    <div class="form-group row">
          <div class="col-sm-3">
            <input class="form-control" type="text" id="inputbuscar" name="inputbuscar" placeholder="Producto a Buscar" required>
          </div>

          <div class="col-sm-4">
              <input  type="button" id="btnBuscar" name="btnBuscar" class="btn btn-info" value="Buscar Producto">
         
         
         
            </div>
    </div>
 <div id="divResultado"></div>
</fieldset>
    </body>     
</html>

<script>
$("#inputProducto").select2();
$("#inputcategoria").select2();

</script>

<script>

jQuery(document).ready(function(){
  
  mostrarTabla();

});

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

        var Producto=$("#inputProducto").val();
        var grafico=$("#inputgrafico").val();
        var equipo=$("#inputequipo").val();
        var categoria=$("#inputcategoria").val();
      

        formData.append("ajaxProducto",Producto);
        formData.append("ajaxGrafico",grafico);
        formData.append("ajaxEquipo",equipo);
        formData.append("ajaxCategoria",categoria);
   

        formData.append("ajaxBoton",$("#btnGuardar").val());

        jQuery.ajax({
        url: '../ctrl/router.php',
        data:formData,
        contentType:false,
        processData:false,
        type: "POST",

       success: function(r){   // si todo esta correcto imprimir --todo lo de router se almacena en r
      
        var x=r.length;
       //alert (x);
        
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
 
    </script>