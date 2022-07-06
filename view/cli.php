<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Reportes de Productos</title>
  <?php require_once 'Extras/head.php'; ?>

  <?php

  //include_once("../ctrl/ProductoCtrl.php");

  // $obj=new ProductoCtrl;
  //  $listaProducto=$obj->allProducto();
  ?>
</head>

<body>
  <?php //require_once 'Extras/menu.php'; 
  ?>
  <fieldset>
    <legend>Formulario de gestión de productos</legend>
    <form action="" class="form-horizontal col-lg-12" method="POST">

      <div id="top" class="form-group row">

        <div class="col-sm-2">
          <label class="font-weight-bold" for="Producto">Nombre del producto</label>
          <input class="form-control" name="Producto" id="Producto" placeholder="SODIMAC">
        </div>

        <div class="col-sm-2">
          <label class="font-weight-bold" for="Stock">Stock</label>
          <input required type="number" min="1" max="1000" class="form-control" name="Stock" id="Stock" placeholder="ABC">
        </div>
        <div class="col-sm-2">
          <label class="font-weight-bold" for="Categoria">Categoría</label>
          <input required class="form-control" name="Categoria" id="Categoria" placeholder="Lacteos">
        </div>
        <div class="col-sm-2">
          <label class="font-weight-bold" for="Precio">Precio</label>
          <input required type="number" min="1" class="form-control" name="Precio" id="Precio" placeholder="1">
        </div>
        <div class="col-sm-2">
          <label class="font-weight-bold">Imagen</label>
          <input type="file" id="Imagen" name="Imagen" accept="image/jpg, image/png" />
        </div>


        <div id="divbuttons" class="col-sm-2 text-right">
          <input style="padding: 10px 15px;font-family: arial black;margin:15px 10px 5px 0px" class="btn btn-primary" id="btnGuardar" type="button" name="btnGuardar" value="Guardar Producto">

        </div>


      </div>

    </form>

  </fieldset>

  <fieldset>
    <legend>Lista de Productos</legend>
    <div id="divResultado1"></div>
  </fieldset>


</body>

</html>

<script>
  $("#Producto").select2();
</script>



<script>
  jQuery(document).ready(function() {

    mostrarTabla1();

  });

  function mostrarTabla1() {
    //recibe datos desde formulario 
    jQuery.ajax({
      url: '../ctrl/router.php',
      type: "POST",
      success: function(r) {
        $("#divResultado1").html(r);
      }
    });
  }



  jQuery('input[type=button][name=btnGuardar]').on('click', function() {
    //alert ("ji");
    var formData = new FormData();

    var producto = $("#Producto").val();
    var stock = $("#Stock").val();
    var categoria = $("#Categoria").val();
    var imagen = $("#Imagen")[0].files[0];
    var precio = $("#Precio").val();

    formData.append("ajaxProducto", producto);
    formData.append("ajaxStock", stock);
    formData.append("ajaxCategoria", categoria);
    formData.append("ajaxImagen", imagen);
    formData.append("ajaxPrecio", precio);
    formData.append("ajaxBoton", $("#btnGuardar").val());

    jQuery.ajax({
      url: '../ctrl/router.php',
      data: formData,
      contentType: false,
      processData: false,
      type: "POST",

      success: function(r) { // si todo esta correcto imprimir --todo lo de router se almacena en r

        var x = r.length;
        //alert (x);

        if (x === 34) {
          swal({
            title: "Mensaje de sistema",
            html: r,
            text: r,
            icon: "success",
            button: "OK!",
          });
        } else {
          swal({
            title: "Mensaje de sistema",
            html: r,
            text: r,
            icon: "error",
            button: "OK!",
          });
        }

        mostrarTabla1();
      }
    });


  });
</script>