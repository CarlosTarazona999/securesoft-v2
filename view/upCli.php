<?php
 include_once("../ctrl/ProductoCtrl.php");

$obj=new ProductoCtrl;
$listaProducto=$obj->allProductoZabbix();

//print_r($listaProducto);
//print_r($listaequipos);

if(isset($_GET['id'])){

    $id_Producto = $_GET['id'];
    $obj=new ProductoCtrl;
    $Productos = $obj->ProductoxId($id_Producto);
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
<legend>Actualizar Producto</legend>
<div class="form-group row">

<div class="col-sm-1">
  <label class="form-label" style="font-weight: bold;" for="id"> Id</label> 
 <input class="form-control" type="text" id="id" name="id"  value="<?php echo $Productos[0]->Id; ?>" disabled></input>
</div>


<div class="col-sm-3">
  <label class="form-label" style="font-weight: bold;" for="Producto"> Producto</label> 
  <input class="form-control" type="text" id="Producto" name="inputProducto"  value="<?php echo $Productos[0]->ProductoZb_nombre; ?>" ></input>

</div>

<div class="col-sm-2">
  <label class="form-label" style="font-weight: bold;" for="sigla"> Sigla</label> 
  <input class="form-control" type="text" id="sigla" name="sigla"  value="<?php echo $Productos[0]->ProductoZb_sigla; ?>" ></input>

</div>

<div class="col-sm-2">
  <label class="form-label" style="font-weight: bold;" for="pais"> País</label> 
  <input class="form-control" type="text" id="pais" name="pais"  value="<?php echo $Productos[0]->ProductoZb_pais; ?>" ></input>

</div>

<div class="col-sm-2">
  <label class="form-label" style="font-weight: bold;" for="ip"> IP</label>     
  <input class="form-control" type="text" id="ip" name="ip"  value="<?php echo $Productos[0]->ProductoZb_ip; ?>" ></input>
</div>


<div class="col-sm-2">

  <input  class="btn btn-danger" style="padding: 10px 15px;font-family: arial black;margin:15px 10px 5px 0px" type="button" id="btnActualizar" name="btnActualizar" value="Actualizar Producto"></input>

 </div>

</div>
</fieldset>

</body>
</html>


<script>



     jQuery('input[type=button][name=btnActualizar]').on('click', function() {
        
     
        var formData=new FormData();  

        var id=$("#id").val();
        var Producto=$("#Producto").val();
        var pais=$("#pais").val();
        var ip=$("#ip").val();
        var sigla=$("#sigla").val();

        formData.append("ajaxId",id);
        formData.append("ajaxProducto",Producto);
        formData.append("ajaxPais",pais);
        formData.append("ajaxIP", ip);
        formData.append("ajaxSigla", sigla);
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
        swal({title: "Mensaje de sistema", html: r,text:r, icon: "error", button: "OK!", }); }
      // mostrarTabla();
       }

      });
 
    });

    </script>